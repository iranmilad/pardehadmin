<div>
    <div wire:ignore>
        <label class="form-label" for="independent-attributes-select">ویژگی‌های مستقل</label>
        <select id="independent-attributes-select" class="form-select form-select-solid" data-control="select2" multiple wire:model="selectedIndependentAttributes">
            @foreach ($attributes as $attribute)
                <option value="{{ $attribute->id }}" {{ in_array($attribute->id, $selectedIndependentAttributes) ? 'selected' : '' }}>{{ $attribute->name }}</option>
            @endforeach
        </select>
        <button type="button" wire:click="updateIndependentAttributes" wire:loading.attr="disabled" class="btn btn-primary mt-3">به‌روزرسانی</button>
    </div>

    <div class="mt-5" wire:ignore>
        <label class="form-label" for="add-attributes-select">اضافه کردن ترکیب جدید</label>
        <select id="add-attributes-select" class="form-select form-select-solid" data-control="select2" wire:model="addIndependentAttribute">
            <option value="" disabled selected>یک ویژگی برای اضافه کردن انتخاب کنید</option>
            @foreach ($selectedIndependentAttributes as $attributeId)
                @php
                    $attribute = $attributes->firstWhere('id', $attributeId);
                @endphp
                @if ($attribute)
                    <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                @endif
            @endforeach
        </select>
        <button type="button" wire:click="addCombination" class="btn btn-secondary mt-3">افزودن ترکیب</button>
    </div>


    @if (session()->has('message'))
        <div class="alert alert-success mt-3">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif

    <div class="mt-7">
        @foreach ($combinations as $index => $combination)
        @php
            $attribute = $attributes->firstWhere('id', key($combination["attributes"]));
        @endphp


        <div class="card border border-gray-300">
            <input type="hidden" wire:model="combinations.{{ $index }}.combination_index" value="{{ $combination['combination_number'] ?? $combination['id'] }}">
            <div class="card-header py-2">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <b><a href="#collapse{{ $index }}" data-bs-toggle="collapse">#  {{ $index + 1 }}</a></b>
                    <div class="flex-fill">
                        <div class="row">
                            <div class="col-12 col-lg-3 m-1">
                                <select class="form-select form-select-solid" name="attributes[{{ $attribute->id }}]" id="attribute_{{ $attribute->id }}" wire:model="combinations.{{ $index }}.attributes.{{ $attribute->id }}">
                                    <option value="">انتخاب {{ $attribute->name }}</option>
                                    @foreach ($attribute->properties as $property)
                                        <option value="{{ $property->id }}" {{ isset($combination['attributes'][$attribute->id]) && $combination['attributes'][$attribute->id] == $property->id ? 'selected' : '' }}>{{ $property->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="collapse" id="collapse{{ $index }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-8">
                                <label for="holo_code_{{ $index }}" class="form-label">شناسه محصول</label>
                                <input type="text" class="form-control form-control-solid" id="holo_code_{{ $index }}" wire:model.defer="combinations.{{ $index }}.holo_code" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-8">
                                <label for="price_{{ $index }}" class="form-label">قیمت اصلی</label>
                                <input type="text" class="form-control form-control-solid" id="price_{{ $index }}" wire:model.defer="combinations.{{ $index }}.price" placeholder="قیمت(تومان)">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-8">
                                <label for="sale_price_{{ $index }}" class="form-label">قیمت فروش ویژه</label>
                                <input type="text" class="form-control form-control-solid" id="sale_price_{{ $index }}" wire:model.defer="combinations.{{ $index }}.sale_price" placeholder="قیمت(تومان)">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-8">
                                <label for="wholesale_price_{{ $index }}" class="form-label">قیمت فروش عمده</label>
                                <input type="text" class="form-control form-control-solid" id="wholesale_price_{{ $index }}" wire:model.defer="combinations.{{ $index }}.wholesale_price" placeholder="قیمت(تومان)">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-8">
                                <label for="stock_quantity_{{ $index }}" class="form-label">موجودی</label>
                                <input type="number" class="form-control form-control-solid" id="stock_quantity_{{ $index }}" wire:model.defer="combinations.{{ $index }}.stock_quantity" placeholder="عدد">
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="time_per_unit_{{ $index }}" class="form-label">زمان انجام به ازای هر واحد :</label>
                            <div class="input-group">
                                <input dir="ltr" name="time_per_unit_{{ $index }}" type="number" id="time_per_unit_{{ $index }}"   wire:model.defer="combinations.{{ $index }}.time_per_unit" class="form-control form-control-solid mb-2 mb-md-0" placeholder="زمان مورد نیاز را وارد کنید" />
                                <span class="input-group-text bg-white ms-0">ساعت</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-8">
                                <label for="description_{{ $index }}" class="form-label">توضیحات</label>
                                <textarea class="form-control form-control-solid" id="description_{{ $index }}" wire:model.defer="combinations.{{ $index }}.description" rows="4" placeholder="توضیحات ترکیب"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="button" class="btn btn-primary" wire:click="updateIndependentCombination({{ $index }})">به‌روزرسانی</button>
                    <button type="button" class="btn btn-danger ms-3" wire:click="removeIndependentCombination({{ $index }})">حذف</button>
                </div>
            </div>
        </div>


        @endforeach

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize select2 on initial load
        $('#independent-attributes-select').select2();

        // Reinitialize select2 on each livewire update
        Livewire.hook('message.processed', (message, component) => {
            $('#independent-attributes-select').select2();
        });

        // Add change event listener to log selected values to the console
        $('#independent-attributes-select').on('change', function (e) {
            var selectedValues = $(this).val();
            console.log('Selected values:', selectedValues);

            // Update Livewire component's selectedIndependentAttributes property
            @this.set('selectedIndependentAttributes', selectedValues);
        });

        // Add change event listener to log selected values to the console
        $('#add-attributes-select').on('change', function (e) {
            var selectedValues = $(this).val();
            console.log('Selected values:', selectedValues);

            // Update Livewire component's addIndependentAttribute property
            @this.set('addIndependentAttribute', selectedValues);
        });


    });

    document.addEventListener('livewire:load', function () {
        Livewire.on('combinationAdded', function (combinationNumber) {
            // Refresh Select2 for the newly added combination
            $('#collapse' + combinationNumber + ' select').select2();
        });
    });
</script>
