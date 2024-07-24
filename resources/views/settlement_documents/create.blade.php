<!-- resources/views/settlement_documents/create.blade.php و edit.blade.php -->
@extends('layouts.primary')

@section('title', isset($settlementDocument) ? 'ویرایش سند تسویه حساب' : 'ایجاد سند تسویه حساب')

@section('content')
<form action="{{ isset($settlementDocument) ? route('settlement_documents.update', $settlementDocument->id) : route('settlement_documents.store') }}" method="POST">
    @csrf
    @if(isset($settlementDocument))
        @method('PUT')
    @endif
    <div class="card">
        <div class="card-body">
            <div class="form-group row mb-5 align-items-center">
                <label for="order_id" class="col-2 form-label">سفارش</label>
                <div class="col-10">
                    <div class="col-10">
                        <x-advanced-search type="order" label="" name="order_id" solid />
                    </div>
                </div>
            </div>

            <div class="form-group row mb-5 align-items-center">
                <label for="user_id" class="col-2 form-label">درخواست کننده</label>
                <div class="col-10">
                    <div class="col-10">
                        <x-advanced-search type="user" label="" name="user_id" solid />
                    </div>
                </div>
            </div>

            <div class="form-group row mb-5 align-items-center">
                <label for="status" class="col-2 form-label">وضعیت</label>
                <div class="col-10">
                    <select name="status" id="status" class="form-select form-select-solid" data-control="select2">
                        <option value="completed" {{ isset($settlementDocument) && $settlementDocument->status == 'completed' ? 'selected' : '' }}>تکمیل شده</option>
                        <option value="in_progress" {{ isset($settlementDocument) && $settlementDocument->status == 'in_progress' ? 'selected' : '' }}>در حال انجام</option>
                        <option value="canceled" {{ isset($settlementDocument) && $settlementDocument->status == 'canceled' ? 'selected' : '' }}>لغو شده</option>
                        <option value="pending" {{ isset($settlementDocument) && $settlementDocument->status == 'pending' ? 'selected' : '' }}>در انتظار بررسی</option>
                    </select>
                </div>
            </div>

            <div class="form-group row mb-5 align-items-center">
                <label for="document_type" class="col-2 form-label">نوع سند</label>
                <div class="col-10">
                    <select name="document_type" id="document_type" class="form-select form-select-solid" data-control="select2">
                        <option value="debit" {{ isset($settlementDocument) && $settlementDocument->document_type == 'debit' ? 'selected' : '' }}>بدهکار</option>
                        <option value="credit" {{ isset($settlementDocument) && $settlementDocument->document_type == 'credit' ? 'selected' : '' }}>بستانکار</option>
                    </select>
                </div>
            </div>

            <div class="form-group row mb-5 align-items-center">
                <label for="service_total" class="col-2 form-label">مجموع خدمت</label>
                <div class="col-10">
                    <div class="input-group ">
                        <input type="text" name="service_total" id="service_total" class="form-control form-control-solid" placeholder="مجموع خدمت را وارد کنید" value="{{ isset($settlementDocument) ? $settlementDocument->service_total : '' }}">
                        <span class="btn btn-secondary" id="basic-addon1">تومان</span>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-5 align-items-center">
                <label for="site_commission" class="col-2 form-label">کمیسیون سایت</label>
                <div class="col-10">
                    <div class="input-group ">
                        <input type="text" name="site_commission" id="site_commission" class="form-control form-control-solid" placeholder="کمیسیون سایت را وارد کنید" value="{{ isset($settlementDocument) ? $settlementDocument->site_commission : '' }}">
                        <span class="btn btn-secondary" id="basic-addon1">تومان</span>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-5 align-items-center">
                <label for="account_number" class="col-2 form-label">شماره حساب/شبا</label>
                <div class="col-10">
                    <div class="input-group ">
                        <input type="text" name="account_number" id="account_number" class="form-control form-control-solid" placeholder="شماره حساب یا شبا جهت تسویه را وارد کنید" value="{{ isset($settlementDocument) ? $settlementDocument->account_number : '' }}">
                    </div>
                </div>
            </div>

            <div class="form-group row mb-5 align-items-center">
                <label for="transaction_number" class="col-2 form-label">شماره تراکنش</label>
                <div class="col-10">
                    <div class="input-group ">
                        <input type="text" name="transaction_number" id="transaction_number" class="form-control form-control-solid" placeholder="شماره تراکنش را وارد کنید" value="{{ isset($settlementDocument) ? $settlementDocument->transaction_number : '' }}">
                    </div>
                </div>
            </div>

            <div class="form-group row mb-5 align-items-center">
                <label for="transaction_date" class="col-2 form-label">تاریخ تسویه</label>
                <div class="col-10">
                    <div class="input-group ">
                        <input type="text" name="transaction_date" id="transaction_date" class="form-control form-control-solid date_time" placeholder="تاریخ تسویه را وارد کنید" value="{{ isset($settlementDocument) ? $settlementDocument->transaction_date : '' }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-success mt-10">ذخیره</button>
</form>
@endsection

@section("script-before")
<script src="{{asset('plugins/flatpicker_fa.js')}}"></script>
<script src="{{asset('plugins/jdate.min.js')}}"></script>
@endsection

@section("scripts")
<script>
    window.Date = window.JDate;
    flatpickr = $(".date_time").flatpickr({
        disableMobile: "true",
        altInput: true,
        altFormat: "Y-m-d",
        dateFormat: "Y-m-d",
        locale: "fa",
    });
</script>
@endsection
