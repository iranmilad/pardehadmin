<div class="row">
    <div class="mb-5 col-xl-6">
        <label for="weight" class="form-label">وزن (کیلوگرم)</label>
        <input type="text" class="form-control form-control-solid" id="weight" wire:model="weight">
        @error('weight') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="mb-5 col-xl-6">
        <div class="row">
            <div class="col-4">
                <label for="length" class="form-label">طول</label>
                <input type="text" class="form-control form-control-solid" placeholder="سانتی متر" id="length" wire:model="length">
                @error('length') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-4">
                <label for="width" class="form-label">عرض</label>
                <input type="text" class="form-control form-control-solid" placeholder="سانتی متر" id="width" wire:model="width">
                @error('width') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-4">
                <label for="height" class="form-label">ارتفاع</label>
                <input type="text" class="form-control form-control-solid" placeholder="سانتی متر" id="height" wire:model="height">
                @error('height') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-6">
        <label class="form-label">واحد های اندازه گیری</label>
        <select class="form-select form-select-solid" wire:model="measurement_unit">
            <option value="">انتخاب کنید</option>
            <option value="meter">متر</option>
            <option value="centimeter">سانتی متر</option>
            <option value="block">قواره</option>
            <option value="quantity">تعداد</option>
        </select>
        @error('measurement_unit') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="col-12 col-xl-6">
        <label class="form-label">نوع حمل و نقل نهایی</label>
        <select class="form-select form-select-solid" wire:model="transport_type">
            <option value="domestic" selected>داخلی</option>
            <option value="distribution_network">شبکه توزیع</option>
        </select>
        @error('transport_type') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="col-12 col-xl-6 mt-4">
        <label class="form-label required">کلاس محاسبه هزینه حمل</label>
        <select class="form-select form-select-solid" wire:model="cost_calculation_class">
            <option value="fixed_rate" selected>نرخ ثابت</option>
            <option value="weight_based">بر اساس وزن</option>
            <option value="volume_based">بر اساس حجم</option>
            <option value="value_based">بر اساس ارزش</option>
        </select>
        @error('cost_calculation_class') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="col-12 mt-4">
        <button type="button" class="btn btn-primary" wire:click="save">ذخیره</button>
        @if (session()->has('message'))
            <div class="alert alert-success mt-3">
                {{ session('message') }}
            </div>
        @endif
    </div>
</div>
