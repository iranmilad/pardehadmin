@extends('layouts.primary')

@section('title', 'پروفایل کاربر')
@section('content')

@include('partials.profile')
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
                <span class="fw-bold fs-6 text-gray-800">{{ $user->email ?? $user->mobile }}</span>
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
                <span class="fw-bold fs-6 text-gray-800">{{ $user->first_name }} {{ $user->last_name }}</span>
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
                <span class="fw-semibold text-gray-800 fs-6">{{ $user->role->title }}</span>
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
                <span class="fw-bold fs-6 text-gray-800 me-2">{{ $user->mobile }}</span>
                @if ($user->verified)
                    <span class="badge badge-success">تایید شده</span>
                @else
                    <span class="badge badge-danger">تایید نشده</span>
                @endif
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
                <a href="mailto:{{ $user->email }}" class="fw-semibold fs-6 text-gray-800 text-hover-primary">{{ $user->email }}</a>
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
                <span class="fw-bold fs-6 text-gray-800">{{ $user->national_code }}</span>
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
                <span class="fw-bold fs-6 text-gray-800">{{ $user->province }} - {{ $user->city }}</span>
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
                    @if (!$user->verified)
                        <h4 class="text-gray-900 fw-bold">شماره تلفن تایید نشده است</h4>
                    @endif
                </div>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->


        </div>
        <!--end::Notice-->

        @if(!$user->active)
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
        @endif

        @if(!$user->email_verified_at)
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
                    <h4 class="text-gray-900 fw-bold">ایمیل تایید نشده است</h4>
                </div>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Notice-->
        @endif



    </div>
    <!--end::کارت body-->
</div>
<!--end::details نمایش-->
@endsection
