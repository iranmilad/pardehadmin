<div>
    <h4 class="mb-3">اتصال طرح‌های اعتباری به محصول</h4>

    <div class="mt-3" wire:ignore>
        <label for="selectedPlans" class="form-label">طرح‌های اعتباری فعال</label>
        <select id="selectedPlans" wire:model="selectedPlans" class="form-select form-select-solid" data-control="select2" multiple>
            @foreach($availablePlans as $plan)
                <option value="{{ $plan->id }}" @if(in_array($plan->id, $selectedPlans)) selected @endif>
                    {{ $plan->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="button" class="btn btn-primary mt-2" wire:click="save">ذخیره</button>

    @if (session()->has('message'))
        <div class="alert alert-success mt-3">
            {{ session('message') }}
        </div>
    @endif
</div>

<script>

    document.addEventListener('DOMContentLoaded', function () {
        // Initialize select2 on initial load
        $('#selectedPlans').select2();

        // Reinitialize select2 on each livewire update
        Livewire.hook('message.processed', (message, component) => {
            $('#selectedPlans').select2();
        });

        // Add change event listener to log selected values to the console
        $('#selectedPlans').on('change', function (e) {
            var selectedValues = $(this).val();
            console.log('Selected values:', selectedValues);

            // Update Livewire component's selectedAttributes property
            @this.set('selectedPlans', selectedValues);
        });
    });
    document.addEventListener('livewire:update', function () {
        $('#selectedPlans').select2();
    });
</script>
