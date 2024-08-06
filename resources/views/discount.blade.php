@extends('layouts.primary')

@section('title', isset($discount) ? 'ویرایش تخفیف' : 'تخفیف جدید')

@section('content')
<form method="post" action="{{ isset($discount) ? route('discounts.update', $discount->id) : route('discounts.store') }}" class="row post-type-row">
    @csrf
    @if(isset($discount))
        @method('PUT')
    @endif
    <div class="col-lg-8 col-xl-10">
        <div class="card mb-10">
            <div class="card-body">
                <div class="mb-10">
                    <label for="coupon_code" class="required form-label">کد تخفیف</label>
                    <input type="text" id="coupon_code" name="code" class="form-control" value="{{ old('code', $discount->code ?? '') }}" placeholder="عنوان را وارد کنید" />
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
                            <label for="title" class="required form-label">عنوان تخفیف</label>
                            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $discount->title ?? '') }}" placeholder="عنوان تخفیف را وارد کنید" />
                        </div>
                        <div class="mb-10">
                            <label for="discount_type" class="required form-label">نوع تخفیف</label>
                            <select id="discount_type" name="discount_type" class="form-select">
                                <option value="percentage_cart" {{ (old('discount_type', $discount->discount_type ?? '') == 'percentage_cart') ? 'selected' : '' }}>درصدی سبد خرید</option>
                                <option value="percentage_product" {{ (old('discount_type', $discount->discount_type ?? '') == 'percentage_product') ? 'selected' : '' }}>درصدی محصول</option>
                                <option value="fixed_cart" {{ (old('discount_type', $discount->discount_type ?? '') == 'fixed_cart') ? 'selected' : '' }}>ثابت سبد خرید</option>
                                <option value="fixed_product" {{ (old('discount_type', $discount->discount_type ?? '') == 'fixed_product') ? 'selected' : '' }}>ثابت محصول</option>
                            </select>
                        </div>
                        <div class="mb-10">
                            <label for="usage_type" class="required form-label">نوع استفاده</label>
                            <select id="usage_type" name="usage_type" class="form-select">
                                <option value="single" {{ (old('usage_type', $discount->usage_type ?? '') == 'single') ? 'selected' : '' }}>یکبار مصرف</option>
                                <option value="multiple" {{ (old('usage_type', $discount->usage_type ?? '') == 'multiple') ? 'selected' : '' }}>چندبار مصرف</option>
                            </select>
                        </div>
                        <div class="mb-10">
                            <label for="discount_amount" class="required form-label">مبلغ تخفیف</label>
                            <input type="text" id="discount_amount" name="discount_amount" class="form-control" value="{{ old('discount_amount', $discount->discount_amount ?? '') }}" placeholder="مقدار تخفیف را وارد کنید" />
                        </div>
                        <div class="mb-10">
                            <label for="discount_expire_start" class="form-label">تاریخ شروع</label>
                            <input type="text" id="discount_expire_start" name="discount_expire_start" class="form-control" value="{{ old('discount_expire_start', $discount->discountExpireStartShamsi ?? '') }}" placeholder="تاریخ انقضا را انتخاب کنید" />
                        </div>
                        <div class="mb-10">
                            <label for="discount_expire_end" class="form-label">تاریخ پایان</label>
                            <input type="text" id="discount_expire_end" name="discount_expire_end" class="form-control" value="{{ old('discount_expire_end', $discount->discountExpireEndShamsi?? '') }}" placeholder="تاریخ انقضا را انتخاب کنید" />
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-2-tab">
                        <div class="mb-10">
                            <label for="min_amount" class="form-label">حداقل هزینه</label>
                            <input type="text" id="min_amount" name="min_amount" class="form-control" value="{{ old('min_amount', $discount->min_amount ?? '') }}" placeholder="هیچ حداقلی وجود ندارد" />
                        </div>
                        <div class="mb-10">
                            <label for="max_amount" class="form-label">حداکثر هزینه</label>
                            <input type="text" id="max_amount" name="max_amount" class="form-control" value="{{ old('max_amount', $discount->max_amount ?? '') }}" placeholder="بدون محدودیت" />
                        </div>
                        <div class="form-check mb-10">
                            <input class="form-check-input" type="checkbox" id="except_special_products" name="except_special_products" value="1" {{ old('except_special_products', $discount->except_special_products ?? '') ? 'checked' : '' }}>
                            <label class="form-check-label" for="except_special_products">
                                به جز محصولات فروش ویژه
                            </label>
                        </div>
                        <div class="mb-10">
                            @if (isset($discount))
                            <x-advanced-search multiple type="user" label="تنها این کاربران" name="allowed_users[]" :selected="$allowedUsers" />
                            @else
                            <x-advanced-search multiple type="user" label="تنها این کاربران" name="allowed_users[]" />
                            @endif
                        </div>

                        <div class="mb-10">
                            @if (isset($discount))
                            <x-advanced-search multiple type="group" label="تنها این گروه ها" name="allowed_groups[]" :selected="$allowedGroups" />
                            @else
                            <x-advanced-search multiple type="group" label="تنها این گروه ها" name="allowed_groups[]" />
                            @endif
                        </div>



                        <div class="mb-10">
                            @if (isset($discount))
                            <x-advanced-search multiple type="product" label="محصولات" name="allowed_products[]" :selected="$allowedProducts" />
                            @else
                            <x-advanced-search multiple type="product" label="محصولات" name="allowed_products[]" />
                            @endif
                        </div>

                        <div class="mb-10">
                            @if (isset($discount))
                            <x-advanced-search multiple type="category" label="دسته های محصولات" name="allowed_categories[]" :selected="$allowedCategories" />
                            @else
                            <x-advanced-search multiple type="category" label="دسته های محصولات" name="allowed_categories[]" />
                            @endif
                        </div>


                    </div>
                    <div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-3-tab">
                        <div class="mb-10">
                            <label for="usage_limit" class="form-label">محدودیت استفاده از کد تخفیف</label>
                            <input type="text" id="usage_limit" name="usage_limit" class="form-control" value="{{ old('usage_limit', $discount->usage_limit ?? '') }}" placeholder="هیچ محدودیتی وجود ندارد" />
                        </div>
                        <div class="mb-10">
                            <label for="usage_limit_per_user" class="form-label">محدودیت مصرف برای هر کاربر</label>
                            <input type="text" id="usage_limit_per_user" name="usage_limit_per_user" class="form-control" value="{{ old('usage_limit_per_user', $discount->usage_limit_per_user ?? '') }}" placeholder="هیچ محدودیتی وجود ندارد" />
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
                <select name="status" class="form-select mb-2">
                    <option value="active" {{ (old('status', $discount->status ?? '') == 'active') ? 'selected' : '' }}>فعال</option>
                    <option value="deactivate" {{ (old('status', $discount->status ?? '') == 'deactivate') ? 'selected' : '' }}>غیرفعال</option>
                </select>
                <!--end::انتخاب2-->
                <!--begin::توضیحات-->
                <div class="text-muted fs-7">وضعیت تخفیف را تنظیم کنید.</div>
                <!--end::توضیحات-->
            </div>
            <!--end::کارت body-->
            <div class="card-footer text-end">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    @if(isset($discount))
                        <button type="submit" name="remove-post" value="1" class="btn btn-sm btn-danger" id="remove-button">حذف</button>
                    @endif
                    <button class="btn btn-sm btn-success">{{ isset($discount) ? 'ذخیره تغییرات' : 'ایجاد تخفیف' }}</button>
                </div>
            </div>
        </div>
        <!-- END:STATUS -->
    </div>
</form>
@endsection


@section("script-before")
<script src="{{asset('plugins/flatpicker_fa.js')}}"></script>
<script src="{{asset('plugins/jdate.min.js')}}"></script>
@endsection

@section("scripts")
<script>
    window.Date = window.JDate;

    flatpickr = $("#discount_expire_start,#discount_expire_end").flatpickr({
        disableMobile: "true",
        altInput: true,
        altFormat: "Y-m-d",
        dateFormat: "Y-m-d",
        locale: "fa",
    })

    $(document).ready(function() {
        new Tagify(document.getElementById('allowed_users'));
    })
</script>

@endsection
