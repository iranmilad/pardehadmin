<div>
    @foreach ($selectedServicesType as $service)
        <div class="form-group mt-4">
            <label class="form-label">سرویس:
                @switch($service)
                    @case('sewing')
                        دوخت
                        @break
                    @case('design')
                        طراحی
                        @break
                    @case('installer')
                        نصب
                        @break
                    @default
                        نامعلوم
                @endswitch
            </label>

            <select wire:model="selectedCategory.{{ $service }}" class="form-control" >
                <option value="">انتخاب کنید</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" 
                        {{ in_array($category->id, $selectedCategory[$service] ?? []) ? 'selected' : '' }}>
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>
            
        </div>
    @endforeach

    <div class="mt-4">
        <button type="button" wire:click="save" class="btn btn-primary">ذخیره</button>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success mt-4">
            {{ session('message') }}
        </div>
    @endif
</div>
