@extends('layouts.primary')

@section('title', 'نشانه گذاری تصویر')

@section('content')
<div class="card tw-select-none">
    <div class="card-header py-4">
        <form action="{{ route('image-markers.store') }}" method="post" class="d-flex tw-items-start tw-gap-3 md:align-items-center tw-w-full tw-justify-between tw-flex-col md:tw-flex-row" enctype="multipart/form-data">
            @csrf
            <input id="data-dots" name="marks" type="hidden" value="" />
            <input type="hidden" name="image" value="/images/1.jpg">
            <div class="d-flex align-items-center gap-5">
                <input class="form-control form-control-solid" name="image" id="choose_image" type="file" required>
                <button type="button" id="remove_image" class="btn btn-sm btn-danger tw-w-[125px]">حذف تصویر</button>
            </div>
            <button class="btn btn-sm btn-success" type="submit">ذخیره</button>
        </form>
    </div>
    <div class="card-body">
        <div class="image_dotter">
            <img src="" alt="" id="imgmarker-preview">
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
                <form action="post">
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
@endsection

@section('scripts')
<script>
    document.getElementById('choose_image').addEventListener('change', function() {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imgmarker-preview').src = e.target.result;
        }
        reader.readAsDataURL(this.files[0]);
    });

    document.getElementById('remove_image').addEventListener('click', function() {
        document.getElementById('choose_image').value = '';
        document.getElementById('imgmarker-preview').src = '';
    });
</script>
@endsection