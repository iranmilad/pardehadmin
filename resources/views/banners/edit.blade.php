@extends('layouts.primary')

@section('title', 'ویرایش بنر')

@section("toolbar")
<a href="{{ route('banners.view', $banner->id) }}" class="btn btn-primary">اضافه کردن بنر جدید</a>
@endsection

@section('content')

<form method="post" enctype="multipart/form-data" action="{{ route('banners.update', $banner->id) }}">
    @csrf
    @method('PUT')
    <div class="card">
        <div class="card-body">
            @foreach ($banner->images as $bannerImage)

                <div class="row mt-5">

                        <div class="col-12 col-md-6">
                            <div class="mt-5 mb-5">
                                <label class="form-label">عنوان:</label>
                                <input name="titles[]" type="text" class="form-control mb-2 mb-md-0" placeholder="عنوان را وارد کنید"  value="{{ old('titles[]', $bannerImage->title ?? '') }}" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mt-5 mb-5">
                                <label class="form-label">زیرنویس:</label>
                                <input name="captions[]" type="text" class="form-control mb-2 mb-md-0" placeholder="زیرنویس را وارد کنید" value="{{ old('captions[]', $bannerImage->caption ?? '') }}" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mt-5 mb-5">
                                <label class="form-label">دکمه:</label>
                                <input name="alts[]" type="text" class="form-control mb-2 mb-md-0" placeholder="دکمه را وارد کنید" value="{{ old('alts[]', $bannerImage->alt ?? '') }}" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mt-5 mb-5">
                                <label class="form-label">لینک:</label>
                                <input name="links[]" type="text" class="form-control mb-2 mb-md-0" placeholder="لینک را وارد کنید" value="{{ old('links[]', $bannerImage->link ?? '') }}" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mt-5 mb-5">
                                <label class="form-label">تصویر:</label>
                                <x-file-input type="single" :preview="true" name="files[]" :value="$bannerImage->image" />
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <a href="{{ route('banners.deleteImage',$bannerImage->id) }}" class="btn btn-sm btn-light-danger mt-3 mt-md-8 remove_field">
                                <i class="ki-duotone ki-trash fs-5"></i>
                                حذف
                            </a>
                        </div>

                </div>
            @endforeach
        </div>
        <div class="card-footer">
            <!--begin::Form group-->
            <div class="form-group mt-5">
                <button type="submit" class="btn btn-success">ویرایش</button>
            </div>
            <!--end::Form group-->
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // افزودن فیلد تصویر جدید
        $(".add_field").click(function(e) {
            e.preventDefault();
            var html = `
            <div class="form-group row mt-5 mb-5">
                <div class="col-12 col-md-6">
                    <label class="form-label">عنوان:</label>
                    <input name="titles[]" type="text" class="form-control mb-2 mb-md-0" placeholder="عنوان را وارد کنید" />
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label">زیرنویس:</label>
                    <input name="captions[]" type="text" class="form-control mb-2 mb-md-0" placeholder="زیرنویس را وارد کنید" />
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label">دکمه:</label>
                    <input name="alts[]" type="text" class="form-control mb-2 mb-md-0" placeholder="دکمه را وارد کنید" />
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label">لینک:</label>
                    <input name="links[]" type="text" class="form-control mb-2 mb-md-0" placeholder="لینک را وارد کنید" />
                </div>
                <div class="col-12 col-md-6">
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
