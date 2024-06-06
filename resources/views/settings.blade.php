<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')

@section('title', 'تنظمیات')

@section('content')

<form action="" method="post">
    <div class="card">
        <div class="card-body">
            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">لوگو</label>
                <div class="col-lg-8 col-xl-8">
                    <input name="logo" type="file" class="form-control mb-2 mb-md-0" />
                </div>
            </div>

            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">فاوآیکون</label>
                <div class="col-lg-8 col-xl-8">
                    <input name="favicon" type="file" class="form-control mb-2 mb-md-0" />
                </div>
            </div>

            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">آدرس سایت</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="url" name="title" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="آدرس سایت را وارد کنید" value="" />
                </div>
            </div>

            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">عنوان سایت</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="text" name="title" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="عنوان سایت را وارد کنید" value="" />
                </div>
            </div>

            <!--begin::Input group-->
            <div class="row mb-6">
                <label class="col-lg-3 col-form-label required fw-semibold fs-6">متن کپی رایت</label>
                <div class="col-lg-8 col-xl-8">
                    <textarea class="form-control form-control-solid form-control-lg" name="copyright" placeholder="متن کپی رایت را وارد کنید" cols="30" rows="10"></textarea>
                </div>
            </div>
            <!--end::Input group-->

            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">ایمیل مدیریت</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="text" name="title" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="ایمیل مدیریت را وارد کنید" value="" />
                </div>
            </div>

            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">متا های سایت</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="text" name="title" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 global_tag" placeholder="عنوان سایت را وارد کنید" value="" />
                    <span class="text-muted fs-7">متا ها را وارد کنید و Enter را بزنید</span>
                </div>
            </div>

            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">آدرس 1</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="text" name="title" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="آدرس 1 را وارد کنید" value="" />
                </div>
            </div>

            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">آدرس 2</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="text" name="title" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="آدرس 2 را وارد کنید" value="" />
                </div>
            </div>

            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">تلفن 1</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="text" name="title" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="تلفن 1 را وارد کنید" value="" />
                </div>
            </div>

            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">تلفن 2</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="text" name="title" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="تلفن 2 را وارد کنید" value="" />
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">کد پستی</label>
                <div class="col-lg-8 col-xl-8">
                    <input type="text" name="title" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="کد پستی را وارد کنید" value="" />
                </div>
            </div>

            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6">حالت تعمیرات</label>
                <div class="form-check col-lg-8 col-xl-8">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-primary mt-5" type="submit">ذخیره تغییرات</button>
</form>

@endsection