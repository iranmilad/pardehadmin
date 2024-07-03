@extends('layouts.primary')

@section('title', 'سرویس های شخص ثالث')

@section('content')

<form action="{{ route('settings.holo.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                پشتیبانی آنلاین
            </h4>
        </div>
        <div class="card-body">
            <div class="mb-10">
                <label for="username" class="required form-label">نام کاربری</label>
                <input type="text" name="username" class="form-control form-control-solid" placeholder="" value="{{ old('username', $setting->settings['username']) }}" />
            </div>
            <div class="mb-10">
                <label for="password" class="required form-label">رمز عبور</label>
                <input type="password" name="password" class="form-control form-control-solid" placeholder="" value="{{ old('password', $setting->settings['password']) }}" />
            </div>
            <div class="mb-10">
                <label for="license_code" class="required form-label">کد لایسنس</label>
                <input type="text" name="license_code" class="form-control form-control-solid" placeholder="" value="{{ old('license_code', $setting->settings['license_code']) }}" />
            </div>
            <div class="mb-10">
                <label for="service_name" class="required form-label">نام سرویس</label>
                <input type="text" name="service_name" class="form-control form-control-solid" placeholder="" value="{{ old('service_name', $setting->settings['service_name']) }}" />
            </div>
            <div class="mb-10">
                <label for="service_status" class="form-label">وضعیت سرویس</label>
                <select name="service_status" class="form-select form-select-solid">
                    <option value="1" @selected(old('service_status', $setting->settings['service_status']) == 1)>فعال</option>
                    <option value="2" @selected(old('service_status', $setting->settings['service_status']) == 2)>غیر فعال</option>
                </select>
            </div>
            <div class="mb-10">
                <label for="status" class="form-label">وضعیت</label>
                <select name="status" class="form-select form-select-solid">
                    <option value="1" @selected(old('status', $setting->settings['status']) == 1)>فعال</option>
                    <option value="2" @selected(old('status', $setting->settings['status']) == 2)>غیر فعال</option>
                </select>
            </div>
        </div>
    </div>


    <div class="card mt-5 mb-5 mb-xl-10">
        <div class="card-header border-0">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">تنظیمات فاکتور</h3>
            </div>
        </div>
        <div class="card-body border-top p-9">
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">اقلام فاقد کد هلو</label>
                <div class="col-lg-8">
                    <select name="invoice_items_no_holo_code" class="form-select form-select-solid"
                        data-minimum-results-for-search="Infinity" data-control="select2"
                        data-close-on-select="true" data-placeholder="انتخاب کنید" data-allow-clear="false">
                        <option value="0" @if(old('invoice_items_no_holo_code', $setting->settings['invoice_items_no_holo_code'] ?? null) == 0) selected @endif>عدم ثبت</option>
                        <option value="1" @if(old('invoice_items_no_holo_code', $setting->settings['invoice_items_no_holo_code'] ?? null) == 1) selected @endif>ثبت تنها اقلام دارای کد هلو</option>
                    </select>
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">وضعیت پرداخت درب محل</label>
                <div class="col-lg-8">
                    <select name="status_place_payment" class="form-select form-select-solid"
                        data-minimum-results-for-search="Infinity" data-control="select2"
                        data-close-on-select="true" data-placeholder="انتخاب کنید" data-allow-clear="false">
                        <option value="cash" @if(old('status_place_payment', $setting->settings['status_place_payment'] ?? null) == 'cash') selected @endif>پرداخت نقد</option>
                        <option value="status_place_payment" @if(old('status_place_payment', $setting->settings['status_place_payment'] ?? null) == 'status_place_payment') selected @endif>پرداخت نسیه</option>
                    </select>
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">قیمت فروش</label>
                <div class="col-lg-8">
                    <select name="sales_price_field" class="form-select form-select-solid"
                        data-minimum-results-for-search="Infinity" data-control="select2"
                        data-close-on-select="true" data-placeholder="انتخاب کنید" data-allow-clear="false">
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" @if(old('sales_price_field', $setting->settings['sales_price_field'] ?? null) == $i) selected @endif>قیمت {{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">قیمت ویژه</label>
                <div class="col-lg-8">
                    <select name="special_price_field" class="form-select form-select-solid"
                        data-minimum-results-for-search="Infinity" data-control="select2"
                        data-close-on-select="true" data-placeholder="انتخاب کنید" data-allow-clear="false">
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" @if(old('special_price_field', $setting->settings['special_price_field'] ?? null) == $i) selected @endif>قیمت {{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">قیمت عمده</label>
                <div class="col-lg-8">
                    <select name="wholesale_price_field" class="form-select form-select-solid"
                        data-minimum-results-for-search="Infinity" data-control="select2"
                        data-close-on-select="true" data-placeholder="انتخاب کنید" data-allow-clear="false">
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" @if(old('wholesale_price_field', $setting->settings['wholesale_price_field'] ?? null) == $i) selected @endif>قیمت {{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">موجودی محصول</label>
                <div class="col-lg-8">
                    <select name="product_stock_field" class="form-select form-select-solid"
                        data-minimum-results-for-search="Infinity" data-control="select2"
                        data-close-on-select="true" data-placeholder="انتخاب کنید" data-allow-clear="false">
                        <option></option>
                        <option value="1" @if(old('product_stock_field', $setting->settings['product_stock_field'] ?? null) == '1') selected @endif>موجودی کل</option>
                        <option value="2" @if(old('product_stock_field', $setting->settings['product_stock_field'] ?? null) == '2') selected @endif>موجودی با کسر خورده فروشی و پیش فاکتور</option>
                        <option value="3" @if(old('product_stock_field', $setting->settings['product_stock_field'] ?? null) == '3') selected @endif>موجودی با کسر خورده فروشی</option>
                    </select>
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">وضعیت فاکتور فروش</label>
                <div class="col-lg-8">
                    <select name="save_sale_invoice" class="form-select form-select-solid"
                        data-minimum-results-for-search="Infinity" data-control="select2"
                        data-close-on-select="true" data-placeholder="انتخاب کنید" data-allow-clear="false">
                        <option></option>
                        <option value="0" @if(old('save_sale_invoice', $setting->settings['save_sale_invoice'] ?? null) == '0') selected @endif>غیر فعال</option>
                        <option value="1" @if(old('save_sale_invoice', $setting->settings['save_sale_invoice'] ?? null) == '1') selected @endif>ثبت به صورت خودکار</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end py-6 px-9">
            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">ذخیره تغییرات</button>
        </div>
    </div>
</form>

@endsection
