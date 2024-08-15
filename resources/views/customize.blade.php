@extends('layouts.primary')

@section('title', 'شخصی سازی')

@section('content')

<!--begin::Accordion-->
<div class="container my-5">
    <div id="accordionExample" class="accordion">

        <!-- Step 1 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <span class="badge bg-light badge-circle badge-lg me-2" id="badge1">1</span>
                    تنظیمات سایت
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <!-- Content for Step 1 -->
                    <div class="flex-column current" data-kt-stepper-element="content">
                        <div class="mb-10">
                            <label for="" class="form-label">نام سایت</label>
                            <input type="text" class="form-control" name="site[name]" />
                        </div>
                        <div class="mb-10">
                            <label for="" class="form-label">آدرس سایت</label>
                            <input type="text" class="form-control" name="site[url]" />
                        </div>
                        <div class="mb-10">
                            <label for="" class="form-label">توضیحات سایت</label>
                            <textarea name="site[description]" class="form-control"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div>
                                    <label for="" class="form-label">لوگو</label>
                                    <x-file-input type="single" :preview="true" name="pic" />
                                </div>
                            </div>
                            <div class="col-3">
                                <div>
                                    <label class="form-label">فاوآیکون</label>
                                    <x-file-input type="single" :preview="true" name="favicon" value="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <span class="badge bg-light badge-circle badge-lg me-2" id="badge2">2</span>
                    تنظیمات نمایشی
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <!-- Content for Step 2 -->
                    <div class="flex-column" data-kt-stepper-element="content">
                        <div class="row">
                            <div class="col-3">
                                <div class="mb-10">
                                    <label for="" class="form-label">رنگ اصلی</label>
                                    <input type="hidden" name="color['primary']" value="#AB0000">
                                    <div class="color-picker"></div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-10">
                                    <label for="" class="form-label">رنگ پس‌زمینه</label>
                                    <input type="hidden" name="color['bg-background']" value="#fff">
                                    <div class="color-picker"></div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-10">
                                    <label for="" class="form-label">رنگ پس‌زمینه هدر</label>
                                    <input type="hidden" name="color['header-bg']" value="#EBEDF06B">
                                    <div class="color-picker"></div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-10">
                                    <label for="" class="form-label">رنگ عناوین</label>
                                    <input type="hidden" name="color['title']" value="#1e293b">
                                    <div class="color-picker"></div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-10">
                                    <label for="" class="form-label">رنگ دکمه ی باکس محصول</label>
                                    <input type="hidden" name="color['product-card']" value="#10b981">
                                    <div class="color-picker"></div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-10">
                                    <label for="" class="form-label">رنگ هاور دکمه ی باکس محصول</label>
                                    <input type="hidden" name="color['product-card-hover']" value="#1e293b">
                                    <div class="color-picker"></div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-10">
                                    <label for="" class="form-label">رنگ نشان تخفیف ها</label>
                                    <input type="hidden" name="color['sale-badge']" value="#ef4444">
                                    <div class="color-picker"></div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-10">
                                    <label for="" class="form-label">رنگ باکس وبلاگ در صفحه اصلی</label>
                                    <input type="hidden" name="color['blog-box-bg']" value="#fbbf24">
                                    <div class="color-picker"></div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-10">
                                    <label for="" class="form-label">رنگ پس‌زمینه فروش ویژه</label>
                                    <input type="hidden" name="color['footer']" value="#ff3a4e">
                                    <div class="color-picker"></div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-10">
                                    <label for="" class="form-label">رنگ پس‌زمینه فوتر</label>
                                    <input type="hidden" name="color['best-suggestion']" value="#1e293b">
                                    <div class="color-picker"></div>
                                </div>
                            </div>
                        </div>
                        <!--begin::Input group-->
                        <div class="fv-row mb-5">
                            <!--begin::Label-->
                            <label class="form-label">فونت نمایشی</label>
                            <!--end::Label-->
                        </div>
                        <!--end::Input group-->
                        <div class="row g-5" data-kt-buttons="true" data-kt-buttons-target=".form-check-image, .form-check-input">
                            <!-- start::Col -->
                            <div class="col-6 col-md-3">
                                <label class="form-check-image active">
                                    <div class="form-check-wrapper">
                                        <img src="/images/iransans.png" />
                                    </div>

                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="radio" checked value="1" name="theme[fontfamily]" />
                                        <div class="form-check-label">
                                            ایران سنس
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <!--end::Col-->
                            <!-- start::Col -->
                            <div class="col-6 col-md-3">
                                <label class="form-check-image">
                                    <div class="form-check-wrapper">
                                        <img src="/images/iranyekan.png" />
                                    </div>

                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="radio" value="1" name="theme[fontfamily]" />
                                        <div class="form-check-label">
                                            ایران یکان
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <!--end::Col-->
                            <!-- start::Col -->
                            <div class="col-6 col-md-3">
                                <label class="form-check-image ">
                                    <div class="form-check-wrapper">
                                        <img src="/images/dana.png" />
                                    </div>

                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="radio" value="1" name="theme[fontfamily]" />
                                        <div class="form-check-label">
                                            دانا
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <!--end::Col-->
                            <!-- start::Col -->
                            <div class="col-6 col-md-3">
                                <label class="form-check-image">
                                    <div class="form-check-wrapper">
                                        <img src="/images/vazir.png" />
                                    </div>

                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="radio" value="1" name="theme[fontfamily]" />
                                        <div class="form-check-label">
                                            وزیر
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <!--end::Col-->
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <span class="badge bg-light badge-circle badge-lg me-2" id="badge3">3</span>
                    باکس محصولات
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <!-- Content for Step 3 -->
                    <div class="flex-column" data-kt-stepper-element="content">
                        <div class="form-check form-switch form-check-custom form-check-solid mb-5">
                            <input class="form-check-input" type="checkbox" value="" id="flexSwitchDefault" />
                            <label class="form-check-label" for="flexSwitchDefault">
                                نمایش تصویر ثانویه
                            </label>
                        </div>

                        <div class="form-check form-switch form-check-custom form-check-solid mb-5">
                            <input class="form-check-input" type="checkbox" value="" id="flexSwitchDefault2" />
                            <label class="form-check-label" for="flexSwitchDefault2">
                                نمایش شمارنده تخفیف
                            </label>
                        </div>

                        <div class="row g-5" data-kt-buttons="true" data-kt-buttons-target=".form-check-image, .form-check-input">
                            <!-- start::Col -->
                            <div class="col-6">
                                <label class="form-check-image active">
                                    <div class="form-check-wrapper">
                                        <img src="/images/round.png" />
                                    </div>

                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="radio" checked value="1" name="theme[fontfamily]" />
                                        <div class="form-check-label">
                                            گرد
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <!--end::Col-->
                            <!-- start::Col -->
                            <div class="col-6">
                                <label class="form-check-image">
                                    <div class="form-check-wrapper">
                                        <img src="/images/shape.png" />
                                    </div>

                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="radio" value="1" name="theme[fontfamily]" />
                                        <div class="form-check-label">
                                            تیز
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <!--end::Col-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 4 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    <span class="badge bg-light badge-circle badge-lg me-2" id="badge4">4</span>
                    صفحه ی محصول
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <!-- Content for Step 4 -->
                    <div class="flex-column" data-kt-stepper-element="content">
                        <!--begin::Input group-->
                        <div class="fv-row mb-4">
                            <!--begin::Label-->
                            <label class="form-label">تب ها</label>
                            <!--end::Label-->
                        </div>
                        <!--end::Input group-->
                        <div id="product_tabs_sortable">
                            <div class="tw-w-full mb-3 tw-rounded-md tw-p-5 tw-bg-gray-100 tw-border tw-border-solid tw-border-gray-200 tw-cursor-grab">
                                <i class="fas fa-arrows-alt tw-mr-2"></i>
                                <span>مشخصات</span>
                                <input type="hidden" name="option[tab]" value="specifications">
                            </div>
                            <div class="tw-w-full mb-3 tw-rounded-md tw-p-5 tw-bg-gray-100 tw-border tw-border-solid tw-border-gray-200 tw-cursor-grab">
                                <i class="fas fa-arrows-alt tw-mr-2"></i>
                                <span>توضیحات</span>
                                <input type="hidden" name="option[tab]" value="description">
                            </div>
                            <div class="tw-w-full mb-3 tw-rounded-md tw-p-5 tw-bg-gray-100 tw-border tw-border-solid tw-border-gray-200 tw-cursor-grab">
                                <i class="fas fa-arrows-alt tw-mr-2"></i>
                                <span>نظرات</span>
                                <input type="hidden" name="option[tab]" value="comments">
                            </div>
                            <div class="tw-w-full mb-3 tw-rounded-md tw-p-5 tw-bg-gray-100 tw-border tw-border-solid tw-border-gray-200 tw-cursor-grab">
                                <i class="fas fa-arrows-alt tw-mr-2"></i>
                                <span>راهنمای اندازه گیری</span>
                                <input type="hidden" name="option[tab]" value="measureguide">
                            </div>
                            <div class="tw-w-full mb-3 tw-rounded-md tw-p-5 tw-bg-gray-100 tw-border tw-border-solid tw-border-gray-200 tw-cursor-grab">
                                <i class="fas fa-arrows-alt tw-mr-2"></i>
                                <span>ویدیو</span>
                                <input type="hidden" name="option[tab]" value="video">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 5 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    <span class="badge bg-light badge-circle badge-lg me-2" id="badge5">5</span>
                    هدر و فوتر
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <!-- Content for Step 5 -->
                    <div class="flex-column" data-kt-stepper-element="content">
                        <div class="mb-10">
                            <label for="" class="form-label">تعداد ستون های فوتر</label>
                            <select name="" id="" class="form-select">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                        <div>
                            <label for="" class="form-label">حالت هدر</label>
                            <div class="row g-5" data-kt-buttons="true" data-kt-buttons-target=".form-check-image, .form-check-input">
                                <!-- start::Col -->
                                <div class="col-6 col-md-3">
                                    <label class="form-check-image active">
                                        <div class="form-check-wrapper">
                                            <img src="/images/header1.png" />
                                        </div>

                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" checked value="1" name="theme[fontfamily]" />
                                            <div class="form-check-label">
                                                حالت اول
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <!--end::Col-->
                                <!-- start::Col -->
                                <div class="col-6 col-md-3">
                                    <label class="form-check-image">
                                        <div class="form-check-wrapper">
                                            <img src="/images/header2.png" />
                                        </div>

                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" value="1" name="theme[fontfamily]" />
                                            <div class="form-check-label">
                                                حالت دوم
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <!--end::Col-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 6 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    <span class="badge bg-light badge-circle badge-lg me-2" id="badge6">6</span>
                    صفحات احراز هویت
                </button>
            </h2>
            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <!-- Content for Step 6 -->
                    <div class="flex-column" data-kt-stepper-element="content">
                        <div class="row g-4">
                            <div class="col-6 col-md-3">
                                <label for="" class="form-label d-block">بنر ورود</label>
                                <x-file-input type="single" :preview="true" name="pic" />
                            </div>

                            <div class="col-6 col-md-3">
                                <label for="" class="form-label d-block">بنر ثبت نام</label>
                                <x-file-input type="single" :preview="true" name="pic" />
                            </div>

                            <div class="col-6 col-md-3">
                                <label for="" class="form-label d-block">بنر فراموشی رمز عبور</label>
                                <x-file-input type="single" :preview="true" name="pic" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 7 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSeven">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                    <span class="badge bg-light badge-circle badge-lg me-2" id="badge7">7</span>
                    مرحله انتخاب کننده ویدئو
                </button>
            </h2>
            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <!-- Content for Step 7 -->
                    <div class="flex-column" data-kt-stepper-element="content">
                        <div>
                            <label for="" class="form-label">انتخاب ویدئو</label>
                            <x-file-input type="single" :preview="false" name="video" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 8 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingEight">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                    <span class="badge bg-light badge-circle badge-lg me-2" id="badge8">8</span>
                    انتخاب ساختار
                </button>
            </h2>
            <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <!-- Content for Step 8 -->
                    <div class="flex-column" data-kt-stepper-element="content">
                        <div class="mb-10">
                            <label for="" class="form-label">حالت ساختار</label>
                            <div class="row g-5" data-kt-buttons="true" data-kt-buttons-target=".form-check-image, .form-check-input">
                                <!-- start::Col -->
                                <div class="col-6 col-md-3">
                                    <label class="form-check-image active">
                                        <div class="form-check-wrapper">
                                            <img class="tw-size-36" src="/images/Frame.svg" />
                                        </div>

                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" checked value="1" name="theme[fontfamily]" />
                                            <div class="form-check-label">
                                                حالت اول
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <!--end::Col-->
                                <!-- start::Col -->
                                <div class="col-6 col-md-3">
                                    <label class="form-check-image">
                                        <div class="form-check-wrapper">
                                            <img class="tw-size-36" src="/images/Frame-1.svg" />
                                        </div>

                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" value="1" name="theme[fontfamily]" />
                                            <div class="form-check-label">
                                                حالت دوم
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <!--end::Col-->
                                <!-- start::Col -->
                                <div class="col-6 col-md-3">
                                    <label class="form-check-image">
                                        <div class="form-check-wrapper">
                                            <img class="tw-size-36" src="/images/Frame-2.svg" />
                                        </div>

                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" value="2" name="theme[fontfamily]" />
                                            <div class="form-check-label">
                                                حالت سوم
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <!--end::Col-->
                                <!-- start::Col -->
                                <div class="col-6 col-md-3">
                                    <label class="form-check-image">
                                        <div class="form-check-wrapper">
                                            <img class="tw-size-36" src="/images/Frame-3.svg" />
                                        </div>

                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" value="2" name="theme[fontfamily]" />
                                            <div class="form-check-label">
                                                حالت چهارم
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <!--end::Col-->
                                <!-- start::Col -->
                                <div class="col-6 col-md-3">
                                    <label class="form-check-image">
                                        <div class="form-check-wrapper">
                                            <img class="tw-size-36" src="/images/Frame-4.svg" />
                                        </div>

                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" value="2" name="theme[fontfamily]" />
                                            <div class="form-check-label">
                                                حالت پنجم
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <!--end::Col-->
                                <!-- start::Col -->
                                <div class="col-6 col-md-3">
                                    <label class="form-check-image">
                                        <div class="form-check-wrapper">
                                            <img class="tw-size-36" src="/images/Frame-5.svg" />
                                        </div>

                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" value="2" name="theme[fontfamily]" />
                                            <div class="form-check-label">
                                                حالت ششم
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <!--end::Col-->
                                <!-- start::Col -->
                                <div class="col-6 col-md-3">
                                    <label class="form-check-image">
                                        <div class="form-check-wrapper">
                                            <img class="tw-size-36" src="/images/Frame-6.svg" />
                                        </div>

                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" value="2" name="theme[fontfamily]" />
                                            <div class="form-check-label">
                                                حالت هفتم
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <!--end::Col-->
                                <!-- start::Col -->
                                <div class="col-6 col-md-3">
                                    <label class="form-check-image">
                                        <div class="form-check-wrapper">
                                            <img class="tw-size-36" src="/images/Frame-7.svg" />
                                        </div>

                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" value="2" name="theme[fontfamily]" />
                                            <div class="form-check-label">
                                                حالت هشتم
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <!--end::Col-->
                                <!-- start::Col -->
                                <div class="col-6 col-md-3">
                                    <label class="form-check-image">
                                        <div class="form-check-wrapper">
                                            <img class="tw-size-36" src="/images/Frame-8.svg" />
                                        </div>

                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" value="2" name="theme[fontfamily]" />
                                            <div class="form-check-label">
                                                حالت نهم
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <!--end::Col-->
                                <!-- start::Col -->
                                <div class="col-6 col-md-3">
                                    <label class="form-check-image">
                                        <div class="form-check-wrapper">
                                            <img class="tw-size-36" src="/images/Frame-9.svg" />
                                        </div>

                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" value="2" name="theme[fontfamily]" />
                                            <div class="form-check-label">
                                                حالت دهم
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <!--end::Col-->
                                <!-- start::Col -->
                                <div class="col-6 col-md-3">
                                    <label class="form-check-image">
                                        <div class="form-check-wrapper">
                                            <img class="tw-size-36" src="/images/Frame-10.svg" />
                                        </div>

                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" value="2" name="theme[fontfamily]" />
                                            <div class="form-check-label">
                                                حالت یازدهم
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <!--end::Col-->
                            </div>
                        </div>
                        <div>
                            <div class="swapSortable third-grid">
                                <div>
                                    1
                                    <input type="hidden" value="1" />
                                </div>
                                <div>
                                    2
                                    <input type="hidden" value="2" />
                                </div>
                                <div>
                                    3
                                    <input type="hidden" value="3" />
                                </div>
                            </div>
                            <div class="swapSortable first-grid">
                                <div>
                                    1
                                    <input type="hidden" value="1" />
                                </div>
                                <div>
                                    2
                                    <input type="hidden" value="2" />
                                </div>
                                <div>
                                    3
                                    <input type="hidden" value="3" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Actions -->
    <div class="d-flex justify-content-between mt-3">
        <button id="prevBtn" class="btn btn-secondary" style="display: none;">برگشت</button>
        <div>
            <button id="nextBtn" class="btn btn-primary">ادامه</button>
            <button id="submitBtn" class="btn btn-success" style="display: none;">ذخیره</button>
        </div>
    </div>
    <!--end::Actions-->

</div>
<!--end::Accordion-->

@endsection

@section('script-before')
<script src="{{asset('plugins/custom/pickr/pickr.es5.min.js')}}"></script>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        const $accordion = $('#accordionExample');
        const $nextBtn = $('#nextBtn');
        const $prevBtn = $('#prevBtn');
        const $submitBtn = $('#submitBtn');

        // Initial button setup
        const $initialActiveAccordion = $accordion.find('.accordion-collapse.show');

        // Event listener for when a collapse is shown
        $accordion.on('shown.bs.collapse', function(e) {
            const $activeAccordion = $(e.target).closest('.card');
            updateButtons($activeAccordion);
        });

        // Event listener for when a collapse is hidden
        $accordion.on('hidden.bs.collapse', function(e) {
            const $hiddenAccordion = $(e.target).closest('.card');
            updateButtons($hiddenAccordion);
        });

        // Handle the next button click
        $nextBtn.on('click', function() {
            const $current = $accordion.find('.accordion-collapse.show').parent()
            const $next = $accordion.find('.accordion-collapse.show').parent().next();

            if ($next.length) {
                $current.find('.accordion-collapse').collapse('hide');
                $next.find('.accordion-collapse').collapse('show');
            }
        });

        // Handle the prev button click
        $prevBtn.on('click', function() {
            const $current = $accordion.find('.accordion-collapse.show').parent()
            const $prev = $accordion.find('.accordion-collapse.show').parent().prev();

            if ($prev.length) {
                $current.find('.accordion-collapse').collapse('hide');
                $prev.find('.accordion-collapse').collapse('show');
            }
        });

        function updateButtons($activeAccordion) {
            const $current = $accordion.find('.accordion-collapse.show').parent();
            const $next = $current.next();
            const $prev = $current.prev();


            // Show/hide next button
            if ($next.length) {
                $nextBtn.show(); // Show "Next" button if there is a next item
                $submitBtn.hide(); // Hide "Submit" button
            } else {
                $nextBtn.hide(); // Hide "Next" button if there is no next item
                $submitBtn.show(); // Show "Submit" button if it's the last item
            }

            // Show/hide prev button
            if ($prev.length) {
                $prevBtn.show(); // Show "Previous" button if there is a previous item
            } else {
                $prevBtn.hide(); // Hide "Previous" button if there is no previous item
            }

            // Show both "Next" and "Previous" buttons if there are items both before and after
            if ($next.length && $prev.length) {
                $nextBtn.show();
                $prevBtn.show();
            }

        }

    });



    // Initialize color picker
    $(".color-picker").each(function(i) {
        const elm = $(this);
        const parent = $(this).prev('input');
        const pickerConfig = {
            el: this,
            theme: 'nano', // or 'monolith', or 'nano'
            default: $(this).prev('input').val(),
            swatches: [
                'rgba(171, 0, 0, 1)',
                'rgba(233, 30, 99, 1)',
                'rgba(156, 39, 176,1)',
                'rgba(103, 58, 183,1)',
                'rgba(63, 81, 181, 1)',
                'rgba(33, 150, 243,1)',
                'rgba(3, 169, 244,1)',
                'rgba(0, 188, 212,1)',
                'rgba(0, 150, 136,1)',
                'rgba(76, 175, 80,1)',
                'rgba(139, 195, 74,1)',
                'rgba(205, 220, 57,1)',
                'rgba(255, 235, 59,1)',
                'rgba(255, 193, 7, 1)'
            ],
            components: {
                preview: true,
                opacity: true,
                hue: true,
                interaction: {
                    hex: true,
                    input: true,
                    clear: true,
                    cancel: true,
                    save: true
                }
            },
            i18n: {
                'btn:save': 'ذخیره',
                'btn:cancel': 'انصراف',
                'btn:clear': 'پاک کردن',
            }
        }

        new Pickr(pickerConfig).on("save", (color, instance) => {
            $(this).val(color.toHEXA().toString())
            parent.val(color.toHEXA().toString())
            instance.hide();
        });
    })
</script>
@endsection