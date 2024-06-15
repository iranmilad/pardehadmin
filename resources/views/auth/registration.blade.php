@extends('layouts.auth')

@section('title', 'ثبت نام')

@section('content')
<form class="w-md-350px mx-auto" method="post" action="{{ route('register.submit') }}">
    @csrf
    <div class="fv-row text-start">
        <div class="row gap-5">
            <div class="fv-row mb-3 mt-3">
                <input autocomplete="off" type="text" name="fullname" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 {{ $errors->has('fullname') ? 'is-invalid' : '' }}" placeholder="نام و نام خانوادگی">
                <div class="fv-plugins-message-container invalid-feedback">
                    @if($errors->has("fullname"))
                    {{$errors->first("fullname")}}
                    @endif
                </div>
            </div>
            <div class="fv-row mb-3">
                <input autocomplete="off" type="email" name="email" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="ایمیل">
                <div class="fv-plugins-message-container invalid-feedback">
                    @if($errors->has("email"))
                    {{$errors->first("email")}}
                    @endif
                </div>
            </div>
            <div class="fv-row mb-3">
                <input autocomplete="off" type="password" dir="ltr" name="password" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="گذرواژه">
                <div class="fv-plugins-message-container invalid-feedback">
                    @if($errors->has("password"))
                    {{$errors->first("password")}}
                    @endif
                </div>
            </div>
            <div class="fv-row mb-3">
                <input autocomplete="off" id="password_confirmation" type="Password" name="password_confirmation" dir="ltr" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="تکرار گذرواژه">
                <div class="fv-plugins-message-container invalid-feedback">
                    @if($errors->has("password"))
                    {{$errors->first("password")}}
                    @endif
                </div>
            </div>

            <div class="fv-row mb-3">
                <input autocomplete="off" type="tel" name="phone" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 {{ $errors->has('phone') ? 'is-invalid' : '' }}" placeholder="تلفن همراه">
                <div class="fv-plugins-message-container invalid-feedback">
                    @if($errors->has("phone"))
                    {{$errors->first("phone")}}
                    @endif
                </div>
            </div>
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
        </div>
    </div>
</form>
@endsection
