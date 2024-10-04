@extends('layouts.primary')

@if(Route::is('landing.edit.show'))
@section('title', 'ویرایش حلقه محصولات')
@else
@section('title', 'ایجاد حلقه محصولات')
@endif

@section('content')
<form action="" x-data="{ themeType: '' }">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="form-group row mb-5">
                <label for="title" class="col-2 form-label fw-bold">عنوان:</label>
                <div class="col-10">
                    <input placeholder="عنوان را وارد کنید" type="text" class="form-control form-control-solid" name="title">
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="title" class="col-2 form-label fw-bold">تعداد آیتم ها:</label>
                <div class="col-10">
                    <input placeholder="تعداد آیتم ها را وارد کنید" type="number" class="form-control form-control-solid" name="button_text">
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="title" class="col-2 form-label fw-bold">لینک دکمه:</label>
                <div class="col-10">
                    <input placeholder="لینک دکمه را وارد کنید" type="text" class="form-control form-control-solid" name="button_link">
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="title" class="col-2 form-label fw-bold">نوع نمایش:</label>
                <div class="col-10">
                    <select name="direction" id="" data-control="select2" data-hide-search="true" class="form-select form-select-solid">
                        <option value="simple">ساده</option>
                        <option value="carousel">اسلایدر</option>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="title" class="col-2 form-label fw-bold">نوع تم:</label>
                <div class="col-10">
                    <select name="theme_type" x-model="themeType"  class="form-select form-select-solid">
                        <option value="simple">ساده</option>
                        <option value="onsale">فروش ویژه</option>
                        <option value="category">دسته بندی ها</option>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="title" class="col-2 form-label fw-bold">مرتب سازی:</label>
                <div class="col-10">
                    <select name="theme_type" x-model="themeType"  class="form-select form-select-solid">
                        <option value="asc">صعودی</option>
                        <option value="desc">نزولی</option>
                        <option value="random">تصادفی</option>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="title" class="col-2 form-label fw-bold">انتخاب محصول:</label>
                <div class="col-10">
                    <x-advanced-search type="product" label="" name="products" solid multiple />
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="title" class="col-2 form-label fw-bold">انتخاب دسته بندی:</label>
                <div class="col-10">
                    <x-advanced-search type="category" label="" name="category" solid multiple />
                </div>
            </div>
            <!-- بازه زمانی input field will only be shown when themeType is "onsale" -->
            <div class="form-group row mb-5" x-show="themeType === 'onsale'" x-cloak>
                <label for="title" class="col-2 form-label fw-bold">انتخاب بازه زمانی:</label>
                <div class="col-10">
                    <input class="form-control form-control-solid date_time" type="text">
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="title" class="col-2 form-label fw-bold">نمایش زمان تخفیف هر باکس:</label>
                <div class="col-10">
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="" id="flexSwitchDefault" />
                        <label class="form-check-label" for="flexSwitchDefault">
                            فعال
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-success mt-10" type="submit">ذخیره</button>
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
        mode: "range",
        disableMobile: "true",
        altInput: true,
        altFormat: "Y-m-d",
        dateFormat: "Y-m-d",
        locale: "fa",
        enableTime: false,
        monthSelectorType: "static"
    });
</script>
@endsection
