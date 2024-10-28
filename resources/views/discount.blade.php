<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')

@section('title', 'تخفیف جدید')

@section('content')

<form method="post" class="row post-type-row">
    @csrf
    <div class="col-lg-8 col-xl-10">
        <div class="card mb-10">
            <div class="card-body">
                <div class="mb-10">
                    <label for="title" class="required form-label">کد تخفیف</label>
                    <input type="text" id="coupon_code" class="form-control" placeholder="عنوان را وارد کنید" />
                    <button type="button" class="btn btn-sm btn-primary mt-2" id="create_coupon_code" data-length-generate="6">ساخت کد تخفیف</button>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h4>اطلاعات تخفیف</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="nav nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-1-tab" data-bs-toggle="pill" data-bs-target="#v-pills-1" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">همگانی</button>
                    <button class="nav-link" id="v-pills-2-tab" data-bs-toggle="pill" data-bs-target="#v-pills-2" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">محدودیت های دسترسی</button>
                    <button class="nav-link" id="v-pills-3-tab" data-bs-toggle="pill" data-bs-target="#v-pills-3" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">محدودیت استفاده</button>
                </div>
                <div class="tab-content mt-6 border-top pt-6" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">
                        <div class="mb-10">
                            <label for="discount_type" class="required form-label">نوع تخفیف</label>
                            <select id="discount_type" class="form-select">
                                <option value="percentage">درصدی</option>
                                <option value="fixed_cart">ثابت سبد خرید</option>
                                <option value="fixed_product">ثابت محصول</option>
                            </select>
                        </div>
                        <div class="mb-10">
                            <label for="discount_amount" class="required form-label">مبلغ تخفیف</label>
                            <input type="text" id="discount_amount" class="form-control" placeholder="مقدار تخفیف را وارد کنید" />
                        </div>
                        <div class="mb-10">
                            <label for="discount_code" class="form-label">تاریخ شروع</label>
                            <input type="text"  data-jdp class="form-control" placeholder="تاریخ انقضا را انتخاب کنید" />
                        </div>
                        <div class="mb-10">
                            <label for="discount_code" class="form-label">تاریخ پایان</label>
                            <input type="text"  data-jdp class="form-control" placeholder="تاریخ انقضا را انتخاب کنید" />
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-2-tab">
                        <div class="mb-10">
                            <label for="discount_amount" class="form-label">حداقل هزینه</label>
                            <input type="text" id="discount_amount" class="form-control" placeholder="هیچ حداقلی وجود ندارد" />
                        </div>
                        <div class="mb-10">
                            <label for="discount_amount" class="form-label">حداکثر هزینه</label>
                            <input type="text" id="discount_amount" class="form-control" placeholder="بدون محدودیت" />
                        </div>
                        <div class="form-check mb-10">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                به جز محصولات فروش ویژه
                            </label>
                        </div>
                        <div class="mb-10">
                            <x-advanced-search multiple type="product" label="محصولات" name="allowed_products" />
                        </div>
                        <div class="mb-10">
                            <x-advanced-search multiple type="product" label="به جز این محصولات" name="disallowed_products" />
                        </div>
                        <div class="mb-10">
                            <x-advanced-search multiple type="category" label="دسته های محصولات" name="allowed_category" />
                        </div>
                        <div class="mb-10">
                            <x-advanced-search multiple type="category" label="به جز این دسته ها" name="disallowed_category" />
                        </div>
                        <div class="mb-10">
                            <label for="discount_amount" class="form-label">شماره تلفن های مجاز</label>
                            <input type="text" id="allowed_phone_number" class="form-control" />
                            <span class="text-muted fs-7">شماره تلفن را وارد کنید و Enter را بزنید</span>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-3-tab">
                        <div class="mb-10">
                            <label for="discount_amount" class="form-label">محدودیت استفاده از کد تخفیف</label>
                            <input type="text" id="discount_amount" class="form-control" placeholder="هیچ محدودیتی وجود ندارد" />
                        </div>
                        <div class="mb-10">
                            <label for="discount_limit_user_amount" class="form-label">محدودیت مصرف برای هر کاربر</label>
                            <input type="text" id="discount_limit_user_amount" class="form-control" placeholder="هیچ محدودیتی وجود ندارد" />
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
                <div class="text-muted fs-7">وضعیت تخفیف را تنظیم کنید.</div>
                <!--end::توضیحات-->


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
    </div>
</form>
@endsection

@section("script-before")
<script src="{{asset('plugins/jalalidatepicker.min.js')}}"></script>
@endsection

@section("scripts")
<script>

    jalaliDatepicker.startWatch();

    $(document).ready(function() {
        new Tagify(document.getElementById('allowed_phone_number'));
    })
</script>

@endsection