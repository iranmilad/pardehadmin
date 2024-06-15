@extends('layouts.auth')

@section('title', 'فراموشی رمز عبور')

@section('content')
<form class="w-md-350px mx-auto" method="post" action="{{ route('forgot.send') }}">
    @csrf
    <div class="fv-row text-start">
        <div class="row gap-5">
            @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            <div class="fv-row mb-3 mt-3">
                <input autocomplete="off" type="email" name="email" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="ایمیل">
                <div class="fv-plugins-message-container invalid-feedback">
                    @if($errors->has("email"))
                        {{$errors->first("email")}}
                    @endif
                </div>
            </div>
            <div class="d-grid mb-10">
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label">ادامه</span>
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
