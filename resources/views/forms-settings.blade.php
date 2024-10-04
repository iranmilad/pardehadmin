@extends('layouts.primary')

@if(Route::is('form.edit.show'))
    @section('title', 'تنظیمات فرم ها')
@endif

@section('content')
<form action="">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="mb-5">
                <label for="" class="form-label">کد کپچا</label>
                <input type="text" class="form-control" placeholder="وارد کنید" dir="ltr">
            </div>
            <div class="mb-5">
                <label for="" class="form-label">متن پیام موفقیت آمیز بودن</label>
                <textarea class="form-control" rows="5" placeholder="متن را وارد کنید"></textarea>
            </div>
            <div class="mb-5">
                <label for="" class="form-label">متن پیام خطا</label>
                <textarea class="form-control" rows="5" placeholder="متن را وارد کنید"></textarea>
            </div>
        </div>
    </div>
    <button class="mt-10 btn btn-success">ذخیره</button>
</form>
@endsection