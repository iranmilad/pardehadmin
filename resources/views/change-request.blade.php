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
                <label for="title" class="col-2 form-label fw-bold">عنوان:</label>
                <div class="col-10">
                    <span>ویرایش محصول #123</span>
                </div>
            </div>

            <div class="form-group row mb-5">
                <label for="previous_price" class="col-2 form-label fw-bold">قیمت قبلی:</label>
                <div class="col-10">
                    <span>500,000 تومان</span>
                </div>
            </div>

            <div class="form-group row mb-5">
                <label for="new_price" class="col-2 form-label fw-bold">قیمت جدید:</label>
                <div class="col-10">
                    <span>450,000 تومان</span>
                </div>
            </div>

            <div class="form-group row mb-5">
                <label for="discount" class="col-2 form-label fw-bold">تخفیف:</label>
                <div class="col-10">
                    <span>10%</span>
                </div>
            </div>

            <div class="form-group row mb-5">
                <label for="description" class="col-2 form-label fw-bold">توضیحات:</label>
                <div class="col-10">
                    <span>توضیحات مربوط به ویرایش این محصول.</span>
                </div>
            </div>

            <div class="form-group row mb-5">
                <label for="category" class="col-2 form-label fw-bold">دسته‌بندی:</label>
                <div class="col-10">
                    <span>موکت</span>
                </div>
            </div>

            <div class="form-group row mb-5">
                <label for="status" class="col-2 form-label fw-bold">وضعیت:</label>
                <div class="col-10">
                    <span>فعال</span>
                </div>
            </div>

            <div class="form-group row mb-5">
                <label for="quantity" class="col-2 form-label fw-bold">موجودی:</label>
                <div class="col-10">
                    <span>50 عدد</span>
                </div>
            </div>

            <div class="form-group row mb-5">
                <label for="date_created" class="col-2 form-label fw-bold">تاریخ ایجاد:</label>
                <div class="col-10">
                    <span>1402/05/01</span>
                </div>
            </div>

            <div class="form-group row mb-5">
                <label for="last_updated" class="col-2 form-label fw-bold">آخرین بروزرسانی:</label>
                <div class="col-10">
                    <span>1402/05/10</span>
                </div>
            </div>

            <div class="form-group row mb-5">
                <label for="note" class="col-2 form-label fw-bold">یادداشت‌ها:</label>
                <div class="col-10">
                    <span>یادداشت‌های اضافی برای این درخواست.</span>
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-success mt-10" type="submit">تایید</button>
    <button class="btn btn-danger mt-10" type="button" data-bs-toggle="modal" data-bs-target="#rejectModal">رد کردن</button>
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
