@extends('layouts.auth')

@section('title', 'رمز عبور جدید')

@section('content')
<form class="w-md-350px mx-auto" method="post" action="{{ route('password.email.update') }}">
    @csrf
    <div class="fv-row text-start">
        <div class="row gap-5">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <!--end::Input=-->
            <div class="fv-row mb-3 mt-3">
                <input autocomplete="off" type="password" name="password" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="رمز عبور جدید">
                <div class="fv-plugins-message-container invalid-feedback">
                    @if($errors->has("password"))
                    {{$errors->first("password")}}
                    @endif
                </div>
            </div>
            <!--end::Input=-->

            <!--end::Input=-->
            <div class="fv-row mb-3">
                <input autocomplete="off" type="password" name="password_confirmation" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" placeholder="تکرار رمز عبور">
                <div class="fv-plugins-message-container invalid-feedback">
                    @if($errors->has("password_confirmation"))
                    {{$errors->first("password_confirmation")}}
                    @endif
                </div>
            </div>
            <!--end::Input=-->

            <div class="d-grid mb-10">
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label">ثبت</span>
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
