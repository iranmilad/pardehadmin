@extends('layouts.primary')

@section('title', 'شخصی سازی')

@section('content')

<!--begin::Stepper-->
<div class="stepper stepper-pills" id="kt_stepper_example_clickable">
    <!--begin::Nav-->
    <div class="stepper-nav lg:tw-justify-center tw-overflow-auto mb-10">

        <!--begin::Step 1-->
        <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
            <!--begin::Wrapper-->
            <div class="stepper-wrapper d-flex align-items-center">
                <!--begin::Icon-->
                <div class="stepper-icon w-40px h-40px">
                    <i class="stepper-check fas fa-check"></i>
                    <span class="stepper-number">1</span>
                </div>
                <!--begin::Icon-->

                <!--begin::Label-->
                <div class="stepper-label tw-whitespace-nowrap">
                    <h3 class="stepper-title">
                        تنظیمات سایت
                    </h3>
                </div>
                <!--end::Label-->
            </div>
            <!--end::Wrapper-->

            <!--begin::Line-->
            <div class="stepper-line h-40px"></div>
            <!--end::Line-->
        </div>
        <!--end::Step 1-->

        <!--begin::Step 2-->
        <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
            <!--begin::Wrapper-->
            <div class="stepper-wrapper d-flex align-items-center">
                <!--begin::Icon-->
                <div class="stepper-icon w-40px h-40px">
                    <i class="stepper-check fas fa-check"></i>
                    <span class="stepper-number">2</span>
                </div>
                <!--begin::Icon-->

                <!--begin::Label-->
                <div class="stepper-label tw-whitespace-nowrap">
                    <h3 class="stepper-title">
                        تنظیمات نمایشی
                    </h3>
                </div>
                <!--end::Label-->
            </div>
            <!--end::Wrapper-->

            <!--begin::Line-->
            <div class="stepper-line h-40px"></div>
            <!--end::Line-->
        </div>
        <!--end::Step 2-->

        <!--begin::Step 3-->
        <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
            <!--begin::Wrapper-->
            <div class="stepper-wrapper d-flex align-items-center">
                <!--begin::Icon-->
                <div class="stepper-icon w-40px h-40px">
                    <i class="stepper-check fas fa-check"></i>
                    <span class="stepper-number">3</span>
                </div>
                <!--begin::Icon-->

                <!--begin::Label-->
                <div class="stepper-label tw-whitespace-nowrap ">
                    <h3 class="stepper-title">
                        باکس محصولات
                    </h3>
                </div>
                <!--end::Label-->
            </div>
            <!--end::Wrapper-->

            <!--begin::Line-->
            <div class="stepper-line h-40px"></div>
            <!--end::Line-->
        </div>
        <!--end::Step 3-->

        <!--begin::Step 4-->
        <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
            <!--begin::Wrapper-->
            <div class="stepper-wrapper d-flex align-items-center">
                <!--begin::Icon-->
                <div class="stepper-icon w-40px h-40px">
                    <i class="stepper-check fas fa-check"></i>
                    <span class="stepper-number">4</span>
                </div>
                <!--begin::Icon-->

                <!--begin::Label-->
                <div class="stepper-label tw-whitespace-nowrap">
                    <h3 class="stepper-title">
                        صفحه ی محصول
                    </h3>

                </div>
                <!--end::Label-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Step 4-->

        <!--begin::Step 5-->
        <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
            <!--begin::Wrapper-->
            <div class="stepper-wrapper d-flex align-items-center">
                <!--begin::Icon-->
                <div class="stepper-icon w-40px h-40px">
                    <i class="stepper-check fas fa-check"></i>
                    <span class="stepper-number">5</span>
                </div>
                <!--begin::Icon-->

                <!--begin::Label-->
                <div class="stepper-label tw-whitespace-nowrap">
                    <h3 class="stepper-title">
                        هدر و فوتر
                    </h3>

                </div>
                <!--end::Label-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Step 5-->

        <!--begin::Step 6-->
        <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
            <!--begin::Wrapper-->
            <div class="stepper-wrapper d-flex align-items-center">
                <!--begin::Icon-->
                <div class="stepper-icon w-40px h-40px">
                    <i class="stepper-check fas fa-check"></i>
                    <span class="stepper-number">6</span>
                </div>
                <!--begin::Icon-->

                <!--begin::Label-->
                <div class="stepper-label tw-whitespace-nowrap">
                    <h3 class="stepper-title">
                        صفحات احراز هویت
                    </h3>

                </div>
                <!--end::Label-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Step 6-->

        <!--begin::Step 6-->
        <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
            <!--begin::Wrapper-->
            <div class="stepper-wrapper d-flex align-items-center">
                <!--begin::Icon-->
                <div class="stepper-icon w-40px h-40px">
                    <i class="stepper-check fas fa-check"></i>
                    <span class="stepper-number">7</span>
                </div>
                <!--begin::Icon-->

                <!--begin::Label-->
                <div class="stepper-label tw-whitespace-nowrap">
                    <h3 class="stepper-title">
                        مرحله انتخاب کننده ویدئو
                    </h3>

                </div>
                <!--end::Label-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Step 6-->

        <!--begin::Step 6-->
        <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
            <!--begin::Wrapper-->
            <div class="stepper-wrapper d-flex align-items-center">
                <!--begin::Icon-->
                <div class="stepper-icon w-40px h-40px">
                    <i class="stepper-check fas fa-check"></i>
                    <span class="stepper-number">8</span>
                </div>
                <!--begin::Icon-->

                <!--begin::Label-->
                <div class="stepper-label tw-whitespace-nowrap">
                    <h3 class="stepper-title">
                        انتخاب ساختار
                    </h3>

                </div>
                <!--end::Label-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Step 6-->
    </div>
    <!--end::Nav-->

    <!--begin::Form-->
    <form method="post" class="form md:tw-max-w-[70%] mx-auto" novalidate="novalidate" id="kt_stepper_example_basic_form">
        @csrf
        <!--begin::Group-->
        <div class="card mb-5">
            <div class="card-body">
                <div class="mb-5">
                    <!--begin::Step 1-->
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
                        <div class="mb-10">
                            <label for="" class="form-label">لوگو</label>
                            <input name="site[logo]" class="form-control" type="file">
                        </div>
                    </div>
                    <div class="flex-column" data-kt-stepper-element="content">
                        <div class="mb-10">
                            <label for="" class="form-label">رنگ اصلی</label>
                            <div class="color-picker"></div>
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
                    <!--begin::Step 1-->

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

                    <div class="flex-column" data-kt-stepper-element="content">
                        <div class="row g-4">
                            <div class="col-6 col-md-3">
                                <label for="" class="form-label d-block">بنر ورود</label>
                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                    <!--begin::نمایش existing avatar-->
                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                    <!--end::نمایش existing avatar-->
                                    <!--begin::Tags-->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="تعویض تصویر">
                                        <i class="ki-duotone ki-pencil fs-7">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <!--begin::Inputs-->
                                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Tags-->
                                    <!--begin::انصراف-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="انصراف">
                                        <i class="ki-duotone ki-cross fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <!--end::انصراف-->
                                    <!--begin::حذف-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="حذف آواتار">
                                        <i class="ki-duotone ki-cross fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <!--end::حذف-->
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <label for="" class="form-label d-block">بنر ثبت نام</label>
                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                    <!--begin::نمایش existing avatar-->
                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                    <!--end::نمایش existing avatar-->
                                    <!--begin::Tags-->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="تعویض تصویر">
                                        <i class="ki-duotone ki-pencil fs-7">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <!--begin::Inputs-->
                                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Tags-->
                                    <!--begin::انصراف-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="انصراف">
                                        <i class="ki-duotone ki-cross fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <!--end::انصراف-->
                                    <!--begin::حذف-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="حذف آواتار">
                                        <i class="ki-duotone ki-cross fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <!--end::حذف-->
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <label for="" class="form-label d-block">بنر فراموشی رمز عبور</label>
                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                    <!--begin::نمایش existing avatar-->
                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                    <!--end::نمایش existing avatar-->
                                    <!--begin::Tags-->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="تعویض تصویر">
                                        <i class="ki-duotone ki-pencil fs-7">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <!--begin::Inputs-->
                                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Tags-->
                                    <!--begin::انصراف-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="انصراف">
                                        <i class="ki-duotone ki-cross fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <!--end::انصراف-->
                                    <!--begin::حذف-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="حذف آواتار">
                                        <i class="ki-duotone ki-cross fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <!--end::حذف-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-column" data-kt-stepper-element="content">
                        <div>
                            <label for="" class="form-label">انتخاب ویدئو</label>
                            <input type="file" name="video" class="form-control" />
                        </div>
                    </div>
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
        <!--end::Group-->

        <!--begin::Actions-->
        <div class="d-flex flex-stack">
            <!--begin::Wrapper-->
            <div class="me-2">
                <button type="button" class="btn btn-secondary" data-kt-stepper-action="previous">
                    برگشت
                </button>
            </div>
            <!--end::Wrapper-->

            <!--begin::Wrapper-->
            <div>
                <button type="button" class="btn btn-success" data-kt-stepper-action="submit">
                    <span class="indicator-label">
                        ذخیره
                    </span>
                    <span class="indicator-progress">
                        Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>

                <button type="button" class="btn btn-primary" data-kt-stepper-action="next">
                    ادامه
                </button>
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Actions-->
    </form>
    <!--end::Form-->
</div>
<!--end::Stepper-->

@endsection
@section('script-before')
<script src="{{asset('plugins/custom/pickr/pickr.es5.min.js')}}"></script>
@endsection
@section('scripts')
<script>
    const pickerConfig = {
        el: '.color-picker',
        theme: 'nano', // or 'monolith', or 'nano'
        default: '#AB0000',

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

            // Main components
            preview: false,
            opacity: false,
            hue: false,

            // Input / output Options
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
        $("#primarycolor").val(color.toHEXA().toString())
        instance.hide();
    })
</script>
@endsection