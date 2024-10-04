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
        <!-- مبدأ -->
        <div class="row form-group mb-7">
            <div class="col-md-2">
                <label class="form-label" for="">مبدا</label>
            </div>
            <div class="col-md-4">
                <textarea class="form-control form-control-solid" rows="4" placeholder="مبدا را وارد کنید"></textarea>
            </div>
        </div>

        <!-- مقصد -->
        <div class="row form-group mb-7">
            <div class="col-md-2">
                <label class="form-label" for="">مقصد</label>
            </div>
            <div class="col-md-4">
                <textarea class="form-control form-control-solid" rows="4" placeholder="مقصد را وارد کنید"></textarea>
            </div>
        </div>

        <!-- پرداخت از طرف -->
        <div class="row form-group mb-7">
            <div class="col-md-2">
                <label class="form-label" for="">پرداخت از طرف</label>
            </div>
            <div class="col-md-4">
                <select class="form-control form-control-solid" data-control="select2" data-hide-search="true">
                    <option value="">مبدا</option>
                    <option value="">مقصد</option>
                </select>
            </div>
        </div>

        <!-- زمان باقی مانده -->
        <div class="row form-group mb-7 tw-items-center">
            <div class="col-md-2">
                <label class="form-label" for="">زمان باقی مانده</label>
            </div>
            <div class="col-md-4">
                <span class="badge badge-primary">5 روز</span>
            </div>
        </div>

        <!-- شماره پیگیری -->
        <div class="row form-group mb-7">
            <div class="col-md-2">
                <label class="form-label" for="">شماره پیگیری</label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control form-control-solid" placeholder="شماره پیگیری را وارد کنید">
            </div>
        </div>

        <!-- تاریخ تحویل -->
        <div class="row form-group mb-7">
            <div class="col-md-2">
                <label class="form-label" for="">تاریخ تحویل</label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control form-control-solid date_time">
            </div>
        </div>

        <!-- وضعیت تحویل -->
        <div class="row form-group mb-7">
            <div class="col-md-2">
                <label class="form-label" for="">وضعیت تحویل</label>
            </div>
            <div class="col-md-4">
                <select class="form-control form-control-solid" data-control="select2" data-hide-search="true">
                    <option value="">در حال ارسال</option>
                    <option value="">تحویل داده شده</option>
                    <option value="">لغو شده</option>
                </select>
            </div>
        </div>

        <!-- اطلاعات گیرنده -->
        <h4 class="mt-7 mb-4">اطلاعات گیرنده</h4>

        <!-- نام کامل گیرنده -->
        <div class="row form-group mb-7">
            <div class="col-md-2">
                <label class="form-label" for="">نام کامل گیرنده</label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control form-control-solid" placeholder="نام کامل گیرنده را وارد کنید">
            </div>
        </div>

        <!-- کد پستی -->
        <div class="row form-group mb-7">
            <div class="col-md-2">
                <label class="form-label" for="">کد پستی</label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control form-control-solid" placeholder="کد پستی را وارد کنید">
            </div>
        </div>

        <!-- آدرس کامل -->
        <div class="row form-group mb-7">
            <div class="col-md-2">
                <label class="form-label" for="">آدرس کامل</label>
            </div>
            <div class="col-md-4">
                <textarea class="form-control form-control-solid" rows="4" placeholder="آدرس کامل را وارد کنید"></textarea>
            </div>
        </div>

        <!-- شماره تماس -->
        <div class="row form-group mb-7">
            <div class="col-md-2">
                <label class="form-label" for="">شماره تماس</label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control form-control-solid" placeholder="شماره تماس را وارد کنید">
            </div>
        </div>


        <div x-data="{ isChecked: false }">
            <div class="row form-group mb-7">
                <div class="col-md-2">
                    <label class="form-label" for="flexCheckDefault">پر کردن فرم</label>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input x-model="isChecked" class="form-check-input" type="checkbox" id="flexCheckDefault" />
                        <label class="form-check-label" for="flexCheckDefault">
                            فعال
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 offset-md-2">
                    <div x-show="isChecked">
                        <x-advanced-search type="form" label="فرم ها" name="user" solid />
                    </div>
                </div>
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
                <h4 class="card-title">یادداشت راننده</h4>
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
        enableTime: false,
        monthSelectorType: "static"
    });
</script>
@endsection