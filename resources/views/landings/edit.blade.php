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
                <label for="title" class="col-2 form-label fw-bold">عنوان:</label>
                <div class="col-10">
                    <input type="text" class="form-control form-control-solid" name="title" value="{{ old('title', $landing->title) }}" placeholder="عنوان را وارد کنید">
                </div>
            </div>

            <!-- فیلد زیر عنوان -->
            <div class="form-group row mb-5">
                <label for="subtitle" class="col-2 form-label fw-bold">زیر عنوان:</label>
                <div class="col-10">
                    <input type="text" class="form-control form-control-solid" name="subtitle" value="{{ old('subtitle', $landing->subtitle) }}" placeholder="زیر عنوان را وارد کنید">
                </div>
            </div>

            <!-- فیلد متن دکمه -->
            <div class="form-group row mb-5">
                <label for="button_text" class="col-2 form-label fw-bold">متن دکمه:</label>
                <div class="col-10">
                    <input type="text" class="form-control form-control-solid" name="button_text" value="{{ old('button_text', $landing->button_text) }}" placeholder="متن دکمه را وارد کنید">
                </div>
            </div>

            <!-- فیلد لینک دکمه -->
            <div class="form-group row mb-5">
                <label for="button_link" class="col-2 form-label fw-bold">لینک دکمه:</label>
                <div class="col-10">
                    <input type="text" class="form-control form-control-solid" name="button_link" value="{{ old('button_link', $landing->button_link) }}" placeholder="لینک دکمه را وارد کنید">
                </div>
            </div>

            <!-- فیلد نوع نمایش -->
            <div class="form-group row mb-5">
                <label for="direction" class="col-2 form-label fw-bold">نوع نمایش:</label>
                <div class="col-10">
                    <select name="direction" data-control="select2" data-hide-search="true" class="form-select form-select-solid">
                        <option value="rtl" {{ $landing->direction == 'rtl' ? 'selected' : '' }}>راست به چپ</option>
                        <option value="ltr" {{ $landing->direction == 'ltr' ? 'selected' : '' }}>چپ به راست</option>
                    </select>
                </div>
            </div>

            <!-- فیلد تصویر -->
            <div class="form-group row mb-5">
                <label for="file" class="col-2 form-label fw-bold">تصویر:</label>
                <div class="col-10">
                    <x-file-input type="single" :preview="true" name="file" />
                    @if($landing->image)
                        <div class="mt-3">
                            <img src="{{ $landing->image }}" alt="Current Image" class="img-thumbnail" style="width: 150px;">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-success mt-10" type="submit">به‌روزرسانی</button>
</form>
@endsection
