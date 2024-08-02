@extends('layouts.primary')

@if(Route::is('task.edit.show'))
@section('title', 'جزئیات کار')
@else
@section('title', 'ایجاد کار')
@endif

@section('content')
<div class="alert alert-success" role="alert">
    <div>بعد از اتمام کار برو رو دکمه ی پایان کار کلیک کنید</div>
    <button class="btn btn-sm btn-success mt-3">پایان کار</button>
</div>
<div class="alert alert-warning" role="alert">
    <div>کار شما شروع نشده است . بر روی دکمه ی شروع کار کلیک کنید</div>
    <button class="btn btn-sm btn-warning mt-3">شروع کار</button>
</div>
<div class="alert alert-danger" role="alert">
    <div>برای اتمام پروژه کلیک کنید</div>
    <button class="btn btn-sm btn-danger mt-3">درخواست اتمام کار</button>
</div>
<div class="alert alert-info" role="alert">
    منتظر تایید ادمین باشید . بعد از تایید فرآیند تحویل کالا را با تایید کد انجام دهید
</div>
<div class="alert alert-success" role="alert">
    <div>کار شما تایید شده و باید به کاربر <b>فرهاد باقری </b>تحویل دهید</div>
    <form method="post" class="mt-3">
        @csrf
        <div class="row g-5">
            <div class="col-12">
                <label class="form-label" for="">کد تایید sms شده را وارد کنید</label>
                <input type="text" class="form-control" placeholder="کد تایید">
            </div>
            <div class="col-12">
                <label class="form-label" for="">یادداشت ( اختیاری )</label>
                <textarea class="form-control" name="" id="" placeholder="متن یادداشت را وارد کنید کنید"></textarea>
            </div>
        </div>
        <button class="btn btn-success mt-5">تایید</button>
    </form>
</div>
<div class="card mb-10">
    <div class="card-header">
        <div class="tw-w-full tw-flex tw-items-center tw-justify-between">
            <h4>جزئیات کار</h4>
            <button class="btn btn-sm btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#reportModal">اعلام گزارش</button>
        </div>
    </div>
    <div class="card-body">
        <div class="row form-group mb-7">
            <div class="col-md-2">
                <label class="form-label" for="">عنوان کار</label>
            </div>
            <div class="col-md-4">
                <span class="form-label">دوخت</span>
            </div>
        </div>
        <div class="row form-group mb-7">
            <div class="col-md-2">
                <label class="form-label" for="">سفارش</label>
            </div>
            <div class="col-md-4">
                <a class="form-label text-primary" href="{{route('orders.edit',['id' => 1])}}">#123</a>
            </div>
        </div>
        <div class="row form-group mb-7 tw-items-center">
            <div class="col-md-2">
                <label class="form-label" for="">انجام دهنده</label>
            </div>
            <div class="col-md-4">
                <a class="form-label text-primary" href="{{route('users.profile',['id' => 1])}}">فرهاد باقری - 09374039436</a>
            </div>
        </div>
        <div class="row form-group mb-7">
            <div class="col-md-2">
                <label class="form-label" for="">وضعیت</label>
            </div>
            <div class="col-md-4">
                <span class="badge badge-info">در حال انجام</span>
                <span class="badge badge-success">انجام شده</span>
                <span class="badge badge-secondary">شروع نشده</span>
            </div>
        </div>
        <div class="row form-group mb-7 tw-items-center">
            <div class="col-md-2">
                <label class="form-label" for="">زمان باقی مانده</label>
            </div>
            <div class="col-md-4">
                <span class="badge badge-primary">5 روز</span>
            </div>
        </div>
    </div>
</div>

<h3>یادداشت ها</h3>
<div class="row mb-10">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">یادداشت ادمین</h4>
            </div>
            <div class="card-body">
                <form method="post">
                    @csrf
                    <textarea name="" id="" class="form-control mb-5" rows="5" placeholder="یادداشت را وارد کنید"></textarea>
                    <button class="btn btn-success" type="submit">ذخیره</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">یادداشت انجام دهنده</h4>
            </div>
            <div class="card-body">
                <form method="post">
                    @csrf
                    <textarea name="" id="" class="form-control mb-5" rows="5" placeholder="یادداشت را وارد کنید"></textarea>
                    <button class="btn btn-success" type="submit">ذخیره</button>
                </form>
            </div>
        </div>
    </div>
</div>

<h3>محصولات</h3>
<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="tw-flex tw-items-center tw-justify-between tw-flex-wrap tw-gap-4">
                    <a href="https://javidcode.com/product/25" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">
                        <img class="tw-size-16 tw-rounded-md" src="/images/1.jpg" alt="">
                        <span class="ms-2">پرده رنگی</span>
                    </a>
                    <a href="https://javidcode.com/product/25">مشاهده محصول</a>
                </div>
                <div class="row mt-4">
                    <div class="col-6 col-md-4 col-lg-3 labely">
                        <b>تعداد: </b>
                        <label for="">2</label>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 labely">
                        <b>طول: </b>
                        <label for="">5 متر</label>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 labely">
                        <b>عرض: </b>
                        <label for="">10 متر</label>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 labely">
                        <b>رنگ: </b>
                        <label for="">مشکی</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="tw-flex tw-items-center tw-justify-between tw-flex-wrap tw-gap-4">
                    <a href="https://javidcode.com/product/25" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">
                        <img class="tw-size-16 tw-rounded-md" src="/images/1.jpg" alt="">
                        <span class="ms-2">پرده رنگی</span>
                    </a>
                    <a href="https://javidcode.com/product/25">مشاهده محصول</a>
                </div>
                <div class="row mt-4">
                    <div class="col-6 col-md-4 col-lg-3 labely">
                        <b>تعداد: </b>
                        <label for="">2</label>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 labely">
                        <b>طول: </b>
                        <label for="">5 متر</label>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 labely">
                        <b>عرض: </b>
                        <label for="">10 متر</label>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 labely">
                        <b>رنگ: </b>
                        <label for="">مشکی</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-focus="false">
    <div class="modal-dialog">
        <form class="modal-content">
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">اعلام گزارش</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label class="form-label" for="">متن گزارش</label>
                <textarea name="report" rows="5" class="form-control form-control-solid" placeholder="متن گزارش را وارد کنید"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                <button type="submit" class="btn btn-primary">ارسال</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script-before')
<script src="../js/ckeditor/bundle.js"></script>
@endsection
