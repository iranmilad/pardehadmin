@extends('layouts.primary')


@if(Route::is('landing.edit.show'))
    @section('title', 'ویرایش لندینگ')
@else
    @section('title', 'ایجاد لندینگ')
@endif

@section('content')
<form action="">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="form-group row mb-5">
                <label for="title" class="col-2 form-label fw-bold">عنوان:</label>
                <div class="col-10">
                    <input placeholder="عنوان را وارد کنید" type="text" class="form-control form-control-solid" name="title">
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="title" class="col-2 form-label fw-bold">زیر عنوان:</label>
                <div class="col-10">
                    <input placeholder="زیر عنوان را وارد کنید" type="text" class="form-control form-control-solid" name="subtitle">
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="title" class="col-2 form-label fw-bold">متن دکمه:</label>
                <div class="col-10">
                    <input placeholder="متن دکمه را وارد کنید" type="text" class="form-control form-control-solid" name="button_text">
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="title" class="col-2 form-label fw-bold">لینک دکمه:</label>
                <div class="col-10">
                    <input placeholder="لینک دکمه را وارد کنید" type="text" class="form-control form-control-solid" name="button_link">
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="title" class="col-2 form-label fw-bold">نوع نمایش:</label>
                <div class="col-10">
                    <select name="direction" id="" data-control="select2" data-hide-search="true" class="form-select form-select-solid">
                        <option value="rtl">راست به چپ</option>
                        <option value="ltr">چپ به راست</option>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="title" class="col-2 form-label fw-bold">تصویر:</label>
                <div class="col-10">
                    <x-file-input type="single" :preview="true" name="file" />
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-success mt-10" type="submit">ذخیره</button>
</form>

@endsection