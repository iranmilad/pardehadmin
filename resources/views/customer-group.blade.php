@extends('layouts.primary')

@if(Route::is('customers-group.edit.show'))
@section('title', 'ویرایش گروه')
@else
@section('title', 'ایجاد گروه')
@endif


@section('content')
<form action="">
    @csrf
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">جزئیات گروه</h4>
        </div>
        <div class="card-body">
            <div class="form-group row mb-5 align-items-center">
                <label for="" class="col-2 form-label">عنوان گروه</label>
                <div class="col-10">
                    <input type="text" class="form-control form-control-solid" placeholder="نام را وارد کنید" name="title">
                </div>
            </div>
            <div class="form-group row align-items-center">
                <label for="" class="col-2 form-label">توضیحات گروه</label>
                <div class="col-10">
                    <textarea class="form-control form-control-solid" rows="6" placeholder="توضیحات را وارد کنید" name="description" id=""></textarea>
                </div>
            </div>
                <div class="form-group row mb-5 align-items-center">
                    <label for="" class="col-2 form-label">انتخاب کاربران</label>
                    <div class="col-10">
                        <x-advanced-search type="user" label="" name="user" solid multiple />
                    </div>
                </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success mt-10">ذخیره</button>
</form>
@endsection