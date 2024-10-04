@extends('layouts.primary')

@if(Route::is('form.edit.show'))
@section('title', 'ویرایش فرم')
@else
@section('title', 'ایجاد فرم')
@endif

@section('content')
<div>
    <form action="" class="mb-5">
        @csrf
        <div class="d-flex tw-gap-10">
            <input class="form-control" placeholder="نام فرم را وارد کنید" />
            <button class="btn btn-success" type="button">ذخیره</button>
        </div>

        <!-- برای حالت ویرایش جیسون را اینجا قرار بدید -->
        <!-- برای حالت ویرایش جیسون را اینجا قرار بدید -->
        <!-- برای حالت ویرایش جیسون را اینجا قرار بدید -->
        <!-- برای حالت ویرایش جیسون را اینجا قرار بدید -->
        <input type="hidden" name="elements" id="form-elements" value="">
    </form>
    <div class="row">
        <!-- Sidebar 2-column layout for form items -->
        <div class="tw-w-full lg:tw-min-w-96 lg:tw-max-w-96">
            <div class="form-items-container">
                <!-- Form Item Box: Input -->
                <div class="form-item" data-type="input" draggable="true" title="input">
                    <i class="fas fa-i-cursor"></i>
                    <div class="form-item-text">متن تک خطی</div>
                </div>

                <!-- Form Item Box: Checkbox -->
                <div class="form-item" data-type="checkbox" draggable="true" title="checkbox">
                    <i class="fas fa-check-square"></i>
                    <div class="form-item-text">چک باکس</div>
                </div>

                <!-- Form Item Box: Radio -->
                <div class="form-item" data-type="radio" draggable="true" title="radio">
                    <i class="fas fa-dot-circle"></i>
                    <div class="form-item-text">دکمه رادیویی</div>
                </div>

                <!-- Form Item Box: Select -->
                <div class="form-item" data-type="select" draggable="true" title="select">
                    <i class="fas fa-list"></i>
                    <div class="form-item-text">کشویی</div>
                </div>

                <!-- Form Item Box: Textarea -->
                <div class="form-item" data-type="textarea" draggable="true" title="textarea">
                    <i class="fas fa-align-left"></i>
                    <div class="form-item-text">متن چند خطی</div>
                </div>

                <!-- Form Item Box: Number -->
                <div class="form-item" data-type="number" draggable="true" title="number">
                    <i class="fas fa-hashtag"></i>
                    <div class="form-item-text">عدد</div>
                </div>
                <!-- Form Item Box: File Upload -->
                <div class="form-item" data-type="file-upload" draggable="true" title="upload">
                    <i class="fas fa-upload"></i>
                    <div class="form-item-text">آپلود فایل</div>
                </div>

                <!-- Form Item Box: Image -->
                <div class="form-item" data-type="image" draggable="true" title="img">
                    <i class="fas fa-image"></i>
                    <div class="form-item-text">تصویر</div>
                </div>

                <!-- Form Item Box: Text -->
                <div class="form-item" data-type="text" draggable="true" title="heading">
                    <i class="fas fa-font"></i>
                    <div class="form-item-text">متن</div>
                </div>
            </div>

        </div>
        <!-- Main 10-column layout for form preview -->
        <div class="tw-w-full tw-min-w-[calc(100%-24rem)] tw-max-w-[calc(100%-24rem)]">
            <div class="grid-stack" dir="rtl">
            </div>
        </div>
    </div>
</div>

<!-- Modal HTML -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">ویرایش فیلد</h5>
                <button type="button" id="close-form-element" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalBody">
                <input type="hidden" id="editingItemId">
                <div class="mb-3">
                    <label for="modalTitle" class="form-label">Title</label>
                    <input type="text" class="form-control" id="modalTitle" placeholder="Enter title">
                </div>
                <div class="mb-3">
                    <label for="modalValue" class="form-label">Value</label>
                    <input type="text" class="form-control" id="modalValue" placeholder="Enter value">
                </div>
                <div class="mb-3">
                    <label for="modalPlaceholder" class="form-label">Placeholder</label>
                    <input type="text" class="form-control" id="modalPlaceholder" placeholder="Enter placeholder">
                </div>
            </div>
            <div class="modal-footer d-flex align-items-center justify-content-between">
                <div>
                    <button type="button" class="btn btn-primary" onclick="saveChanges()">ذخیره</button>
                </div>
                <button class="btn btn-danger">حذف</button>
            </div>
        </div>
    </div>
</div>

@endsection