@extends('layouts.primary')

@section('title', 'منو')

@section('content')
<form action="" id="menu-form">
    @csrf
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h4>مکان قرارگیری</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label" for="">عنوان</label>
                    <input name="title" type="text" class="form-control form-control-solid" placeholder="عنوان را وارد کنید">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="">انتخاب مکان قرارگیری منو</label>
                    <select class="form-select form-select-solid" name="location" id="">
                        <option value="1">هدر</option>
                        <option value="2">فوتر</option>
                    </select>
                </div>
            </div>

        </div>
    </div>
    <div class="row mt-10">
        <div class="col-lg-3 col-xl-2">
            <!--begin::Accordion-->
            <div class="accordion" id="kt_accordion_1">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="kt_accordion_1_header_1">
                        <button class="accordion-button fs-6 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_1" aria-expanded="false" aria-controls="kt_accordion_1_body_1">
                            دسته ها
                        </button>
                    </h2>
                    <div id="kt_accordion_1_body_1" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_1" data-bs-parent="#kt_accordion_1">
                        <div class="accordion-body">
                            <div class="tw-min-h-40 tw-max-h-72 tw-overflow-y-auto tw-py-1">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" data-link="https://google.com" data-title="پرده عمودی" />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        پرده عمودی
                                    </label>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-primary other_items_menu">افزودن</button>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="kt_accordion_1_header_11">
                        <button class="accordion-button fs-6 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_2" aria-expanded="true" aria-controls="kt_accordion_1_body_1">
                            آدرس سفارشی
                        </button>
                    </h2>
                    <div id="kt_accordion_1_body_2" class="accordion-collapse collapse show" aria-labelledby="kt_accordion_1_header_2" data-bs-parent="#kt_accordion_1">
                        <div class="accordion-body">
                            <div class="mb-5">
                                <label for="" class="form-label">عنوان</label>
                                <input type="text" class="form-control custom-link-title">
                            </div>
                            <div class="mb-5">
                                <label for="" class="form-label">لینک</label>
                                <input type="text" class="form-control custom-link-link" placeholder="https://example.com">
                            </div>
                            <button class="btn btn-sm btn-primary custom-link-gen" type="button">افزودن</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Accordion-->
        </div>
        <div class="col-lg-9 col-xl-10">
            <div class="card">
                <div class="card-body">
                    <div id="menu_lists" class="primary-list">
                        <div>
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                            آیتم شماره 1
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="mb-5">
                                                <label for="" class="form-label">عنوان</label>
                                                <input type="text" class="form-control title">
                                            </div>
                                            <div class="mb-5">
                                                <label for="" class="form-label">لینک</label>
                                                <input type="url" class="form-control link" placeholder="https://example.com">
                                            </div>
                                            <div class="mb-5">
                                                <label for="" class="form-label">نام مستعار</label>
                                                <input type="text" class="form-control slug" placeholder="">
                                            </div>
                                            <div class="mb-5">
                                                <label for="" class="form-label">آیکون</label>
                                                <input type="file" class="form-control icon">
                                            </div>
                                            <div class="mb-5">
                                                <label for="" class="form-label">نمایش عنوان</label>
                                                <select name="" id="" class="form-select show_title">
                                                    <option value="1">بله</option>
                                                    <option value="2">خیر</option>
                                                </select>
                                            </div>
                                            <button class="btn btn-sm btn-danger remove-accordion">حذف</button>
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

    <button class="btn btn-success mt-10" type="submit">ذخیره</button>
</form>
@endsection