@extends('layouts.primary')

@section('title', 'ویرایش روش پرداخت')


@section('content')
<form action="" method="post">
    @csrf
    <div class="tw-text-left mb-10">
        <button class="btn btn-danger" type="submit">حذف</button>
    </div>
    <div class="card mt-10">
        <div class="card-header">
            <h4 class="card-title">روش درگاه بانکی</h4>
        </div>
        <div class="card-body">
            <div class="mb-5">
                <label for="" class="form-label">عنوان</label>
                <input type="text" class="form-control" placeholder="عنوان را وارد کنید">
            </div>
            <div class="mb-5">
                <label for="" class="form-label">لوگو</label>
                <x-file-input type="single" :preview="false" name="pic" />
            </div>
            <h4 class="my-6">تنظیمات حساب زرین پال</h4>
            <div class="form-group row">
                <label class="col-3 col-form-label">مرچنت کد</label>
                <div class="col-9">
                    <input class="form-control" type="text" value="1234567890">
                </div>
            </div>
            <h4 class="mb-6 mt-10">تنظیمات عملیات پرداخت</h4>
            <div class="form-group row mb-5">
                <label class="col-3 col-form-label">پیام پرداخت موفق</label>
                <div class="col-9">
                    <textarea class="form-control" rows="3">پرداخت با موفقیت انجام شد.</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-3 col-form-label">پیام پرداخت ناموفق</label>
                <div class="col-9">
                    <textarea class="form-control" rows="3">پرداخت ناموفق بود.</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-10">
        <div class="card-header">
            <h4 class="card-title">روش کارت به کارت</h4>
        </div>
        <div class="card-body">
            <div>
                <label for="" class="form-label">عنوان</label>
                <input type="text" class="form-control" placeholder="عنوان را وارد کنید" disabled>
            </div>
            <h4 class="my-6">اطلاعات حساب بانکی</h4>
            <div class="other_repeater">
                <!--begin::Form group-->
                <div class="form-group">
                    <!-- data-repeater-list must be unique -->
                    <!-- data-repeater-list must be unique -->
                    <!-- data-repeater-list must be unique -->
                    <!-- data-repeater-list must be unique -->
                    <!-- data-repeater-list must be unique -->
                    <div data-repeater-list="pattern_repeater">
                        <div class="mt-3" data-repeater-item>
                            <div class="form-group row">
                                <div class="col-12 col-md">
                                    <label class="form-label required">نام بانک:</label>
                                    <input name="option[bankname]" type="text" class="form-control mb-2 mb-md-0" placeholder="نام بانک را وارد کنید" />
                                </div>
                                <div class="col-12 col-md">
                                    <label class="form-label required">شماره حساب:</label>
                                    <input name="option[accountnumber]" type="text" class="form-control mb-2 mb-md-0" placeholder="شماره حساب را وارد کنید" />
                                </div>
                                <div class="col-12 col-md">
                                    <label class="form-label">شماره کارت:</label>
                                    <input name="option[cardnumber]" type="text" class="form-control mb-2 mb-md-0" placeholder="شماره کارت را وارد کنید" />
                                </div>
                                <div class="col-12 col-md">
                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                        <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                        حذف
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
                        افزودن
                        <i class="ki-duotone ki-plus fs-3 pe-0"></i>
                    </a>
                </div>
                <!--end::Form group-->
            </div>
        </div>
    </div>

    <div class="card mt-10">
        <div class="card-header">
            <h4 class="card-title">روش پرداخت هنگام دریافت</h4>
        </div>
        <div class="card-body">
            <div>
                <label for="" class="form-label">عنوان</label>
                <input type="text" class="form-control" placeholder="عنوان را وارد کنید" >
            </div>
        </div>
    </div>
    <button type="submit" class="mt-10 btn btn-success">ذخیره</button>
</form>
@endsection