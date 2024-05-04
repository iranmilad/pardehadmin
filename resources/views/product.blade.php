<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')

@section('title', 'ایجاد محصول جدید')

@section('content')

<form method="post" class="row post-type-row">
    @csrf
    <div class="col-lg-8 col-xl-10">
        <div class="card mb-7">
            <div class="card-body">
                <div class="mb-10">
                    <label for="title" class="required form-label">عنوان</label>
                    <input type="text" id="title" class="form-control" placeholder="عنوان را وارد کنید" />
                </div>
                <div class="mb-2">
                    <label class="form-label ">توضیحات</label>
                    <div class="row row-editor">
                        <div class="editor-container">
                            <div id="editor" class="editor tw-max-h-96 tw-overflow-auto"></div>
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
                                                @livewire('product-attribute')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-xl-2 mt-5 mt-lg-0">
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
                    <option selected value="published">فعال</option>
                    <option value="inactive">غیرفعال</option>
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
                <button class="btn btn-sm btn-primary">ذخیره تغییرات</button>
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
                <input class="form-control form-control-solid" value="برچسب 3 , برچسب 2 , برچسب 1" id="post-type-tags" />
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
                    <h4>تصویر شاخص</h4>
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
                <!--end::Image input-->
                <!--begin::توضیحات-->
                <div class="text-muted fs-7">تصویر شاخص را انتخاب کنید</div>
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
@endsection