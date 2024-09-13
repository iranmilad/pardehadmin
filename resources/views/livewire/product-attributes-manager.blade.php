{{-- resources/views/livewire/product-attributes-manager.blade.php --}}

<div>
    <div class="row">
        <div class="mb-5 col-xl-7">
            <label for="holo_code" class="form-label">شناسه محصول</label>
            <input type="text" class="form-control form-control-solid" id="holo_code" wire:model="holo_code">
            @error('holo_code') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-5 col-xl-7">
            <label for="price" class="form-label">قیمت (تومان)</label>
            <input type="number" class="form-control form-control-solid" id="price" name="price" wire:model="price">
            @error('price') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-5 col-xl-7">
            <label for="sale_price" class="form-label">قیمت فروش ویژه (تومان)</label>
            <input type="number" class="form-control form-control-solid" id="sale_price" name="sale_price" wire:model="sale_price">
            @error('sale_price') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-5 col-xl-7">
            <label for="wholesale_price" class="form-label">قیمت عمده‌فروشی (تومان)</label>
            <input type="number" class="form-control form-control-solid" id="wholesale_price" name="wholesale_price" wire:model="wholesale_price">
            @error('wholesale_price') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-5 col-xl-7">
            <label for="few" class="form-label">موجودی</label>
            <input type="number" class="form-control form-control-solid" id="few" name="few" wire:model="few">
            @error('few') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-5 col-xl-7">
            <label for="time_per_unit" class="form-label">زمان انجام به ازای هر واحد :</label>
            <div class="input-group">
                <input dir="ltr" name="time_per_unit" type="number" wire:model="time_per_unit" class="form-control form-control-solid mb-2 mb-md-0" placeholder="زمان مورد نیاز را وارد کنید" />
                <span class="input-group-text bg-white ms-0">ساعت</span>
            </div>
        </div>
        <div class="mb-3 col-xl-7">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="type" name="type" wire:model="type">
                <label class="form-check-label" for="type">
                    کالای متغیر
                </label>
            </div>
            @error('type') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="mt-4">
        <button type="button" class="btn btn-primary" wire:click="save">ذخیره</button>
    </div>

    @if (session()->has('message'))
        <div class="mt-3 alert alert-success">
            {{ session('message') }}
        </div>
    @endif
</div>
