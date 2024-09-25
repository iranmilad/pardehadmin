@extends('layouts.primary')

@if(Route::is('products-loop.edit'))
    @section('title', 'ویرایش حلقه محصولات')
@else
    @section('title', 'ایجاد حلقه محصولات')
@endif

@section('content')
<form action="{{ isset($blockWidget) ? route('products-loop.update', $blockWidget->id) : route('products-loop.store') }}" method="POST" x-data="{ themeType: '{{ isset($blockWidget) && isset($setting->type) ? $setting->type : '' }}' }">
    @csrf
    @if(isset($blockWidget))
        @method('PUT')
    @else
    <input type="hidden" name="widget_id" value="{{ $widget->id }}">
    @endif
    <div class="card">
        <div class="card-body">
            <!-- Title Input -->
            <div class="form-group row mb-5">
                <label for="title" class="col-2 form-label fw-bold">عنوان:</label>
                <div class="col-10">
                    <input placeholder="عنوان را وارد کنید" type="text" class="form-control form-control-solid" name="title" value="{{ isset($blockWidget) && isset($setting->title) ? $setting->title : '' }}">
                </div>
            </div>

            <!-- Category Input -->
            <div class="form-group row mb-5">
                <label for="category" class="col-2 form-label fw-bold">گروه محصولات:</label>
                <div class="col-10">
                    @php
                        $selectedCategory = (isset($category)) ? [["id" => $category->id, "text" => $category->title]] : [];
                    @endphp
                    <x-advanced-search type="category" label="" name="category_id" :selected="$selectedCategory"/>
                </div>
            </div>

            <!-- Item Count Input -->
            <div class="form-group row mb-5">
                <label for="item_count" class="col-2 form-label fw-bold">تعداد آیتم‌ها:</label>
                <div class="col-10">
                    <input placeholder="تعداد آیتم‌ها را وارد کنید" type="number" class="form-control form-control-solid" name="count" value="{{ isset($blockWidget) && isset($setting->count) ? $setting->count : '' }}">
                </div>
            </div>

            <!-- Button Link Input -->
            <div class="form-group row mb-5">
                <label for="button_link" class="col-2 form-label fw-bold">لینک دکمه:</label>
                <div class="col-10">
                    <input placeholder="لینک دکمه را وارد کنید" type="text" class="form-control form-control-solid" name="link" value="{{ isset($blockWidget) && isset($setting->link) ? $setting->link : '' }}">
                </div>
            </div>

            <!-- Display Type -->
            <div class="form-group row mb-5">
                <label for="type" class="col-2 form-label fw-bold">نوع :</label>
                <div class="col-10">
                    <select name="type" data-control="select2" data-hide-search="true" class="form-select form-select-solid">
                        <option value="discount product" {{ (isset($blockWidget) && $blockWidget->type == 'discount product') ? 'selected' : '' }}>محصول تخفیف دار</option>
                        <option value="new product" {{ (isset($blockWidget) && $blockWidget->type == 'new product') ? 'selected' : '' }}>محصول جدید</option>
                        <option value="category" {{ (isset($blockWidget) && $blockWidget->type == 'category') ? 'selected' : '' }}>دسته بندی</option>
                    </select>
                </div>
            </div>

            <!-- Theme Type -->
            <div class="form-group row mb-5 d-none">
                <label for="theme_type" class="col-2 form-label fw-bold">نوع نمایش:</label>
                <div class="col-10">
                    <select name="theme_type" x-model="themeType" class="form-select form-select-solid">
                        <option value="simple" {{ (isset($blockWidget) && isset($setting->type) && $setting->type == 'simple') ? 'selected' : '' }}>ساده</option>
                        <option value="series" {{ (isset($blockWidget) && isset($setting->type) && $setting->type == 'series') ? 'selected' : '' }}>فروش ویژه</option>
                        <option value="special" {{ (isset($blockWidget) && isset($setting->type) && $setting->type == 'special') ? 'selected' : '' }}>دسته بندی ها</option>
                    </select>
                </div>
            </div>

            <!-- Sort Order -->
            <div class="form-group row mb-5">
                <label for="sort_order" class="col-2 form-label fw-bold">مرتب سازی:</label>
                <div class="col-10">
                    <select name="sort_order" class="form-select form-select-solid">
                        <option value="asc" {{ (isset($blockWidget) && isset($setting->sort_order) && $setting->sort_order == 'asc') ? 'selected' : '' }}>صعودی</option>
                        <option value="desc" {{ (isset($blockWidget) && isset($setting->sort_order) && $setting->sort_order == 'desc') ? 'selected' : '' }}>نزولی</option>
                        <option value="random" {{ (isset($blockWidget) && isset($setting->sort_order) && $setting->sort_order == 'random') ? 'selected' : '' }}>تصادفی</option>
                    </select>
                </div>
            </div>

            <!-- On Sale Products and Date Range -->
            <div class="form-group row mb-5" x-show="themeType === 'onsale'" x-cloak>
                <label for="products" class="col-2 form-label fw-bold">انتخاب محصول:</label>
                <div class="col-10">
                    <x-advanced-search type="product" label="" name="products" solid />
                </div>
            </div>

            <div class="form-group row mb-5" x-show="themeType === 'onsale'" x-cloak>
                <label for="date_range" class="col-2 form-label fw-bold">انتخاب بازه زمانی:</label>
                <div class="col-10">
                    <input class="form-control form-control-solid date_time" type="text" name="date_range" value="{{ isset($blockWidget) && isset($setting->date_range) ? $setting->date_range : '' }}">
                </div>
            </div>

            <!-- Show Timer Option -->
            <div class="form-group row mb-5 d-none">
                <label for="show_timer" class="col-2 form-label fw-bold">نمایش زمان تخفیف هر باکس:</label>
                <div class="col-10">
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" name="show_timer" id="show_timer" {{ (isset($blockWidget) && isset($setting->show_timer) && $setting->show_timer) ? 'checked' : '' }}>
                        <label class="form-check-label" for="show_timer">
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
