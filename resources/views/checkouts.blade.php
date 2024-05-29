@extends('layouts.primary')

@section('title', 'درگاه پرداخت')

@section('content')
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">لیست روش ها</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-transfer-tab" data-bs-toggle="pill" data-bs-target="#pills-transfer" type="button" role="tab" aria-controls="pills-transfer" aria-selected="false">انتقال مستقیم بانکی</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-check-tab" data-bs-toggle="pill" data-bs-target="#pills-check" type="button" role="tab" aria-controls="pills-check" aria-selected="false">پرداخت چک</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-cod-tab" data-bs-toggle="pill" data-bs-target="#pills-cod" type="button" role="tab" aria-controls="pills-cod" aria-selected="false">پرداخت هنگام دریافت</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-zarinpal-tab" data-bs-toggle="pill" data-bs-target="#pills-zarinpal" type="button" role="tab" aria-controls="pills-zarinpal" aria-selected="false">پرداخت زرین پال</button>
    </li>
</ul>

<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="card">
            <div class="card-body">
                <table id="order_table" class="table gy-5 gs-7 tw-align-middle">
                    <thead>
                        <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                            <th class="cursor-pointer px-0 text-start">روش</th>
                            <th class="cursor-pointer px-0 text-start">فعال شده</th>
                            <th class="text-end">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <span>انتقال مستقیم بانکی</span>
                            </td>
                            <td>
                                <span class="badge badge-light-success">فعال</span>
                            </td>
                            <td class="text-end">
                                <a href="#" class="btn btn-light btn-active-light-info btn-sm tw-w-max" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                    عملیات
                                    <span class="svg-icon fs-5 m-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                            </g>
                                        </svg>
                                    </span>
                                </a>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-info fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">
                                            فعال کردن
                                        </a>
                                    </div>
                                    <!--end::Menu item-->

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">
                                            غیر فعال کردن
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>پرداخت زرین پال</span>
                            </td>
                            <td>
                                <span class="badge badge-light-danger">غیرفعال</span>
                            </td>
                            <td class="text-end">
                                <a href="#" class="btn btn-light btn-active-light-info btn-sm tw-w-max" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                    عملیات
                                    <span class="svg-icon fs-5 m-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                            </g>
                                        </svg>
                                    </span>
                                </a>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-info fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">
                                            فعال کردن
                                        </a>
                                    </div>
                                    <!--end::Menu item-->

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">
                                            غیر فعال کردن
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-transfer" role="tabpanel" aria-labelledby="pills-transfer-tab">
        <div class="alert alert-danger">
            این روش پرداخت غیرفعال است.
        </div>
        <div class="card">
            <div class="card-body">
                <div>
                    <label for="" class="form-label">عنوان</label>
                    <input type="text" class="form-control" placeholder="عنوان را وارد کنید" disabled>
                </div>
                <h4 class="my-6">اطلاعات حساب بانکی</h4>
                <div class="other_repeater">
                    <!--begin::Form group-->
                    <div class="form-group">
                        <!-- data-repeater-list must be unique -->
                        <!-- data-repeater-list must be unique -->
                        <!-- data-repeater-list must be unique -->
                        <!-- data-repeater-list must be unique -->
                        <!-- data-repeater-list must be unique -->
                        <div data-repeater-list="pattern_repeater">
                            <div class="mt-3" data-repeater-item>
                                <div class="form-group row">
                                    <div class="col-12 col-md">
                                        <label class="form-label required">نام بانک:</label>
                                        <input name="option[bankname]" type="text" class="form-control mb-2 mb-md-0" placeholder="نام بانک را وارد کنید" />
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="form-label required">شماره حساب:</label>
                                        <input name="option[accountnumber]" type="text" class="form-control mb-2 mb-md-0" placeholder="شماره حساب را وارد کنید" />
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="form-label">شماره کارت:</label>
                                        <input name="option[cardnumber]" type="text" class="form-control mb-2 mb-md-0" placeholder="شماره کارت را وارد کنید" />
                                    </div>
                                    <div class="col-12 col-md">
                                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                            حذف
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Form group-->

                    <!--begin::Form group-->
                    <div class="form-group mt-5">
                        <a href="javascript:;" data-repeater-create class="btn btn-primary btn-sm">
                            افزودن
                            <i class="ki-duotone ki-plus fs-3 pe-0"></i>
                        </a>
                    </div>
                    <!--end::Form group-->
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-check" role="tabpanel" aria-labelledby="pills-check-tab">
        <div class="card">
            <div class="card-body">
                <div>
                    <label for="" class="form-label">عنوان</label>
                    <input type="text" class="form-control" placeholder="عنوان را وارد کنید">
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-cod" role="tabpanel" aria-labelledby="pills-cod-tab">
        <div class="card">
            <div class="card-body">
                <div>
                    <label for="" class="form-label">عنوان</label>
                    <input type="text" class="form-control" placeholder="عنوان را وارد کنید">
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-zarinpal" role="tabpanel" aria-labelledby="pills-zarinpal-tab">
        <div class="card">
            <div class="card-body">
                <div>
                    <label for="" class="form-label">عنوان</label>
                    <input type="text" class="form-control" placeholder="عنوان را وارد کنید">
                </div>
                <h4 class="my-6">تنظیمات حساب زرین پال</h4>
                <div class="form-group row">
                    <label class="col-3 col-form-label">مرچنت کد</label>
                    <div class="col-9">
                        <input class="form-control" type="text" value="1234567890">
                    </div>
                </div>
                <h4 class="mb-6 mt-10">تنظیمات عملیات پرداخت</h4>
                <div class="form-group row mb-5">
                    <label class="col-3 col-form-label">پیام پرداخت موفق</label>
                    <div class="col-9">
                        <textarea class="form-control" rows="3">پرداخت با موفقیت انجام شد.</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">پیام پرداخت ناموفق</label>
                    <div class="col-9">
                        <textarea class="form-control" rows="3">پرداخت ناموفق بود.</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script-before')
<script src="{{asset('plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
@endsection
@section('scripts')
<script>
    $(".other_repeater").repeater({
        initEmpty: false,
        show: function() {
            $(this).slideDown();
        },

        hide: function(deleteElement) {
            $(this).slideUp(deleteElement);
        }
    });
</script>
@endsection