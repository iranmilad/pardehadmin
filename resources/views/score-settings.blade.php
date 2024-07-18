@extends('layouts.primary')

@section('title', 'تنظیمات امتیاز دهی')

@section('content')
<form action="">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="form-group row mb-5">
                <label for="" class="col-2 form-label">نمره مثبت پرداخت : </label>
                <div class="col-10">
                    <div class="form-check">
                        <input type="number" class="form-control form-control-solid">
                    </div>
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="" class="col-2 form-label">به موقع پرداخت کردن : </label>
                <div class="col-10">
                    <div class="form-check">
                        <input type="number" class="form-control form-control-solid">
                    </div>
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="" class="col-2 form-label">نمره فروش : </label>
                <div class="col-10">
                    <div class="form-check">
                        <input type="number" class="form-control form-control-solid">
                    </div>
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="" class="col-2 form-label">تاخیر پرداخت : </label>
                <div class="col-10">
                    <div class="form-check">
                        <input type="number" class="form-control form-control-solid">
                        <span class="text-muted">نمره منفی</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success mt-10">ذخیره</button>
</form>
@endsection