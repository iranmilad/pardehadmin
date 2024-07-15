@extends('layouts.primary')

@section('title', 'سرویس های شخص ثالث')

@section('content')

<form action="" method="post">
    @csrf
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                پشتیبانی آنلاین
            </h4>
        </div>
        <div class="card-body">
            <div class="mb-10">
                <label for="exampleFormControlInput1" class="required form-label">نام کاربری</label>
                <input type="text" class="form-control form-control-solid" placeholder="" />
            </div>
            <div class="mb-10">
                <label for="exampleFormControlInput1" class="required form-label">رمز عبور</label>
                <input type="password" class="form-control form-control-solid" placeholder="" />
            </div>
            <div class="mb-10">
                <label for="exampleFormControlInput1" class="required form-label">کد لایسنس</label>
                <input type="text" class="form-control form-control-solid" placeholder="" />
            </div>
            <div class="mb-10">
                <label for="exampleFormControlInput1" class="required form-label">نام سرویس</label>
                <input type="text" class="form-control form-control-solid" placeholder="" />
            </div>
            <div class="mb-10">
                <label for="exampleFormControlInput1" class="form-label">محل قرارگیری در صفحه</label>
                <select name="" id="" class="form-select form-select-solid">
                    <option value="1">پایین راست</option>
                    <option value="2">پایین چپ</option>
                </select>
            </div>
        </div>
    </div>
    <button class="btn btn-success mt-10" type="submit">ذخیره</button>
</form>

@endsection