@extends('layouts.primary')

@section('title', 'تنظیمات رتبه‌بندی')

@section('content')
<form action="{{ route('score-groups.setting.edit') }}" method="POST">
    @csrf
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">تنظیمات رتبه‌بندی</h5>

            <div class="form-group row mb-5">
                <label for="positive_payment" class="col-2 form-label">امتیاز خرید نقدی:</label>
                <div class="col-10">
                    <input type="number" name="settings[positive_payment]" id="positive_payment" class="form-control form-control-solid" value="{{ old('settings[positive_payment]', $settings['positive_payment'] ?? '') }}">
                    <span class="text-muted">  در ازای هر 100000 تومان</span>
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="on_time_payment" class="col-2 form-label">تعجیل در پرداخت:</label>
                <div class="col-10">
                    <input type="number" name="settings[on_time_payment]" id="on_time_payment" class="form-control form-control-solid" value="{{ old('settings[on_time_payment]', $settings['on_time_payment'] ?? '') }}">
                    <span class="text-muted">  در ازای هر روز زودتر</span>
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="sales_score" class="col-2 form-label">امتیاز خرید:</label>
                <div class="col-10">
                    <input type="number" name="settings[sales_score]" id="sales_score" class="form-control form-control-solid" value="{{ old('settings[sales_score]', $settings['sales_score'] ?? '') }}">
                    <span class="text-muted">  در ازای هر 100000 تومان</span>
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="delayed_payment" class="col-2 form-label">امتیاز تاخیر پرداخت:</label>
                <div class="col-10">
                    <input type="number" name="settings[delayed_payment]" id="delayed_payment" class="form-control form-control-solid" value="{{ old('settings[delayed_payment]', $settings['delayed_payment'] ?? '') }}">
                    <span class="text-muted">  در ازای هر روز تاخیر</span>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success mt-10">ذخیره</button>
</form>
@endsection
