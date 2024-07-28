@extends('layouts.primary')

@section('title', 'ایجاد وضعیت جدید')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('sms.store') }}" method="post">
            @csrf
            <div class="form-group row mb-5">
                <label for="event" class="col-2 form-label">مورد استفاده در:</label>
                <div class="col-10">
                    <select name="event" id="event" class="form-select for-select-solid" data-control="select2">
                        <option value="order_completed">تکمیل سفارش</option>
                        <option value="order_in_progress">در حال انجام سفارش</option>
                        <option value="order_confirmed">تایید سفارش</option>
                        <option value="order_preparing">آماده سازی سفارش</option>
                        <option value="order_completed">تکمیل سفارش</option>
                        <option value="order_confirmation_code">کد تایید دریافت سفارش</option>
                        <option value="order_delivered">تحویل سفارش</option>
                        <option value="registration">ثبت نام</option>
                        <option value="review_submission">ثبت دیدگاه</option>
                        <option value="order_cancelled">لغو سفارش</option>
                        <option value="user_registration">ثبت نام کاربر</option>
                        <option value="password_change">تغییر رمزعبور کاربر</option>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="recipient" class="col-2 form-label">ارسال برای:</label>
                <div class="col-10">
                    <select name="recipient" id="recipient" class="form-select for-select-solid" data-control="select2">
                        <option value="customer">مشتری</option>
                        <option value="tailor">خیاط</option>
                        <option value="manager">مدیر</option>
                        <option value="supplier">تامین کننده</option>
                        <option value="auto_setting">تنظیم خودکار</option>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="provider" class="col-2 form-label">سیستم پیامک:</label>
                <div class="col-10">
                    <select name="provider" id="provider" class="form-select for-select-solid" data-control="select2">
                        <option value="ippanel">ippanel.com</option>
                        <option value="yektatech">yektatech</option>
                    </select>
                </div>
            </div>
            <h4 class="my-8">متن پیامک</h4>
            <div class="row mb-5">
                <div class="col-2">
                    <span>شورت کد های قابل استفاده</span>
                </div>
                <div class="col-10">
                    <button type="button" class="btn" data-bs-toggle="collapse" data-bs-target="#shortcodes" aria-expanded="false" aria-controls="shortcodes">برای مشاهده شورتکدهای قابل استفاده در متن پیامک ها کلیک کنید.</button>
                    <div class="collapse" id="shortcodes">
                        <div class="mb-6">
                            <b><i>جزئیات سفارش</i></b>
                            <div class="d-flex align-items-center flex-wrap gap-10 mt-3">
                                <div><code>{mobile}</code>=<span>شماره موبایل مشتری</span></div>
                                <div><code>{email}</code>=<span>ایمیل مشتری</span></div>
                                <div><code>{status}</code>=<span>وضعیت سفارش</span></div>
                            </div>
                        </div>
                        <div class="mb-6">
                            <b><i>جزئیات حمل و نقل:</i></b>
                            <div class="d-flex align-items-center flex-wrap gap-10 mt-3">
                                <div><code>{sh_first_name}</code>=<span>نام مشتری</span></div>
                                <div><code>{sh_last_name}</code>=<span>نام خانوادگی مشتری</span></div>
                                <div><code>{sh_country}</code>=<span>کشور</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="message" class="col-2 form-label">متن پیامک را وارد کنید:</label>
                <div class="col-10">
                    <textarea name="message" id="message" class="form-control" rows="5">سلام مدیر سفارش {order_id} ثبت شده است و هم اکنون در وضعیت در انتظار پرداخت می باشد. آیتم های سفارش : {all_items} . مبلغ سفارش : {price}</textarea>
                    <div class="form-text">میتوانید از شورت کد های معرفی شده در بالای این بخش استفاده نمایید.</div>
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-10">ذخیره</button>
        </form>
    </div>
</div>
@endsection
