@extends('layouts.auth')

@section('title', 'ثبت نام')

@section('content')
<form class="w-md-350px  mx-auto" method="post" action="{{ route('signup') }}">
    @csrf
    <div class="fv-row text-start">
        <div class="row gap-5">

            <!--end::Input=-->
            <div class="fv-row mb-3 mt-3">
                <input autocomplete="off" type="text" name="fullname" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 {{ $errors->has('fullname') ? 'is-invalid' : '' }}" placeholder="نام و نام خانوادگی">
                <div class="fv-plugins-message-container invalid-feedback">
                    @if($errors->has("fullname"))
                    {{$errors->first("fullname")}}
                    @endif
                </div>
            </div>
            <!--end::Input=-->

            <!--end::Input=-->
            <div class="fv-row mb-3">
                <input autocomplete="off" type="email" name="email" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="ایمیل">
                <div class="fv-plugins-message-container invalid-feedback">
                    @if($errors->has("email"))
                    {{$errors->first("email")}}
                    @endif
                </div>
            </div>
            <!--end::Input=-->

            <!--end::Input=-->
            <div class="fv-row mb-3">
                <input autocomplete="off" type="password" dir="ltr" name="password" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="گذرواژه">
                <div class="fv-plugins-message-container invalid-feedback">
                    @if($errors->has("password"))
                    {{$errors->first("password")}}
                    @endif
                </div>
            </div>
            <!--end::Input=-->

            <!--end::Input=-->
            <div class="fv-row mb-3">
                <input autocomplete="off" type="tel" name="phone" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 {{ $errors->has('phone') ? 'is-invalid' : '' }}" placeholder="تلفن همراه">
                <div class="fv-plugins-message-container invalid-feedback">
                    @if($errors->has("phone"))
                    {{$errors->first("phone")}}
                    @endif
                </div>
            </div>
            <!--end::Input=-->

            <div class="d-grid mb-5">
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label">ثبت نام</span>
                </button>
            </div>

            <div class="d-grid mb-5">
                <a href="{{ route('login') }}" class="btn btn-light">
                    <span class="indicator-label">ورود</span>
                </a>
            </div>

            <div class="text-center">
                <a href="#" class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom">
                    <i class="ki-duotone ki-night-day theme-light-show fs-2 fs-lg-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                        <span class="path5"></span>
                        <span class="path6"></span>
                        <span class="path7"></span>
                        <span class="path8"></span>
                        <span class="path9"></span>
                        <span class="path10"></span>
                    </i>
                    <i class="ki-duotone ki-moon theme-dark-show fs-2 fs-lg-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </a>
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3 my-0">
                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                            <span class="menu-icon" data-kt-element="icon">
                                <i class="ki-duotone ki-night-day fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                    <span class="path7"></span>
                                    <span class="path8"></span>
                                    <span class="path9"></span>
                                    <span class="path10"></span>
                                </i>
                            </span>
                            <span class="menu-title">روشن</span>
                        </a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3 my-0">
                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                            <span class="menu-icon" data-kt-element="icon">
                                <i class="ki-duotone ki-moon fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">تیره</span>
                        </a>
                    </div>
                    <!--end::Menu item-->
                </div>
            </div>


        </div>
</form>
@endsection