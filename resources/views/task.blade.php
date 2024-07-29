@extends('layouts.primary')

@if(Route::is('transport.edit.show'))
@section('title', 'ویرایش کار')
@else
@section('title', 'ایجاد کار')
@endif

@section('content')
<div class="card">
    <div class="card-header">
        <div class="tw-w-full tw-flex tw-items-center tw-justify-between">
            <h4>جزئیات کار</h4>
            <button class="btn btn-sm btn-danger" type="submit" name="remove_task" value="">حذف کار</button>
        </div>
    </div>
    <div class="card-body">
        <div class="row form-group mb-1">
            <div class="col-md-2">
                <label class="form-label" for="">عنوان کار</label>
            </div>
            <div class="col-md-4">
                <select class="form-select form-select-solid" name="" id="" disabled data-control="select2">
                    <option value="1">دوخت</option>
                    <option value="2">نصب</option>
                    <option value="3">طراحی طرح</option>
                </select>
            </div>
        </div>
        <div class="row form-group mb-5 tw-items-center">
            <div class="col-md-2">
                <label class="form-label" for="">انجام دهنده</label>
            </div>
            <div class="col-md-4">
                <x-advanced-search type="users" label="" name="user" solid />
            </div>
        </div>
        <div class="row form-group mb-5">
            <div class="col-md-2">
                <label class="form-label" for="">وضعیت</label>
            </div>
            <div class="col-md-4">
                <select class="form-select form-select-solid" name="" id="" data-control="select2">
                    <option value="1">بدون وضعیت</option>
                    <option value="2">درحال انجام</option>
                    <option value="3">انجام شده</option>
                </select>
            </div>
        </div>
    </div>
</div>
<h4 class="card-title mb-5">روند کار</h4>
<div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                خیاطی
            </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">

        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                حمل و نقل
            </button>
        </h2>
        <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                نصب
            </button>
        </h2>
        <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
        </div>
    </div>
</div>

@endsection

@section('script-before')
<script src="../js/ckeditor/bundle.js"></script>
@endsection