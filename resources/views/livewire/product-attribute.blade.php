<div>
    <div wire:ignore>
        <label for="" class="form-label">انتخاب ویژگی</label>
        <select data-control="select2" wire:model="selectedAttributes" class="form-select form-select-solid" multiple="multiple" id="product-attribute-search" name="attributes">
            @foreach ($productAttributes as $attribute)
            <option value="{{ $attribute['id'] }}" {{ in_array($attribute['id'], $selectedAttributes) ? 'selected' : '' }}>
                {{ $attribute['name'] }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mt-7" x-data="{ selectedAttributes: {} }" id="attributesOpt" x-init="initSelect2()">
        @if(count($items) > 0)
        @foreach($items as $item)
        <div class="row" x-init="selectedAttributes['{{ $item['slug'] }}'] = []">
            <div class="col-2">
                <span class="fs-6">نام : <b>{{ $item['name'] }}</b></span>
            </div>
            <div class="col-10">
                <select x-model="selectedAttributes['{{ $item['slug'] }}']" class="form-select form-select-solid" name="{{ $item['slug'] }}" id="{{ $item['slug'] }}" multiple>
                    @foreach($item['child'] as $child)
                    <option value="{{ $child['slug'] }}">{{ $child['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @endforeach
        @endif
    </div>

    @push('scripts')
    <script>
        console.log('first')
        function initSelect2() {
            document.addEventListener('livewire:load', function () {
                Livewire.hook('afterDomUpdate', () => {
                    $('select[data-control="select2"]').select2();
                });
            });
        }
    </script>
    @endpush
</div>
