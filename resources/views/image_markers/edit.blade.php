
@extends('layouts.primary')

@section('title', 'ویرایش نشانه گذاری تصویر')

@section('content')
<div class="card tw-select-none">
    <div class="card-header py-4">
        <form action="{{ route('image-markers.update', $imageMarker->id) }}" method="post" class="d-flex tw-items-start tw-gap-3 md:align-items-center tw-w-full tw-justify-between tw-flex-col md:tw-flex-row" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="marks_id" value="{{ $imageMarker->id }}">
            <input id="data-dots" name="marks" type="hidden" value="{{$imageMarker->marks }}" />
            <div class="d-flex align-items-center gap-5">
                <x-file-input type="single" :preview="false" name="image" value="{{ $imageMarker->image_path }}" />
                <button type="button" id="remove_image" class="btn btn-danger">حذف تصویر</button>
            </div>
            <button class="btn btn-sm btn-success" type="submit">ذخیره</button>
        </form>
    </div>
    <div class="card-body">
        <div class="image_dotter">
            <img src="{{ asset( $imageMarker->image_path) }}" alt="" id="imgmarker-preview">
        </div>
    </div>
</div>

<div class="modal fade" id="selectProductModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">انتخاب محصول</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="" style="z-index: 999999;">
            <x-advanced-search type="product" label="جستجوی محصول" name="product" solid />
            </form>
        </div>
        <div class="modal-footer">
            <div class="w-100 d-flex align-items-center tw-justify-between">
            <div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                <button type="button" class="btn btn-primary" id="selectProductModalSubmit">اعمال</button>
            </div>
            <button type="button" class="btn btn-danger d-none" id="removeSelectDot">حذف</button>
            </div>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="priceModal" tabindex="-1" aria-labelledby="priceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="product_details tw-min-h-8 tw-w-full tw-p-5"></div>
            </div>
            <div class="modal-footer tw-justify-start tw-border-none tw-bg-gray-100">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <div>
                    <button type="button" class="btn btn-secondary closeModal" data-bs-dismiss="modal">بستن</button>
                    <a type="button" class="btn btn-primary tw-py-1.5">مشاهده محصول</a>
                    </div>
                    <button class="btn btn-dark" id="editDot">ویرایش نشانه</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


