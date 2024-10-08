@extends('layouts.primary')

@section('title', 'ویرایش کاربر')
@section('content')
<form method="post" action="{{route('users.update', ['id' => $user->id])}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
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
                        <x-file-input type="single" :preview="true" name="avatar" :value="$user->avatar" />
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">نام</label>
                        <div class="col-lg-8 col-xl-6">
                            <input type="text" name="first_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="نام را وارد کنید" value="{{ old('first_name', $user->first_name) }}" />
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">نام خانوادگی</label>
                        <div class="col-lg-8 col-xl-6">
                            <input type="text" name="last_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="نام خانوادگی را وارد کنید" value="{{ old('last_name', $user->last_name) }}" />
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">شماره تلفن</label>
                        <div class="col-lg-8 col-xl-6">
                            <input type="text" name="mobile" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="شماره تلفن را وارد کنید" value="{{ old('mobile', $user->mobile) }}" />
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">ایمیل</label>
                        <div class="col-lg-8 col-xl-6">
                            <input type="text" name="email" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="ایمیل را وارد کنید" value="{{ old('email', $user->email) }}" />
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">کد ملی</label>
                        <div class="col-lg-8 col-xl-6">
                            <input type="text" name="national_code" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="کد ملی را وارد کنید" value="{{ old('national_code', $user->national_code) }}" />
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">کشور</label>
                        <div class="col-lg-8 col-xl-6">
                            <select class="form-select form-select-solid form-select-lg" name="country">
                                <option selected value="iran">ایران</option>
                            </select>
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">استان</label>
                        <div class="col-lg-8 col-xl-6">
                            <input type="text" name="province" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="استان را وارد کنید" value="{{ old('province', $user->province) }}" />
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">شهر</label>
                        <div class="col-lg-8 col-xl-6">
                            <input type="text" name="city" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="شهر را وارد کنید" value="{{ old('city', $user->city) }}" />
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">آدرس</label>
                        <div class="col-lg-8 col-xl-6">
                            <textarea class="form-control form-control-solid form-control-lg" name="address" placeholder="آدرس را وارد کنید" cols="30" rows="10">{{ old('address', $user->address) }}</textarea>
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6 required">کد پستی 10 رقمی</label>
                        <div class="col-lg-8 col-xl-6">
                            <input type="text" name="postal_code" class="form-control form-control-lg form-control-solid" placeholder="کد پستی را وارد کنید" value="{{ old('postal_code', $user->postal_code) }}" />
                        </div>
                    </div>
                    <!--end::Input group-->

                    @if(auth()->user()->hasRole('superAdmin'))
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">نقش</label>
                            <div class="col-lg-8 col-xl-6">
                                <select class="form-select form-select-solid form-select-lg" name="role_id" aria-label="Select Role">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                            {{ $role->display_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!--end::Input group-->
                    @endif
                




                </div>
                <!--end::کارت body-->
                <!--begin::Actions-->
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">ذخیره تغییرات</button>
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Form-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::پایه info-->
</form>
@endsection
