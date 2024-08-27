@extends('layouts.primary')

@section('title', 'جزئیات درخواست')

@section('content')
<form action="/requests/update" method="POST">
    @csrf
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">جزئیات درخواست شده</h4>
        </div>
        <div class="card-body">
            <div class="form-group row mb-5">
                <label for="title" class="col-2 form-label fw-bold">انتخاب محصول:</label>
                <div class="col-10">
                    <x-advanced-search type="product" label="" name="product" solid />
                </div>
            </div>

            <div class="form-group row mb-5">
                <label for="previous_price" class="col-2 form-label fw-bold">قیمت قبلی:</label>
                <div class="col-10">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-solid">
                        <span class="input-group-text bg-dark text-white" id="basic-addon2">تومان</span>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-5">
                <label for="new_price" class="col-2 form-label fw-bold">قیمت جدید:</label>
                <div class="col-10">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-solid">
                        <span class="input-group-text bg-dark text-white" id="basic-addon2">تومان</span>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-5">
                <label for="quantity" class="col-2 form-label fw-bold">موجودی:</label>
                <div class="col-10">
                    <input class="form-control form-control-solid" type="number" />
                </div>
            </div>

            <div class="form-group row mb-5">
                <label for="description" class="col-2 form-label fw-bold">توضیحات اضافه:</label>
                <div class="col-10">
                    <textarea class="form-control form-control-solid" rows="7"></textarea>
                </div>
            </div>

        </div>
    </div>
    <button class="btn btn-success mt-10" type="submit">ارسال</button>
</form>

<!-- Modal -->
<div class="modal fade" id="rejectModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content">
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">رد کردن تغییرات درخواست شده</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    آیا از رد کردن تغییرات درخواست شده مطعمن هستید ؟
                    <div>* این عملیات غیر قابل برگشت است.</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                <button type="submit" name="reject" value="1" class="btn btn-danger">ثبت</button>
            </div>
        </form>
    </div>
</div>
@endsection