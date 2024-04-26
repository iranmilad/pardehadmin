@extends('layouts.primary')

@section('title', 'کاربر')
@section('content')
  <!--begin::پایه info-->
  <div class="card mb-5 mb-xl-10">
    <!--begin::کارت header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expوed="true" aria-controls="kt_account_profile_details">
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
      <form id="kt_account_profile_details_form" class="form">
        <!--begin::کارت body-->
        <div class="card-body border-top p-9">
          <!--begin::Input group-->
          <div class="row mb-6">
            <!--begin::Tags-->
            <label class="col-lg-4 col-form-label fw-semibold fs-6">آواتار</label>
            <!--end::Tags-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <!--begin::Image input-->
              <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                <!--begin::نمایش existing avatar-->
                <div class="image-input-wrapper w-125px h-125px" style="background-image: url(assets/media/avatars/blank.png)"></div>
                <!--end::نمایش existing avatar-->
                <!--begin::Tags-->
                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="تعویض آواتار">
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
              <div class="form-text">همه بدهکار هستیم file types: png, jpg, jpeg.</div>
              <!--end::Hint-->
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row mb-6">
            <!--begin::Tags-->
            <label class="col-lg-4 col-form-label required fw-semibold fs-6">نام کامل</label>
            <!--end::Tags-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <!--begin::Col-->
              <input type="text" name="fname" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="نام" value="" />
              <!--end::Col-->
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row mb-6">
            <!--begin::Tags-->
            <label class="col-lg-4 col-form-label required fw-semibold fs-6">شماره تلفن</label>
            <!--end::Tags-->
            <!--begin::Col-->
            <div class="col-lg-8">
              <!--begin::Col-->
              <input type="text" name="mobile" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="شماره تلفن" value="" />
              <!--end::Col-->
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
        </div>
        <!--end::کارت body-->
        <!--begin::Actions-->
        <div class="card-footer border-0 d-flex justify-content-end py-6 px-9">
          <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">ذخیره تغییرات</button>
        </div>
        <!--end::Actions-->
      </form>
      <!--end::Form-->
    </div>
    <!--end::Content-->
  </div>
  <!--end::پایه info-->

  <!--begin::پایه info-->
  <div class="card mb-5 mb-xl-10">
    <!--begin::کارت header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expوed="true" aria-controls="kt_account_profile_details">
      <!--begin::کارت title-->
      <div class="card-title m-0">
        <h3 class="fw-bold m-0">تغییر رمز عبور</h3>
      </div>
      <!--end::کارت title-->
    </div>
    <!--begin::کارت header-->
    <!--begin::Content-->
    <div id="kt_account_settings_profile_details" class="collapse show">
      <!--begin::Form-->
      <form id="kt_account_profile_details_form" class="form">
        <!--begin::کارت body-->
        <div class="card-body border-top p-9">
          <!--begin::Input group-->
          <div class="row mb-1">
            <div class="col-lg-4">
              <div class="fv-row mb-0">
                <label for="currentpassword" class="form-label fs-6 fw-bold mb-3">کلمه عبور فعلی</label>
                <input type="password" class="form-control form-control-lg form-control-solid" name="currentpassword" id="currentpassword" />
              </div>
            </div>
            <div class="col-lg-4">
              <div class="fv-row mb-0">
                <label for="newpassword" class="form-label fs-6 fw-bold mb-3">کلمه عبور جدید</label>
                <input type="password" class="form-control form-control-lg form-control-solid" name="newpassword" id="newpassword" />
              </div>
            </div>
            <div class="col-lg-4">
              <div class="fv-row mb-0">
                <label for="confirmpassword" class="form-label fs-6 fw-bold mb-3">تکرار کلمه عبور جدید</label>
                <input type="password" class="form-control form-control-lg form-control-solid" name="confirmpassword" id="confirmpassword" />
              </div>
            </div>
          </div>
          <!--end::Input group-->
        </div>
        <!--end::کارت body-->
        <!--begin::Actions-->
        <div class="card-footer border-0 d-flex justify-content-end py-6 px-9">
          <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">بروزسانی رمز عبور</button>
        </div>
        <!--end::Actions-->
      </form>
      <!--end::Form-->
    </div>
    <!--end::Content-->
  </div>
  <!--end::پایه info-->
@endsection
