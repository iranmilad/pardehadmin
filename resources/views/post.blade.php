<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')

@section('title', 'نوشته جدید')

@section('content')

<form method="post" class="row post-type-row">
    @csrf
    <div class="col-lg-8 col-xl-10">
        <div class="card">
            <div class="card-body">
                <div class="mb-10">
                    <label for="title" class="required form-label">عنوان</label>
                    <input type="text" id="title" class="form-control" placeholder="عنوان را وارد کنید" />
                </div>
                <div class="mb-2">
                    <label class="form-label ">توضیحات</label>
                    <div class="row row-editor">
                        <div class="editor-container">
                            <div class="editor tw-max-h-96 tw-overflow-auto">
                            </div>
                        </div>
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
                <!--begin::تاریخpicker-->
                <div class="d-none mt-10">
                    <label for="kt_ecommerce_add_product_status_datepicker" class="form-label">انتخاب publishing date و time</label>
                    <input class="form-control flatpickr-input" id="kt_ecommerce_add_product_status_datepicker" placeholder="انتخاب تاریخ &amp; time" type="text" readonly="readonly">
                </div>
                <!--end::تاریخpicker-->
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
                <x-post-type-category />
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
                <select class="form-select mb-2 " data-control="select2" data-placeholder="انتخاب " data-allow-clear="true" data-select2-id="select2-data-12-s43z" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                </select>
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
@endsection
@section('script-before')

<script src="{{ asset('js/ckeditor.js') }}"></script>