@extends('layouts.primary')

@section('title', 'محصولات')

@section("toolbar")
<a href="{{route('attribute.create.show')}}" class="btn btn-primary">محصول جدید</a>
@endsection

@section('content')
<!-- this box is showed when we wants to edit products by checkboxes but for more than  -->
<div class="card mb-10">
    <div class="card-header">
        <div class="w-100 d-flex align-items-center justify-content-between">
            <h4>ویرایش دسته جمعی</h4>
            <button class="btn btn-sm btn-light" data-bs-toggle="collapse" data-bs-target="#edit-collapse">
                <i class="fal fa-chevron-down"></i>
            </button>
        </div>
    </div>
    <div class="collapse" id="edit-collapse">
        <div class="card-body">
            <form method="post" action class="row mt-5 g-4">
                @csrf
                <div class="col-md-6">
                    <div>
                        <label class="form-label" for="">محصولات</label>
                        <select class="form-select " data-control="select2" name="group-edit-products" id="" multiple>
                            <option value="" selected>محصول شماره 1</option>
                            <option value="" selected>محصول شماره 2</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-10">
                        <label class="form-label" for="">وضعیت محصول</label>
                        <select class="form-select mb-2">
                            <option selected value="published">انتشار</option>
                            <option value="inactive">پیش نویس</option>
                        </select>
                        <!--end::انتخاب2-->
                        <!--begin::توضیحات-->
                        <div class="text-muted fs-7">وضعیت محصول را تنظیم کنید.</div>
                        <!--end::توضیحات-->
                    </div>
                    <div>
                        <div class="form-check mb-10">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked />
                            <label class="form-check-label text-dark" for="flexCheckChecked">
                                فعال بودن دیدگاه ها
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="tw-max-h-56 tw-overflow-auto tw-pt-1 mb-10">
                        <label class="form-label" for="">دسته ها</label>
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
                </div>
                <div class="col-md-6">
                    <div class="mb-10">
                        <input class="form-control form-control-solid" value="برچسب 3 , برچسب 2 , برچسب 1" id="post-type-tags" />
                        <span class="text-muted fs-7">برچسب جدید را وارد کنید و Enter را بزنید</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-10">
                        <h5>انبار</h5>
                        <div class="card shadow-none border">
                            <div class="card-body">
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
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-10">
                        <h5>حمل و نقل</h5>
                        <div class="card shadow-none border">
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-5 col-12">
                                        <label for="exampleFormControlInput1" class="form-label">وزن (کیلوگرم)</label>
                                        <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1">
                                    </div>
                                    <div class="mb-5 col-12">
                                        <div class="row">
                                            <div class="col-12 col-lg-4">
                                                <label for="exampleFormControlInput1" class="form-label">طول ( سانتی متر )</label>
                                                <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1">
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <label for="exampleFormControlInput1" class="form-label">عرض (سانتی متر )</label>
                                                <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1">
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <label for="exampleFormControlInput1" class="form-label">ارتفاع (سانتی مت)</label>
                                                <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- START:related attributes -->
                <div class="col-md-6">
                    <div class="mb-10">
                        <h5>متغیر های وابسته</h5>
                        <div class="card shadow-none border">
                            <div class="card-body">
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
                                            <div class="d-flex align-items-center justify-content-between flex-wrap w-100">
                                                <div class="d-flex align-items-center flex-wrap flex-lg-nowrap gap-4">
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
                                                <button type="button" class="mt-4 mt-lg-0 btn btn-sm btn-light" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
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
                                                            <div class="col-lg-4">
                                                                <div class="mb-8">
                                                                    <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1" placeholder="طول">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="mb-8">
                                                                    <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1" placeholder="عرض">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
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
                <!-- END:related attributes -->
                <div class="col-md-6">
                    <div class="mb-10">
                        <h5>متغیر های غیر وابسته</h5>
                        <div class="card shadow-none border">
                            <div class="card-body">
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
                                            <div class="d-flex align-items-center justify-content-between flex-wrap w-100">
                                                <div class="d-flex align-items-center flex-wrap flex-lg-nowrap gap-4">
                                                    <b>#1</b>
                                                    <select class="form-select form-select-solid" name="" id="">
                                                        <option selected disabled>انتخاب گارانتی</option>
                                                        <option value="3month" selected>3 ماهه</option>
                                                        <option value="5month">5 ماهه</option>
                                                        <option value="1year">1 ساله</option>
                                                    </select>
                                                </div>
                                                <button type="button" class="mt-7 mt-lg-0 btn btn-sm btn-light" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
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
                                                            <div class="col-lg-4">
                                                                <div class="mb-8">
                                                                    <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1" placeholder="طول">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="mb-8">
                                                                    <input type="text" class="form-control form-control-solid" id="exampleFormControlInput1" placeholder="عرض">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
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
                <div class="col-md-6">
                    <div class="mb-10">
                        <label class="form-label d-block" for="">ویدئو</label>
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
                        <!--end::Image in -->
                    </div>
                </div>
                <div class="col-12">
                    <button name="submit" type="submit" class="btn btn-success">بروزرسانی</button>
                    <button name="cancel" type="submit" class="btn btn-secondary">لغو</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- START:TABLE -->
<div class="card">
    <div class="card-body">
        <form class="d-flex align-items-center justify-content-end" action="" method="get">
            @csrf
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span class="path2"></span></i>
                <input name="s" value="{{ request()->get('s') ?? '' }}" type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="جست و جو" />
            </div>
        </form>
        <form method="post" class="" id="action_form">
            <div class="d-flex tw-items-center tw-justify-start tw-w-full gap-4">
                <select class="form-select form-select-solid tw-w-max" name="" id="">
                    <option>عملیات</option>
                    <option value="edit">ویرایش</option>
                    <option value="delete">حذف</option>
                </select>
                <button class="btn btn-primary" type="submit">اجرا</button>
            </div>

            <table id="products_table" class="table gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="w-10px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#products_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">تصویر</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">عنوان</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">شناسه محصول</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">انبار</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">قیمت</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">دسته ها</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">برچسب ها</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">تاریخ</th>
                        <th class="min-w-100px text-end">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="checked_row" value="1" />
                            </div>
                        </td>
                        <td>
                            <img class="tw-size-16 tw-rounded-md" src="/images/1.jpg" alt="">
                        </td>
                        <td>
                            <a href="{{route('product.edit.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">پرده رنگی</a>
                        </td>
                        <td>
                            <a href="{{route('product.edit.show',['id' => 1])}}">#1212</a>
                        </td>
                        <td>
                            <a href="{{route('product.edit.show',['id' => 1])}}">
                                <span class="badge badge-success">موجود در انبار</span>
                                <span class="badge badge-danger">ناموجود</span>
                                <span class="badge badge-info">5 عدد در انبار</span>
                                <span class="badge badge-secondary">پیش فروش</span>
                            </a>
                        </td>
                        <td>
                            <div class="w-100 d-flex align-items-center gap-3 flex-wrap tw-max-w-40">
                                <span class="badge badge-dark">12,000,000</span>
                                <span class="badge badge-dark">9,000,000</span>
                                <span class="badge badge-dark">9,000,000</span>
                                <span class="badge badge-dark">9,000,000</span>
                            </div>
                        </td>
                        <td>
                            <a class="badge badge-primary" href="">دسته اول</a>
                        </td>
                        <td>
                            <a class="badge badge-primary" href="">برچسب اول</a>
                        </td>
                        <td>
                            <a href="#">12/12/1403</a>
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
                                        نمایش
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="{{route('product.comment.show',['id' => 1])}}" class="menu-link px-3">
                                        ویرایش
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3 text-primary">
                                        حذف
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <!--end::Group actions-->

        <ul class="pagination">
            <li class="page-item previous disabled"><a href="#" class="page-link"><i class="previous"></i></a></li>
            <li class="page-item active"><a href="#" class="page-link">1</a></li>
            <li class="page-item"><a href="#" class="page-link">2</a></li>
            <li class="page-item "><a href="#" class="page-link">3</a></li>
            <li class="page-item "><a href="#" class="page-link">4</a></li>
            <li class="page-item "><a href="#" class="page-link">5</a></li>
            <li class="page-item "><a href="#" class="page-link">6</a></li>
            <li class="page-item next"><a href="#" class="page-link"><i class="next"></i></a></li>
        </ul>
    </div>
</div>
<!-- END:TABLE -->
@endsection

@section('script-before')
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
@endsection