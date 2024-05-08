<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')

@section('title', 'ایجاد محصول جدید')

@section('content')

<form method="post" class="row post-type-row" id="product-form">
    @csrf
    <div class="col-lg-8 col-xl-9">
        <div class="card mb-7">
            <div class="card-body">
                <div class="mb-10">
                    <label for="title" class="required form-label">عنوان</label>
                    <input type="text" id="title" class="form-control" placeholder="عنوان را وارد کنید" />
                    <a class="text-primary nav-link tw-w-max" href="#link_edit" data-bs-toggle="collapse">آدرس لینک</a>
                </div>
                <div class="collapse" id="link_edit">
                    <div>
                        <label for="link">آدرس محصول</label>
                        <input type="text" name="link" id="link" class="form-control" placeholder="آدرس محصول را وارد کنید" />
                    </div>
                </div>
                <div class="mb-2 mt-10">
                    <label class="form-label ">توضیحات</label>
                    <div class="row row-editor">
                        <div class="editor-container">
                            <div class="editor tw-max-h-96 tw-overflow-auto"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header py-4">
                <div class="card-title">
                    <h4>اطلاعات محصول</h4>
                </div>
                <select class="form-select form-select-solid tw-w-max" name="product-type" id="">
                    <option value="simple">محصول </option>
                    <option value="variable">خدمت</option>
                </select>
            </div>
            <div class="card-body">
                <div class="nav nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">انبار</button>
                    <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">حمل و نقل</button>
                    <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-relation" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">متغیر های وابسته</button>
                    <button class="nav-link" id="v-pills-norelation-tab" data-bs-toggle="pill" data-bs-target="#v-pills-norelation" type="button" role="tab" aria-controls="v-pills-norelation" aria-selected="false">متغیر های غیر وابسته</button>
                </div>
                <div class="tab-content mt-6 border-top pt-6" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                        <div class="row">
                            <div class="mb-5 col-xl-7">
                                <label for="exampleFormControlInput1" class="form-label">شناسه محصول</label>
                                <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1">
                            </div>
                            <div class="mb-3 col-xl-7">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        فروش تکی
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                        <div class="row">
                            <div class="mb-5 col-xl-6">
                                <label for="exampleFormControlInput1" class="form-label">وزن (کیلوگرم)</label>
                                <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1">
                            </div>
                            <div class="mb-5 col-xl-6">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="exampleFormControlInput1" class="form-label">طول ( سانتی متر )</label>
                                        <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1">
                                    </div>
                                    <div class="col-4">
                                        <label for="exampleFormControlInput1" class="form-label">عرض (سانتی متر )</label>
                                        <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1">
                                    </div>
                                    <div class="col-4">
                                        <label for="exampleFormControlInput1" class="form-label">ارتفاع (سانتی مت)</label>
                                        <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-relation" role="tabpanel" aria-labelledby="v-pills-disabled-tab" tabindex="0">
                        <div>
                            <label class="form-label" for="">انتخاب ویژگی</label>
                            <select class="form-select form-select-solid" data-control="select2" name="" id="" multiple>
                                <option value="1" selected>رنگ</option>
                                <option value="2">سایز</option>
                                <option value="3">جنس</option>
                            </select>
                        </div>

                        <div class="mt-7">
                            <div class="row">
                                <div class="col-2">
                                    <span class="fs-6">نام : <b>رنگ</b></span>
                                </div>
                                <div class="col-10">
                                    <select class="form-select form-select-solid" data-control="select2" name="" id="" multiple>
                                        <option value="red" selected>قرمز</option>
                                        <option value="blue">آبی</option>
                                        <option value="yellow">زرد</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mt-7">
                            <div class="card border border-gray-300">
                                <div class="card-header py-2">
                                    <div class="d-flex align-items-center justify-content-between w-100">
                                        <div class="d-flex align-items-center gap-4">
                                            <b>#1</b>
                                            <select class="form-select form-select-solid" name="" id="">
                                                <option selected disabled>انتخاب رنگ</option>
                                                <option value="red">قرمز</option>
                                                <option value="blue">آبی</option>
                                                <option value="yellow">زرد</option>
                                            </select>
                                            <select class="form-select form-select-solid" name="" id="">
                                                <option selected disabled>انتخاب سایز</option>
                                                <option value="small">کوچک</option>
                                                <option value="medium">متوسط</option>
                                                <option value="large">بزرگ</option>
                                            </select>
                                            <select class="form-select form-select-solid" name="" id="">
                                                <option selected disabled>انتخاب جنس</option>
                                                <option value="1">کتان</option>
                                                <option value="2">نخی</option>
                                                <option value="3">مخمل</option>
                                            </select>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-light" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="collapse" id="collapse1">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-8">
                                                    <label for="exampleFormControlInput1" class="form-label">شناسه محصول</label>
                                                    <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="mb-8">
                                                    <label for="exampleFormControlInput1" class="form-label">قیمت اصلی</label>
                                                    <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1" placeholder="قیمت(تومان)">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="mb-8">
                                                    <label for="exampleFormControlInput1" class="form-label">قیمت فروش ویژه</label>
                                                    <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1" placeholder="قیمت(تومان)">
                                                    <!-- id for collapse -->
                                                    <a class="text-primary" data-bs-toggle="collapse" href="#timing1">زمان بندی فروش</a>
                                                </div>
                                            </div>
                                            <div class="collapse col-12" id="timing1">
                                                <div class="row mb-8">
                                                    <div class="col-12 col-lg-6">
                                                        <label class="form-label" for="">تاریخ شروع فروش ویژه</label>
                                                        <input type="text" class="form-control form-control-solid first_time">
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        <label class="form-label" for="">تاریخ پایان فروش ویژه</label>
                                                        <input type="text" class="form-control form-control-solid second_time">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="mb-8">
                                                    <label for="exampleFormControlInput1" class="form-label">موجودی</label>
                                                    <select class="form-select form-select-solid" name="" id="">
                                                        <option value="">موجود در انبار</option>
                                                        <option value="">در انبار موجود نمیباشد</option>
                                                        <option value="">در پیش خرید</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="mb-8">
                                                    <label for="exampleFormControlInput1" class="form-label">وزن ( کیلوگر)</label>
                                                    <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <label for="exampleFormControlInput1" class="form-label">ابعاد ( سانتی متر)</label>
                                                    <div class="col-4">
                                                        <div class="mb-8">
                                                            <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1" placeholder="طول">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="mb-8">
                                                            <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1" placeholder="عرض">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="mb-8">
                                                            <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1" placeholder="ارتفاع">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-8">
                                                    <label for="exampleFormControlTextarea1" class="form-label">توضیحات</label>
                                                    <textarea class="form-control form-control-solid" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="images-repeater w-100">
                                                    <!--begin::Form group-->
                                                    <div class="form-group">
                                                        <div data-repeater-list="edit_block_repeater">
                                                            <div class="mt-3" data-repeater-item>
                                                                <div class="form-group row">
                                                                    <div class="col-md-10">
                                                                        <label class="form-label">تصویر:</label>
                                                                        <input name="option[image]" type="file" class="form-control form-control-solid mb-2 mb-md-0" placeholder="وارد کنید" />
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>

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
                                                            افزودن تصویر جدید
                                                            <i class="ki-duotone ki-plus fs-3 pe-0"></i>
                                                        </a>
                                                    </div>
                                                    <!--end::Form group-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-norelation" role="tabpanel" aria-labelledby="v-pills-disabled-tab" tabindex="0">
                        <div>
                            <label class="form-label" for="">انتخاب ویژگی</label>
                            <select class="form-select form-select-solid" data-control="select2" name="" id="" multiple>
                                <option value="1" selected>گارانتی</option>
                            </select>
                        </div>

                        <div class="mt-7">
                            <div class="row">
                                <div class="col-2">
                                    <span class="fs-6">نام : <b>رنگ</b></span>
                                </div>
                                <div class="col-10">
                                    <select class="form-select form-select-solid" data-control="select2" name="" id="" multiple>
                                        <option value="3month" selected>3 ماهه</option>
                                        <option value="5month">5 ماهه</option>
                                        <option value="1year">1 ساله</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mt-7">
                            <div class="card border border-gray-300">
                                <div class="card-header py-2">
                                    <div class="d-flex align-items-center justify-content-between w-100">
                                        <div class="d-flex align-items-center gap-4">
                                            <b>#1</b>
                                            <select class="form-select form-select-solid" name="" id="">
                                                <option selected disabled>انتخاب گارانتی</option>
                                                <option value="3month" selected>3 ماهه</option>
                                                <option value="5month">5 ماهه</option>
                                                <option value="1year">1 ساله</option>
                                            </select>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-light" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="collapse" id="collapse1">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-8">
                                                    <label for="exampleFormControlInput1" class="form-label">شناسه محصول</label>
                                                    <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="mb-8">
                                                    <label for="exampleFormControlInput1" class="form-label">قیمت اصلی</label>
                                                    <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1" placeholder="قیمت(تومان)">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="mb-8">
                                                    <label for="exampleFormControlInput1" class="form-label">قیمت فروش ویژه</label>
                                                    <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1" placeholder="قیمت(تومان)">
                                                    <!-- id for collapse -->
                                                    <a class="text-primary" data-bs-toggle="collapse" href="#timing1">زمان بندی فروش</a>
                                                </div>
                                            </div>
                                            <div class="collapse col-12" id="timing1">
                                                <div class="row mb-8">
                                                    <div class="col-12 col-lg-6">
                                                        <label class="form-label" for="">تاریخ شروع فروش ویژه</label>
                                                        <input type="text" class="form-control form-control-solid first_time">
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        <label class="form-label" for="">تاریخ پایان فروش ویژه</label>
                                                        <input type="text" class="form-control form-control-solid second_time">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="mb-8">
                                                    <label for="exampleFormControlInput1" class="form-label">موجودی</label>
                                                    <select class="form-select form-select-solid" name="" id="">
                                                        <option value="">موجود در انبار</option>
                                                        <option value="">در انبار موجود نمیباشد</option>
                                                        <option value="">در پیش خرید</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="mb-8">
                                                    <label for="exampleFormControlInput1" class="form-label">وزن ( کیلوگر)</label>
                                                    <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <label for="exampleFormControlInput1" class="form-label">ابعاد ( سانتی متر)</label>
                                                    <div class="col-4">
                                                        <div class="mb-8">
                                                            <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1" placeholder="طول">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="mb-8">
                                                            <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1" placeholder="عرض">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="mb-8">
                                                            <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1" placeholder="ارتفاع">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-8">
                                                    <label for="exampleFormControlTextarea1" class="form-label">توضیحات</label>
                                                    <textarea class="form-control form-control-solid" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="images-repeater w-100">
                                                    <!--begin::Form group-->
                                                    <div class="form-group">
                                                        <div data-repeater-list="edit_block_repeater">
                                                            <div class="mt-3" data-repeater-item>
                                                                <div class="form-group row">
                                                                    <div class="col-md-10">
                                                                        <label class="form-label">تصویر:</label>
                                                                        <input name="option[image]" type="file" class="form-control form-control-solid mb-2 mb-md-0" placeholder="وارد کنید" />
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>

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
                                                            افزودن تصویر جدید
                                                            <i class="ki-duotone ki-plus fs-3 pe-0"></i>
                                                        </a>
                                                    </div>
                                                    <!--end::Form group-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-10">
            <div class="card-body">
                <label class="form-label ">راهنمای اندازه گیری</label>
                <div class="row row-editor">
                    <div class="editor-container">
                        <div class="editor tw-max-h-96 tw-overflow-auto"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-xl-3 mt-5 mt-lg-0">
        <!-- START:STATUS -->
        <div class="card card-flush py-4 mb-5">
            <!--begin::کارت header-->
            <div class="card-header">
                <!--begin::کارت title-->
                <div class="card-title">
                    <h4>وضعیت</h4>
                </div>
                <!--end::کارت title-->
            </div>
            <!--end::کارت header-->
            <!--begin::کارت body-->
            <div class="card-body pt-0">
                <!--begin::انتخاب2-->
                <select class="form-select mb-2">
                    <option selected value="published">منتشر شده</option>
                    <option value="inactive">پیش نویس</option>
                </select>
                <!--end::انتخاب2-->
                <!--begin::توضیحات-->
                <div class="text-muted fs-7">وضعیت نوشته را تنظیم کنید.</div>
                <!--end::توضیحات-->
                <!--begin::انتخاب2-->
                <div class="form-check mt-5">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked />
                    <label class="form-check-label text-dark" for="flexCheckChecked">
                        فعال بودن دیدگاه ها
                    </label>
                </div>


                <!--end::انتخاب2-->
            </div>
            <!--end::کارت body-->
            <div class="card-footer text-end">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <!-- post id -->
                    <button type="submit" name="remove-product" value="1" class="btn btn-sm btn-danger" id="remove-button">حذف</button>
                    <button class="btn btn-sm btn-success">ذخیره تغییرات</button>
                </div>
            </div>
        </div>
        <!-- END:STATUS -->

        <!-- START:CATEGORY -->
        <div class="card card-flush py-4 mb-5">
            <!--begin::کارت header-->
            <div class="card-header">
                <!--begin::کارت title-->
                <div class="card-title">
                    <h4>دسته بندی ها</h4>
                </div>
                <!--end::کارت title-->
            </div>
            <!--end::کارت header-->
            <!--begin::کارت body-->
            <div class="card-body pt-0">
                <!--begin::Input group-->
                <div class="tw-max-h-56 tw-overflow-auto tw-pt-1">
                    <ul class="intermediat-checkbox category-list">
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="tall" name="category1" />
                                <label class="form-check-label" for="tall">
                                    دسته ی پرده
                                </label>
                            </div>
                            <ul>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="tall2" name="category1['child1']" />
                                        <label class="form-check-label" for="tall2">
                                            پرده ی اتاق خواب
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="tall3" name="category1['child2']" />
                                        <label class="form-check-label" for="tall3">
                                            پرده ی اتاق نشیمن
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <button class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#add-fast-category">افزودن دسته ی جدید</button>

            </div>
            <!--end::کارت body-->
        </div>
        <!-- END:CATEGORY -->

        <!-- START:TAGS -->
        <div class="card card-flush py-4 mb-5">
            <!--begin::کارت header-->
            <div class="card-header">
                <!--begin::کارت title-->
                <div class="card-title">
                    <h4>برچسب ها</h4>
                </div>
                <!--end::کارت title-->
            </div>
            <!--end::کارت header-->
            <!--begin::کارت body-->
            <div class="card-body pt-0">
                <!--begin::Input group-->
                <input class="form-control form-control-solid" id="product-type-tags" />
                <span class="text-muted fs-7">برچسب جدید را وارد کنید و Enter را بزنید</span>
            </div>
            <!--end::کارت body-->
        </div>
        <!-- END:TAGS -->

        <!-- START: THUMBNAIL -->
        <div class="card card-flush py-4">
            <!--begin::کارت header-->
            <div class="card-header">
                <!--begin::کارت title-->
                <div class="card-title">
                    <h4>ویدئو</h4>
                </div>
                <!--end::کارت title-->
            </div>
            <!--end::کارت header-->
            <!--begin::کارت body-->
            <div class="card-body text-center pt-0">
                <!--begin::Image input-->
                <!--end::Image input placeholder-->
                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                    <!--begin::نمایش existing avatar-->
                    <div class="image-input-wrapper w-150px h-150px"></div>
                    <!--end::نمایش existing avatar-->
                    <!--begin::Tags-->
                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="تعویض ویدئو">
                        <i class="ki-duotone ki-pencil fs-7">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <!--begin::Inputs-->
                        <input type="file" name="avatar" accept="mp4" />
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
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="حذف ویدئو">
                        <i class="ki-duotone ki-cross fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <!--end::حذف-->
                </div>
                <!--end::Image input-->
                <!--begin::توضیحات-->
                <div class="text-muted fs-7">ویدئو محصول را انتخاب کنید</div>
                <!--end::توضیحات-->
            </div>
            <!--end::کارت body-->
        </div>
        <!-- END:THUMBNAIL -->
    </div>
</form>
<x-add-fast-category />
@endsection

@section("script-before")
<script src="{{ asset('/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>
<script src="{{asset('plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
<script src="{{asset('plugins/flatpicker_fa.js')}}"></script>
<script src="{{asset('plugins/jdate.min.js')}}"></script>
@endsection

@section("scripts")
<script>
    window.Date = window.JDate;
    $('.images-repeater').repeater({
        initEmpty: false,

        show: function() {
            $(this).slideDown();
        },

        hide: function(deleteElement) {
            $(this).slideUp(deleteElement);
        }
    });
    flatpickr = $(".first_time,.second_time").flatpickr({
        disableMobile: "true",
        altInput: true,
        altFormat: "Y-m-d",
        dateFormat: "Y-m-d",
        locale: "fa",
    })

    // FOR REMOVE BUTTON CONFIRM
    document.addEventListener("DOMContentLoaded", () => {
        new Tagify(document.querySelector('#product-type-tags'), {
            whitelist: ['دسته پیشفرض']
        })
        $("#remove-button").on("click", (e) => {
            e.preventDefault();
            Swal.fire({
                title: "آیا مطمعن هستید ؟",
                icon: "info",
                cancelButtonColor: "#f1416c",
                showCancelButton: true,
                confirmButtonText: "بله",
                cancelButtonText: "خیر"
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#product-form").submit();
                }
            });
        })
    })
</script>
@endsection