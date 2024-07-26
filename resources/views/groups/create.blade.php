@extends('layouts.primary')

@if(Route::is('groups.edit'))
@section('name', 'ویرایش گروه')
@else
@section('name', 'ایجاد گروه')
@endif

@section('content')
<form action="{{ Route::is('groups.edit') ? route('groups.update', ['id' => $group->id]) : route('groups.store') }}" method="POST">
    @csrf
    @if(Route::is('groups.edit'))
        @method('PUT')
    @endif
    <div class="card">
        <div class="card-header">
            <h4 class="card-name">جزئیات گروه</h4>
        </div>
        <div class="card-body">
            <div class="form-group row mb-5 align-items-center">
                <label for="name" class="col-2 form-label">عنوان گروه</label>
                <div class="col-10">
                    <input type="text" class="form-control form-control-solid" placeholder="نام را وارد کنید" name="name" value="">
                </div>
            </div>
            <div class="form-group row align-items-center">
                <label for="description" class="col-2 form-label">توضیحات گروه</label>
                <div class="col-10">
                    <textarea class="form-control form-control-solid" rows="6" placeholder="توضیحات را وارد کنید" name="description"></textarea>
                </div>
            </div>
            <div class="form-group row mb-5 align-items-center">
                <label for="users" class="col-2 form-label">انتخاب کاربران</label>
                <div class="col-10">
                    <x-advanced-search type="user" label="" name="users[]" solid :multiple="true" />
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success mt-10">ذخیره</button>
</form>
@endsection

@section('script-before')
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
@endsection
