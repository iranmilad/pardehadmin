@extends('layouts.primary')

@section('title', 'ایجاد منو')

@section('content')
<form action="{{ route('menus.store') }}" method="post">
    @csrf
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h4>ایجاد منو</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label" for="menu_id">انتخاب منو مادر</label>
                    <select class="form-select form-select-solid" name="menu_id" id="menu_id">
                        <option value="">بدون والد</option>
                        @foreach($parentMenus as $parentMenu)
                            <option value="{{ $parentMenu->id }}">{{ $parentMenu->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="title">عنوان</label>
                    <input name="title" type="text" class="form-control form-control-solid" placeholder="عنوان را وارد کنید" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="link">لینک</label>
                    <input name="link" type="text" class="form-control form-control-solid" placeholder="لینک را وارد کنید">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="alias">نام مستعار</label>
                    <input name="alias" type="text" class="form-control form-control-solid" placeholder="نام مستعار را وارد کنید" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="icon">آیکون</label>
                    <x-file-input type="single" :preview="false" name="icon" />
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="show_title">نمایش عنوان</label>
                    <select class="form-select form-select-solid" name="show_title" id="show_title">
                        <option value="1">بله</option>
                        <option value="0">خیر</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-success mt-10" type="submit">ذخیره</button>
</form>
@endsection
