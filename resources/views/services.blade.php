@extends('layouts.primary')

@section('title', 'سرویس های شخص ثالث')

@section('content')

<form action="" method="post">
    @csrf
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                پشتیبانی آنلاین
            </h4>
        </div>
        <div class="card-body">
            <div class="mb-10">
                <label for="exampleFormControlInput1" class="required form-label">نام کاربری</label>
                <input type="text" class="form-control form-control-solid" placeholder="" />
            </div>
            <div class="mb-10">
                <label for="exampleFormControlInput1" class="required form-label">رمز عبور</label>
                <input type="password" class="form-control form-control-solid" placeholder="" />
            </div>
            <div class="mb-10">
                <label for="exampleFormControlInput1" class="required form-label">کد لایسنس</label>
                <input type="text" class="form-control form-control-solid" placeholder="" />
            </div>
            <div class="mb-10">
                <label for="exampleFormControlInput1" class="required form-label">نام سرویس</label>
                <input type="text" class="form-control form-control-solid" placeholder="" />
            </div>
            <div class="mb-10">
                <label for="exampleFormControlInput1" class="form-label">وضعیت سرویس</label>
                <select name="" id="" class="form-select form-select-solid">
                    <option value="1"> فعال</option>
                    <option value="2">غیر فعال</option>
                </select>
            </div>

            <div class="mb-10">
                <label for="exampleFormControlInput1" class="form-label">وضعیت </label>
                <select name="" id="" class="form-select form-select-solid">
                    <option value="1"> فعال</option>
                    <option value="2">غیر فعال</option>
                </select>
            </div>





        </div>
    </div>


    <!-- begin:Card -->
    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">تنظیمات فاکتور</h3>
            </div>
        </div>
        <form method="POST" class="form" action="/settings">
            @csrf
            <div class="card-body border-top p-9">
                <!--begin:: Group-->
                <div class="row mb-6">
                    <!--begin::Tags-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">اقلام فاقد کد هلو</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Col-->
                        <select name="config[invoice_items_no_holo_code]" class="form-select form-select-solid"
                            data-minimum-results-for-search="Infinity" data-control="select2"
                            data-close-on-select="true" data-placeholder="انتخاب کنید" data-allow-clear="false">
                            <option value="0" @selected($setting->config->invoice_items_no_holo_code == 0)>عدم ثبت</option>
                            <option value="1" @selected($setting->config->invoice_items_no_holo_code == 1)>ثبت تنها اقلام دارای کد هلو</option>

                        </select>
                        <!--end::Col-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::group-->
                <!--begin:: Group-->
                <div class="row mb-6">
                    <!--begin::Tags-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">وضعیت پرداخت درب محل</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Col-->
                        <select name="config[status_place_payment]" class="form-select form-select-solid"
                            data-minimum-results-for-search="Infinity" data-control="select2"
                            data-close-on-select="true" data-placeholder="انتخاب کنید" data-allow-clear="false">

                            <option value="cash" @selected($setting->config->status_place_payment == 'cash')>پرداخت نقد</option>
                            <option value="status_place_payment" @selected($setting->config->status_place_payment == 'status_place_payment')>پرداخت نسیه</option>

                        </select>
                        <!--end::Col-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::group-->
                <!--begin:: Group-->
                <div class="row mb-6">
                    <!--begin::Tags-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">قیمت فروش</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Col-->
                        <select name="config[sales_price_field]" class="form-select form-select-solid"
                            data-minimum-results-for-search="Infinity" data-control="select2"
                            data-close-on-select="true" data-placeholder="انتخاب کنید" data-allow-clear="false">

                            <option value="1" @selected($setting->config->sales_price_field == '1')>قیمت 1</option>
                            <option value="2" @selected($setting->config->sales_price_field == '2')>قیمت 2</option>
                            <option value="3" @selected($setting->config->sales_price_field == '3')>قیمت 3</option>
                            <option value="4" @selected($setting->config->sales_price_field == '4')>قیمت 4</option>
                            <option value="5" @selected($setting->config->sales_price_field == '5')>قیمت 5</option>
                            <option value="6" @selected($setting->config->sales_price_field == '6')>قیمت 6</option>
                            <option value="7" @selected($setting->config->sales_price_field == '7')>قیمت 7</option>
                            <option value="8" @selected($setting->config->sales_price_field == '8')>قیمت 8</option>
                            <option value="9" @selected($setting->config->sales_price_field == '9')>قیمت 9</option>
                            <option value="10" @selected($setting->config->sales_price_field == '10')>قیمت 10</option>
                        </select>
                        <!--end::Col-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::group-->
                <!--begin:: Group-->
                <div class="row mb-6">
                    <!--begin::Tags-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">قیمت ویژه</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Col-->
                        <select name="config[special_price_field]" class="form-select form-select-solid"
                            data-minimum-results-for-search="Infinity" data-control="select2"
                            data-close-on-select="true" data-placeholder="Select" data-allow-clear="false">
                            <option value="1" @selected($setting->config->special_price_field == '1')>قیمت 1</option>
                            <option value="2" @selected($setting->config->special_price_field == '2')>قیمت 2</option>
                            <option value="3" @selected($setting->config->special_price_field == '3')>قیمت 3</option>
                            <option value="4" @selected($setting->config->special_price_field == '4')>قیمت 4</option>
                            <option value="5" @selected($setting->config->special_price_field == '5')>قیمت 5</option>
                            <option value="6" @selected($setting->config->special_price_field == '6')>قیمت 6</option>
                            <option value="7" @selected($setting->config->special_price_field == '7')>قیمت 7</option>
                            <option value="8" @selected($setting->config->special_price_field == '8')>قیمت 8</option>
                            <option value="9" @selected($setting->config->special_price_field == '9')>قیمت 9</option>
                            <option value="10" @selected($setting->config->special_price_field == '10')>قیمت 10</option>
                        </select>
                        <!--end::Col-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::group-->
                <!--begin:: Group-->
                <div class="row mb-6">
                    <!--begin::Tags-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">قیمت عمده</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Col-->
                        <select name="config[wholesale_price_field]" class="form-select form-select-solid"
                            data-minimum-results-for-search="Infinity" data-control="select2"
                            data-close-on-select="true" data-placeholder="انتخاب کنید" data-allow-clear="false">
                            <option value="1" @selected($setting->config->wholesale_price_field == '1')>قیمت 1</option>
                            <option value="2" @selected($setting->config->wholesale_price_field == '2')>قیمت 2</option>
                            <option value="3" @selected($setting->config->wholesale_price_field == '3')>قیمت 3</option>
                            <option value="4" @selected($setting->config->wholesale_price_field == '4')>قیمت 4</option>
                            <option value="5" @selected($setting->config->wholesale_price_field == '5')>قیمت 5</option>
                            <option value="6" @selected($setting->config->wholesale_price_field == '6')>قیمت 6</option>
                            <option value="7" @selected($setting->config->wholesale_price_field == '7')>قیمت 7</option>
                            <option value="8" @selected($setting->config->wholesale_price_field == '8')>قیمت 8</option>
                            <option value="9" @selected($setting->config->wholesale_price_field == '9')>قیمت 9</option>
                            <option value="10" @selected($setting->config->wholesale_price_field == '10')>قیمت 10</option>
                        </select>
                        <!--end::Col-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::group-->
                <!--begin:: Group-->
                <div class="row mb-6">
                    <!--begin::Tags-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">موجودی محصول</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Col-->
                        <select name="config[product_stock_field]" class="form-select form-select-solid"
                            data-minimum-results-for-search="Infinity" data-control="select2"
                            data-close-on-select="true" data-placeholder="انتخاب کنید" data-allow-clear="false">
                            <option></option>
                            <option value="1" @selected($setting->config->product_stock_field == '1')>موجودی کل</option>
                            <option value="2" @selected($setting->config->product_stock_field == '2')>موجودی با کسر خورده فروشی و پیش فاکتور
                            </option>
                            <option value="3" @selected($setting->config->product_stock_field == '3')>موجودی با کسر خورده فروشی</option>
                        </select>
                        <!--end::Col-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::group-->
                <!--begin:: Group-->
                <div class="row mb-6">
                    <!--begin::Tags-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">وضعیت فاکتور فروش</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Col-->
                        <select name="config[save_sale_invoice]" class="form-select form-select-solid"
                            data-minimum-results-for-search="Infinity" data-control="select2"
                            data-close-on-select="true" data-placeholder="انتخاب کنید" data-allow-clear="false">
                            <option></option>
                            <option value="0" @selected($setting->config->save_sale_invoice == '0')>عدم ثبت</option>
                            <option value="1" @selected($setting->config->save_sale_invoice == '1')>ثبت فاکتور</option>
                            <option value="2" @selected($setting->config->save_sale_invoice == '2')>ثبت پیش فاکتور</option>
                            <option value="3" @selected($setting->config->save_sale_invoice == '3')>ثبت به عنوان سفارش</option>
                        </select>
                        <!--end::Col-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::group-->

                <!--begin:: Group-->
                <div class="row mb-6">
                    <!--begin::Tags-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">وضعیت فاکتور پیش فروش</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Col-->
                        <select name="config[save_pre_sale_invoice]" class="form-select form-select-solid"
                            data-minimum-results-for-search="Infinity" data-control="select2"
                            data-close-on-select="true" data-placeholder="انتخاب کنید" data-allow-clear="false">
                            <option></option>
                            <option value="0" @selected($setting->config->save_pre_sale_invoice == '0')>عدم ثبت</option>
                            <option value="1" @selected($setting->config->save_pre_sale_invoice == '1')>ثبت فاکتور</option>
                            <option value="2" @selected($setting->config->save_pre_sale_invoice == '2')>ثبت پیش فاکتور</option>
                            <option value="3" @selected($setting->config->save_pre_sale_invoice == '3')>ثبت به عنوان سفارش</option>
                        </select>
                        <!--end::Col-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::group-->

                <!--begin:: Group-->
                <div class="row mb-6">
                    <!--begin::Tags-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">به روزرسانی قیمت محصول</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Col-->
                        <select name="config[update_product_price]" class="form-select form-select-solid"
                            data-minimum-results-for-search="Infinity" data-control="select2"
                            data-close-on-select="true" data-placeholder="انتخاب کنید" data-allow-clear="false">
                            <option></option>
                            <option value="0" @selected($setting->config->update_product_price == '0')>غیرفعال</option>
                            <option value="1" @selected($setting->config->update_product_price == '1')>فعال</option>
                        </select>
                        <!--end::Col-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::group-->

                <!--begin:: Group-->
                <div class="row mb-6">
                    <!--begin::Tags-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">به روزرسانی موجودی محصول</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Col-->
                        <select name="config[update_product_stock]" class="form-select form-select-solid"
                            data-minimum-results-for-search="Infinity" data-control="select2"
                            data-close-on-select="true" data-placeholder="انتخاب کنید" data-allow-clear="false">
                            <option></option>
                            <option value="0" @selected($setting->config->update_product_stock == '0')>غیرفعال</option>
                            <option value="1" @selected($setting->config->update_product_stock == '1')>فعال</option>
                        </select>
                        <!--end::Col-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::group-->

                <!--begin:: Group-->
                <div class="row mb-6">
                    <!--begin::Tags-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">به روزرسانی عنوان محصول</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Col-->
                        <select name="config[update_product_name]" class="form-select form-select-solid"
                            data-minimum-results-for-search="Infinity" data-control="select2"
                            data-close-on-select="true" data-placeholder="انتخاب کنید" data-allow-clear="false">
                            <option></option>
                            <option value="0" @selected($setting->config->update_product_name == '0')>غیرفعال</option>
                            <option value="1" @selected($setting->config->update_product_name == '1')>فعال</option>
                        </select>
                        <!--end::Col-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::group-->

                <!--begin:: Group-->
                <div class="row mb-6">
                    <!--begin::Tags-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">درج محصول جدید</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Col-->
                        <select name="config[insert_new_product]" class="form-select form-select-solid"
                            data-minimum-results-for-search="Infinity" data-control="select2"
                            data-close-on-select="true" data-placeholder="انتخاب کنید" data-allow-clear="false">
                            <option></option>
                            <option value="0" @selected($setting->config->insert_new_product == '0')>غیرفعال</option>
                            <option value="1" @selected($setting->config->insert_new_product == '1')>فعال</option>
                        </select>
                        <!--end::Col-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::group-->

                <!--begin:: Group-->
                <div class="row mb-6">
                    <!--begin::Tags-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">درج محصول فاقد موجودی</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Col-->
                        <select name="config[insert_product_with_zero_inventory]"
                            class="form-select form-select-solid" data-minimum-results-for-search="Infinity"
                            data-control="select2" data-close-on-select="true" data-placeholder="انتخاب کنید"
                            data-allow-clear="false">
                            <option></option>
                            <option value="0" @selected($setting->config->insert_product_with_zero_inventory == '0')>غیرفعال</option>
                            <option value="1" @selected($setting->config->insert_product_with_zero_inventory == '1')>فعال</option>
                        </select>
                        <!--end::Col-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::group-->




            </div>
            <div class="card-footer border-0 d-flex justify-content-end py-6 px-9">
                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">ذخیره</button>
            </div>
        </form>
    </div>
    <!-- end:Card -->
    <!-- begin:Card -->
    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">تنظیمات ثبت فاکتور</h3>
            </div>
        </div>
        <form method="POST" class="form" action="/updateCustomerSarfasl">
            @csrf
            <div class="card-body border-top p-9">
                <!--begin:: Group-->
                <div class="row mb-6">
                    <!--begin::Tags-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">کد محصول هزینه ارسال</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Col-->
                        <input type="text" name="config[product_shipping]"
                            class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                            placeholder="وارد کنید" value="" />
                        <!--end::Col-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::group-->
                <!--begin:: Group-->
                <div class="row mb-6">
                    <!--begin::Tags-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">حساب مشتری</label>
                    <!--end::Tags-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Col-->
                        <input type="number" name="customer_sarfasl"
                            class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                            placeholder="شماره سرفصل حساب مشتری وارد کنید" value="{{ $setting->customer_sarfasl }}" />
                        <!--end::Col-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::group-->

                @if ($setting->fix_customer_account)
                  <!--begin:: Group-->
                  <div class="row mb-6">
                      <!--begin::Tags-->
                      <label class="col-lg-4 col-form-label fw-semibold fs-6">شناسه مشتری ثابت</label>
                      <!--end::Tags-->
                      <!--begin::Col-->
                      <div class="col-lg-8">
                          <!--begin::Col-->
                          <input type="number" name="customer_account"
                              class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                              placeholder="شماره شناسه مشتری را وارد کنید" value="{{ $setting->customer_account }}" />
                          <!--end::Col-->
                      </div>
                      <!--end::Col-->
                  </div>
                  <!--end::group-->
                @endif

            </div>
            <div class="card-footer border-0 d-flex justify-content-end py-6 px-9">
                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">ذخیره</button>
            </div>
        </form>
    </div>
    <!-- end:Card -->


</form>

@endsection
