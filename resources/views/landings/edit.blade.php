@extends('layouts.primary')

@section('title', 'ویرایش لندینگ')

@section('content')
<form action="{{ route('landings.update', $landing->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card">
        <div class="card-body">

            <!-- فیلد عنوان -->
            <div class="form-group row mb-5">
                <label for="block" class="col-2 form-label fw-bold">نام:</label>
                <div class="col-10">
                    <input type="text" class="form-control form-control-solid" name="block" value="{{ old('block', $landing->block) }}" placeholder="نام را وارد کنید">
                </div>
            </div>

            <!-- فیلد عنوان -->
            <div class="form-group row mb-5">
                <label for="title" class="col-2 form-label fw-bold">عنوان:</label>
                <div class="col-10">
                    <input type="text" class="form-control form-control-solid" name="title" value="{{ old('title', $landing->settings->title) }}" placeholder="عنوان را وارد کنید">
                </div>
            </div>

            <!-- فیلد زیر عنوان -->
            <div class="form-group row mb-5">
                <label for="description" class="col-2 form-label fw-bold">زیر عنوان:</label>
                <div class="col-10">
                    <input type="text" class="form-control form-control-solid" name="description" value="{{ old('description', $landing->settings->description) }}" placeholder="زیر عنوان را وارد کنید">
                </div>
            </div>

            <!-- فیلد متن دکمه -->
            <div class="form-group row mb-5">
                <label for="cap1" class="col-2 form-label fw-bold">متن دکمه:</label>
                <div class="col-10">
                    <input type="text" class="form-control form-control-solid" name="cap1" value="{{ old('cap1', $landing->settings->cap1) }}" placeholder="متن دکمه را وارد کنید">
                </div>
            </div>

            <!-- فیلد لینک دکمه -->
            <div class="form-group row mb-5">
                <label for="btnLink1" class="col-2 form-label fw-bold">لینک دکمه:</label>
                <div class="col-10">
                    <input type="text" class="form-control form-control-solid" name="btnLink1" value="{{ old('btnLink1', $landing->settings->btnLink1) }}" placeholder="لینک دکمه را وارد کنید">
                </div>
            </div>

            <!-- فیلد نوع نمایش -->
            <div class="form-group row mb-5">
                <label for="direction" class="col-2 form-label fw-bold">نوع نمایش:</label>
                <div class="col-10">
                    <select name="direction" data-control="select2" data-hide-search="true" class="form-select form-select-solid">
                        <option value="rtl" {{ $landing->settings->direction == 'rtl' ? 'selected' : '' }}>راست به چپ</option>
                        <option value="ltr" {{ $landing->settings->direction == 'ltr' ? 'selected' : '' }}>چپ به راست</option>
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
            <!-- فیلد تصویر -->
            <div class="form-group row mb-5">
                <label for="file" class="col-2 form-label fw-bold">تصویر:</label>
                <div class="col-10">
                    <x-file-input type="single" :preview="true" name="file" />
                    @if($landing->settings->image)
                        <div class="mt-3">
                            <img src="{{ $landing->settings->image }}" alt="Current Image" class="img-thumbnail" style="width: 150px;">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-success mt-10" type="submit">به‌روزرسانی</button>
</form>
@endsection
