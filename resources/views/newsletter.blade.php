<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')

@section('title', 'خبرنامه')


@section('content')
<form action="">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">تنظیمات میل چیمپ</h4>
        </div>
        <div class="card-body">
            <div class="row form-group mb-7">
                <div class="col-md-2">
                    <label class="form-label" for="">کلید api</label>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="کلید api را وارد کنید" name="api_key">
                </div>
            </div>
            <div class="row form-group mb-7">
                <div class="col-md-2">
                    <label for="" class="form-label">متن پیام موفقیت آمیز بودن</label>
                </div>
                <div class="col-md-4">
                    <textarea class="form-control" rows="5" placeholder="متن را وارد کنید"></textarea>
                </div>
            </div>
            <div class="row form-group mb-7">
                <div class="col-md-2">
                    <label for="" class="form-label">متن پیام خطا</label>
                </div>
                <div class="col-md-4">
                    <textarea class="form-control" rows="5" placeholder="متن را وارد کنید"></textarea>
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-success mt-10">ذخیره</button>
</form>
@endsection