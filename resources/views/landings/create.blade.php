@extends('layouts.primary')

@section('title', 'ویرایش لندینگ')

@section('content')
<form action="{{ route('landings.store') }}" method="POST" enctype="multipart/form-data">
    @csrf



    <input name="widget_id" type="hidden" value="{{ $widget->id }}"/>
    <input name="type" type="hidden" value="selection"/>

    <div class="card">
        <div class="card-body">
            <div class="form-group row mb-5">
                <label for="name" class="col-2 form-label fw-bold">نام لندینگ:</label>
                <div class="col-10">
                    <input type="text" class="form-control form-control-solid" name="name" value="" placeholder="نام لندینگ را وارد کنید">
                </div>
            </div>

            <!-- فیلد عنوان -->
            <div class="form-group row mb-5">
                <label for="title" class="col-2 form-label fw-bold">عنوان:</label>
                <div class="col-10">
                    <input type="text" class="form-control form-control-solid" name="title" value="" placeholder="عنوان را وارد کنید">
                </div>
            </div>

            <div class="form-group row mb-5">
                <label for="subtitle" class="col-2 form-label fw-bold">توضیحات:</label>
                <div class="col-10">
                    <input type="text" class="form-control form-control-solid" name="description" value="" placeholder=" توضیحات را وارد کنید">
                </div>
            </div>



            <!-- فیلد متن دکمه -->
            <div class="form-group row mb-5">
                <label for="button_text" class="col-2 form-label fw-bold">متن دکمه:</label>
                <div class="col-10">
                    <input type="text" class="form-control form-control-solid" name="cap1" value="" placeholder="متن دکمه را وارد کنید">
                </div>
            </div>

            <!-- فیلد لینک دکمه -->
            <div class="form-group row mb-5">
                <label for="button_link" class="col-2 form-label fw-bold">لینک دکمه:</label>
                <div class="col-10">
                    <input type="text" class="form-control form-control-solid" name="btnLink1" value="" placeholder="لینک دکمه را وارد کنید">
                </div>
            </div>

            <!-- فیلد متن دکمه -->
            <div class="form-group row mb-5">
                <label for="cap2" class="col-2 form-label fw-bold">متن دکمه:</label>
                <div class="col-10">
                    <input type="text" class="form-control form-control-solid" name="cap2" value="" placeholder="متن دکمه را وارد کنید">
                </div>
            </div>

            <!-- فیلد لینک دکمه -->
            <div class="form-group row mb-5">
                <label for="btnLink2" class="col-2 form-label fw-bold">لینک دکمه:</label>
                <div class="col-10">
                    <input type="text" class="form-control form-control-solid" name="btnLink2" value="" placeholder="لینک دکمه را وارد کنید">
                </div>
            </div>



            <!-- فیلد نوع نمایش -->
            <div class="form-group row mb-5">
                <label for="direction" class="col-2 form-label fw-bold">نوع نمایش:</label>
                <div class="col-10">
                    <select name="direction" data-control="select2" data-hide-search="true" class="form-select form-select-solid">
                        <option value="rtl" selected>راست به چپ</option>
                        <option value="ltr">چپ به راست</option>
                    </select>
                </div>
            </div>

            <div class="form-group row mb-5">
                <label class="col-2 form-label">استایل:</label>
                <div class="col-10">
                    <select class="form-select form-select-solid tw-w-max" name="style" id="style">
                        @foreach ($styles as $style)
                            <option value="{{ $style }}">{{ $style }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- فیلد لینک تصویر -->
            <div class="form-group row mb-5">
                <label for="link" class="col-2 form-label fw-bold">لینک تصویر:</label>
                <div class="col-10">
                    <input type="text" class="form-control form-control-solid" name="link" value="" placeholder="لینک تصویر را وارد کنید">
                </div>
            </div>

            <!-- فیلد تصویر -->
            <div class="form-group row mb-5">
                <label for="file" class="col-2 form-label fw-bold">تصویر:</label>
                <div class="col-10">
                    <x-file-input type="single" :preview="true" name="file" />

                </div>
            </div>



        </div>
    </div>

    <button class="btn btn-success mt-10" type="submit">به‌روزرسانی</button>
</form>
@endsection
