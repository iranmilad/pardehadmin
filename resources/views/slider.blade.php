@extends('layouts.primary')

@section('title', 'ویرایش اسلایدر')

@section("toolbar")
<a href="{{ route('sliders.view', $slider->id) }}" class="btn btn-primary">اضافه کردن اسلاید جدید</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form method="post" enctype="multipart/form-data" action="{{ route('sliders.update', $slider->id) }}">
            @csrf
            @method('PUT')

            @foreach ($slider->images as $sliderImage)
            <div class="form-group row mt-5 mb-5">
                <div class="col-md-5">
                    <label class="form-label">عنوان:</label>
                    <input name="titles[]" type="text" class="form-control mb-2 mb-md-0" placeholder="عنوان را وارد کنید"
                        value="{{ old('titles[]', $sliderImage->title ?? '') }}" />
                </div>
                <div class="col-md-5">
                    <label class="form-label">زیرنویس:</label>
                    <input name="captions[]" type="text" class="form-control mb-2 mb-md-0" placeholder="زیرنویس را وارد کنید"
                        value="{{ old('captions[]', $sliderImage->caption ?? '') }}" />
                </div>
                <div class="col-md-5">
                    <label class="form-label">دکمه:</label>
                    <input name="alts[]" type="text" class="form-control mb-2 mb-md-0" placeholder="دکمه را وارد کنید"
                        value="{{ old('alts[]', $sliderImage->alt ?? '') }}" />
                </div>
                <div class="col-md-5">
                    <label class="form-label">لینک:</label>
                    <input name="links[]" type="text" class="form-control mb-2 mb-md-0" placeholder="لینک را وارد کنید"
                        value="{{ old('links[]', $sliderImage->link ?? '') }}" />
                </div>

                <div class="col-md-5">
                    <label class="form-label">تصویر:</label>
                    <x-file-input type="single" :preview="false" name="file"/>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('sliders.deleteImage',$sliderImage->id) }}" class="btn btn-sm btn-light-danger mt-3 mt-md-8 remove_field">
                        <i class="ki-duotone ki-trash fs-5"></i>
                        حذف
                    </a>
                </div>
            </div>
            @endforeach

            <!--begin::Form group-->
            <div class="form-group mt-5">
                <button type="submit" class="btn btn-success">ویرایش</button>
            </div>
            <!--end::Form group-->
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // افزودن فیلد تصویر جدید
        $(".add_field").click(function(e) {
            e.preventDefault();
            var html = `
            <div class="form-group row mt-5 mb-5">
                <div class="col-md-5">
                    <label class="form-label">عنوان:</label>
                    <input name="titles[]" type="text" class="form-control mb-2 mb-md-0" placeholder="عنوان را وارد کنید" />
                </div>
                <div class="col-md-5">
                    <label class="form-label">زیرنویس:</label>
                    <input name="captions[]" type="text" class="form-control mb-2 mb-md-0" placeholder="زیرنویس را وارد کنید" />
                </div>
                <div class="col-md-5">
                    <label class="form-label">دکمه:</label>
                    <input name="alts[]" type="text" class="form-control mb-2 mb-md-0" placeholder="دکمه را وارد کنید" />
                </div>
                <div class="col-md-5">
                    <label class="form-label">لینک:</label>
                    <input name="links[]" type="text" class="form-control mb-2 mb-md-0" placeholder="لینک را وارد کنید" />
                </div>
                <div class="col-md-5">
                    <label class="form-label">تصویر:</label>
                    <input name="files[]" type="file" class="form-control mb-2 mb-md-0" />
                </div>
                <div class="col-md-2">
                    <a href="javascript:;" class="btn btn-sm btn-light-danger mt-3 mt-md-8 remove_field">
                        <i class="ki-duotone ki-trash fs-5"></i>
                        حذف
                    </a>
                </div>
            </div>
            `;
            $(".repeater").append(html);
        });

        // حذف فیلد تصویر
        $(document).on("click", ".remove_field", function() {
            $(this).closest('.form-group').remove();
        });
    });
</script>
@endsection
