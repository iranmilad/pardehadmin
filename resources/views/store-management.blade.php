@extends('layouts.primary')

@section('title', 'مدیریت انبار')


@section('content')
<form action="">
    @csrf
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">اطلاعات انبار محصول</h4>
        </div>
        <div class="card-body">
            <div class="form-group row mb-10">
                <label for="title" class="col-12 col-lg-2 form-label fw-bold">عنوان:</label>
                <div class="col-12 col-lg-8">
                    <a href="{{route('products.edit',['id' => 1])}}">پرده مخمل</a>
                </div>
            </div>

            <div class="form-group row mb-10">
                <label for="previous_price" class="col-12 col-lg-2 form-label fw-bold">کد محصول:</label>
                <div class="col-12 col-lg-8">
                    <span>#1234</span>
                </div>
            </div>

            <div class="form-group row mb-10">
                <label for="new_price" class="col-12 col-lg-2 form-label fw-bold">تعداد موجودی:</label>
                <div class="col-12 col-lg-8">
                    <input class="form-control form-control-solid" type="number" placeholder="تعداد موجودی را وارد کنید" />
                </div>
            </div>

            <div class="form-group row mb-10">
                <label for="new_price" class="col-12 col-lg-2 form-label fw-bold">وضعیت:</label>
                <div class="col-12 col-lg-8">
                    <select class="form-select form-select-solid" data-placeholder="انتخاب وضعیت" data-control="select2" name="" id="" data-hide-search="true">
                        <option value="1">موجود</option>
                        <option value="2">موجودی کم</option>
                        <option value="3">ناموجود</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-success mt-10" type="submit">ذخیره</button>
</form>
@endsection
