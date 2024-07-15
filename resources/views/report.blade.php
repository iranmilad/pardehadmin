@extends('layouts.primary')

@section('title', 'ایجاد گزارش')

@section('content')
<form action="">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="form-group row mb-5 align-items-center">
                <label for="" class="col-2 form-label">سفارش</label>
                <div class="col-10">
                    <x-advanced-search type="order" label="" name="user" solid />
                </div>
            </div>
            <div class="form-group row mb-5 align-items-center">
                <label for="" class="col-2 form-label">تاریخ</label>
                <div class="col-10">
                    <input type="text" class="date_time form-control-solid" placeholder="انتخاب تاریخ">
                </div>
            </div>
            <div class="form-group row mb-5 align-items-center">
                <label for="" class="col-2 form-label">وضعیت</label>
                <div class="col-10">
                    <select name="" id="" class="form-select form-select-solid" data-control="select2">
                        <option value="">در حال انجام</option>
                        <option value="">لغو شده</option>
                        <option value="">در انتظار بررسی</option>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-5 align-items-center">
                <label for="" class="col-2 form-label">نوع تسویه</label>
                <div class="col-10">
                    <select name="" id="" class="form-select form-select-solid" data-control="select2">
                        <option value="">اقساط</option>
                        <option value="">کارت به کارت</option>
                        <option value="">درگاه بانکی</option>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-5 align-items-center">
                <label for="" class="col-2 form-label">مجموع خدمت</label>
                <div class="col-10">
                    <div class="input-group ">
                        <input type="text" class="form-control form-control-solid" placeholder="مجموع خدمت را وارد کنید">
                        <span class="btn btn-secondary" id="basic-addon1">تومان</span>
                    </div>
                </div>
            </div>
            <div class="form-group row mb-5 align-items-center">
                <label for="" class="col-2 form-label">کمیسیون سایت</label>
                <div class="col-10">
                    <div class="input-group ">
                        <input type="text" class="form-control form-control-solid" placeholder="کمیسیون سایت را وارد کنید">
                        <span class="btn btn-secondary" id="basic-addon1">تومان</span>
                    </div>
                </div>
            </div>
            <div class="form-group row mb-5 align-items-center">
                <label for="" class="col-2 form-label">شماره سررسید</label>
                <div class="col-10">
                    <div class="input-group ">
                        <input type="text" class="form-control form-control-solid" placeholder="شماره سررسید را وارد کنید">
                    </div>
                </div>
            </div>
            <div class="form-group row mb-5 align-items-center">
                <label for="" class="col-2 form-label">شماره تراکنش</label>
                <div class="col-10">
                    <div class="input-group ">
                        <input type="text" class="form-control form-control-solid" placeholder="شماره تراکنش را وارد کنید">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-success mt-10">ذخیره</button>
</form>
@endsection

@section("script-before")
<script src="{{asset('plugins/flatpicker_fa.js')}}"></script>
<script src="{{asset('plugins/jdate.min.js')}}"></script>
@endsection


@section("scripts")
<script>
    window.Date = window.JDate;
    flatpickr = $(".date_time").flatpickr({
        disableMobile: "true",
        altInput: true,
        altFormat: "Y-m-d",
        dateFormat: "Y-m-d",
        locale: "fa",
    });
</script>
@endsection