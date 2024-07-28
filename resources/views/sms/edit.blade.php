@extends('layouts.primary')

@section('title', 'ویرایش وضعیت')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('sms.update', $sms->id) }}" method="post">
            @csrf
            @method('PUT') <!-- یا @method('PATCH') -->

            <div class="form-group row mb-5">
                <label for="event" class="col-2 form-label">مورد استفاده در:</label>
                <div class="col-10">
                    <select name="event" id="event" class="form-select for-select-solid" data-control="select2">
                        <option value="order_completed" {{ $sms->event == 'order_completed' ? 'selected' : '' }}>تکمیل سفارش</option>
                        <option value="order_in_progress" {{ $sms->event == 'order_in_progress' ? 'selected' : '' }}>در حال انجام سفارش</option>
                        <option value="order_confirmed" {{ $sms->event == 'order_confirmed' ? 'selected' : '' }}>تایید سفارش</option>
                        <option value="order_preparing" {{ $sms->event == 'order_preparing' ? 'selected' : '' }}>آماده سازی سفارش</option>
                        <option value="order_confirmation_code" {{ $sms->event == 'order_confirmation_code' ? 'selected' : '' }}>کد تایید دریافت سفارش</option>
                        <option value="order_delivered" {{ $sms->event == 'order_delivered' ? 'selected' : '' }}>تحویل سفارش</option>
                        <option value="registration" {{ $sms->event == 'registration' ? 'selected' : '' }}>ثبت نام</option>
                        <option value="review_submission" {{ $sms->event == 'review_submission' ? 'selected' : '' }}>ثبت دیدگاه</option>
                        <option value="order_cancelled" {{ $sms->event == 'order_cancelled' ? 'selected' : '' }}>لغو سفارش</option>
                        <option value="user_registration" {{ $sms->event == 'user_registration' ? 'selected' : '' }}>ثبت نام کاربر</option>
                        <option value="password_change" {{ $sms->event == 'password_change' ? 'selected' : '' }}>تغییر رمزعبور کاربر</option>
                    </select>
                </div>
            </div>

            <div class="form-group row mb-5">
                <label for="recipient" class="col-2 form-label">ارسال برای:</label>
                <div class="col-10">
                    <select name="recipient" id="recipient" class="form-select for-select-solid" data-control="select2">
                        <option value="customer" {{ $sms->recipient == 'customer' ? 'selected' : '' }}>مشتری</option>
                        <option value="tailor" {{ $sms->recipient == 'tailor' ? 'selected' : '' }}>خیاط</option>
                        <option value="manager" {{ $sms->recipient == 'manager' ? 'selected' : '' }}>مدیر</option>
                        <option value="supplier" {{ $sms->recipient == 'supplier' ? 'selected' : '' }}>تامین کننده</option>
                        <option value="auto_setting" {{ $sms->recipient == 'auto_setting' ? 'selected' : '' }}>تنظیم خودکار</option>
                    </select>
                </div>
            </div>

            <div class="form-group row mb-5">
                <label for="provider" class="col-2 form-label">سیستم پیامک:</label>
                <div class="col-10">
                    <select name="provider" id="provider" class="form-select for-select-solid" data-control="select2">
                        <option value="ippanel" {{ $sms->provider == 'ippanel' ? 'selected' : '' }}>ippanel.com</option>
                        <option value="yektatech" {{ $sms->provider == 'yektatech' ? 'selected' : '' }}>yektatech</option>
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
                    <textarea name="message" id="message" class="form-control" rows="5">{{ $sms->message }}</textarea>
                    <div class="form-text">میتوانید از شورت کد های معرفی شده در بالای این بخش استفاده نمایید.</div>
                </div>
            </div>

            <button type="submit" class="btn btn-success mt-10">ذخیره</button>
        </form>
    </div>
</div>
@endsection
