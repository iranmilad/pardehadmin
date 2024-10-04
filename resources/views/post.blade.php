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
                    <a class="text-primary nav-link tw-w-max" href="#link_edit" data-bs-toggle="collapse">آدرس لینک</a>
                </div>
                <div class="collapse" id="link_edit">
                    <div>
                        <label for="link">آدرس محصول</label>
                        <input type="text" name="link" id="link" class="form-control" placeholder="آدرس محصول را وارد کنید" />
                    </div>
                </div>
                <div class="mb-2 mt-10">
                    <label class="form-label ">توضیحات کوتاه</label>
                    <div class="row row-editor">
                        <div class="editor-container">
                            <div id="editor" class="editor tw-max-h-96 tw-overflow-auto"></div>
                        </div>
                    </div>
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
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <!-- post id -->
                    <button type="submit" name="remove-post" value="1" class="btn btn-sm btn-danger" id="remove-button">حذف</button>
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
                <x-file-input type="single" :preview="true" name="thumbnail" />
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