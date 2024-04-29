@extends('layouts.primary')

@section('title', 'پروفایل کاربر')
@section('content')
<x-profile />
<!--begin::details نمایش-->
<div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
    <!--begin::کارت header-->
    <div class="card-header cursor-pointer">
        <!--begin::کارت title-->
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">مشخصات کاربر</h3>
        </div>
        <!--end::کارت title-->
        <!--begin::Actions-->
        <button class="btn btn-sm btn-primary align-self-center"> پروفایل</button>
        <!--end::Actions-->
    </div>
    <!--begin::کارت header-->
    <!--begin::کارت body-->
    <div class="card-body p-9">
        <!--begin::Row-->
        <div class="row mb-7">
            <!--begin::Tags-->
            <label class="col-lg-4 fw-semibold text-muted">نام کاربری</label>
            <!--end::Tags-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <span class="fw-bold fs-6 text-gray-800">admin</span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
        <!--begin::Row-->
        <div class="row mb-7">
            <!--begin::Tags-->
            <label class="col-lg-4 fw-semibold text-muted">نام کامل</label>
            <!--end::Tags-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <span class="fw-bold fs-6 text-gray-800">فرهاد باقری</span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
        <!--begin::Input group-->
        <div class="row mb-7">
            <!--begin::Tags-->
            <label class="col-lg-4 fw-semibold text-muted">نقش</label>
            <!--end::Tags-->
            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
                <span class="fw-semibold text-gray-800 fs-6">مدیر کل</span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-7">
            <!--begin::Tags-->
            <label class="col-lg-4 fw-semibold text-muted">شماره تلفن</label>
            <!--end::Tags-->
            <!--begin::Col-->
            <div class="col-lg-8 d-flex align-items-center">
                <span class="fw-bold fs-6 text-gray-800 me-2">09374039436</span>
                <span class="badge badge-success">تایید شده</span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-7">
            <!--begin::Tags-->
            <label class="col-lg-4 fw-semibold text-muted">ایمیل</label>
            <!--end::Tags-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary">coding.farhad@gmail.com</a>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-7">
            <!--begin::Tags-->
            <label class="col-lg-4 fw-semibold text-muted">کد ملی</label>
            <!--end::Tags-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <span class="fw-bold fs-6 text-gray-800">0123456789</span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-7">
            <!--begin::Tags-->
            <label class="col-lg-4 fw-semibold text-muted">استان و شهر</label>
            <!--end::Tags-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <span class="fw-bold fs-6 text-gray-800">فارس - شیراز</span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Notice-->
        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6 mb-2">
            <!--begin::Icon-->
            <i class="ki-duotone ki-information fs-2tx text-warning me-4">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
            </i>
            <!--end::Icon-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack flex-grow-1">
                <!--begin::Content-->
                <div class="fw-semibold">
                    <h4 class="text-gray-900 fw-bold">شماره تلفن تایید نشده است</h4>
                </div>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Notice-->
        <!--begin::Notice-->
        <div class="notice d-flex bg-light-danger rounded border-danger border border-dashed p-6 mb-2">
            <!--begin::Icon-->
            <i class="ki-duotone ki-information fs-2tx text-danger me-4">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
            </i>
            <!--end::Icon-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack flex-grow-1">
                <!--begin::Content-->
                <div class="fw-semibold">
                    <h4 class="text-gray-900 fw-bold">کاربر غیر فعال است</h4>
                </div>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Notice-->
    </div>
    <!--end::کارت body-->
</div>
<!--end::details نمایش-->
@endsection