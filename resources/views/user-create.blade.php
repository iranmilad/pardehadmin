@extends('layouts.primary')

@section('title', 'ایجاد کاربر جدید')
@section('content')
<form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
    @csrf
    <!--begin::پایه info-->
    <div class="card mb-5 mb-xl-10">
        <!--begin::کارت header-->
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
            <!--begin::کارت title-->
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">تنظیمات حساب</h3>
            </div>
            <!--end::کارت title-->
        </div>
        <!--begin::کارت header-->
        <!--begin::Content-->
        <div id="kt_account_settings_profile_details" class="collapse show">
            <!--begin::Form-->
            <div id="kt_account_profile_details_form" class="form">
                <!--begin::کارت body-->
                <div class="card-body border-top p-9">
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Tags-->
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">عکس پروفایل</label>
                        <!--end::Tags-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <!--begin::Image input-->
                            <div class="image-input image-input-outline {{ isset($user) && $user->avatar ?  '' : 'image-input-placeholder' }} mb-3" data-kt-image-input="true" style="background-image: url({{ isset($user) && $user->avatar ? asset($user->avatar) : asset('/images/avatar.png') }});">
                                <!--begin::نمایش existing avatar-->
                                <div class="image-input-wrapper w-125px h-125px"></div>
                                <!--end::نمایش existing avatar-->
                                <!--begin::Tags-->
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="تعویض آواتار">
                                    <i class="ki-duotone ki-pencil fs-7">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <!--begin::Inputs-->
                                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg"  />
                                    <input type="hidden" name="avatar_remove" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Tags-->
                                <!--begin::انصراف-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="انصراف avatar">
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
                            <!--begin::Hint-->
                            <div class="form-text">فرمت های مجاز : png, jpg, jpeg.</div>
                            <!--end::Hint-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">نام</label>
                        <div class="col-lg-8 col-xl-4">
                            <input type="text" name="first_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="نام را وارد کنید" value="{{ old('first_name') }}" />
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">نام خانوادگی</label>
                        <div class="col-lg-8 col-xl-4">
                            <input type="text" name="last_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="نام خانوادگی را وارد کنید" value="{{ old('last_name') }}" />
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">شماره تلفن</label>
                        <div class="col-lg-8 col-xl-4">
                            <input type="text" name="mobile" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="شماره تلفن را وارد کنید" value="{{ old('mobile') }}" />
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">ایمیل</label>
                        <div class="col-lg-8 col-xl-4">
                            <input type="text" name="email" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="ایمیل را وارد کنید" value="{{ old('email') }}" />
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">کد ملی</label>
                        <div class="col-lg-8 col-xl-4">
                            <input type="text" name="national_code" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="کد ملی را وارد کنید" value="{{ old('national_code') }}" />
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">رمز عبور</label>
                        <div class="col-lg-8 col-xl-4">
                            <div class="input-group mb-3 create-password-input-group">
                                <button type="button" class="btn btn-dark create-password-input-group-copy" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="کپی کردن رمز عبور"><i class="fa-solid fa-copy"></i></button>
                                <input name="password" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="انتخاب رمز عبور">
                                <button type="button" class="btn btn-primary create-password-input-group-generate">ایجاد رمز عبور</button>
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">نقش</label>
                        <div class="col-lg-8 col-xl-4">
                            <select class="form-select form-select-solid form-select-lg" name="role_id" aria-label="Default select example">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::کارت body-->
            </div>
            <!--end::Form-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::پایه info-->
    <button class="btn btn-success">ایجاد کاربر</button>
</form>
@endsection
