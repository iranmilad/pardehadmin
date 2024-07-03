@extends('layouts.primary')

@section('title', 'ویرایش وضعیت سفارش')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="" method="post">
            <div class="form-group row mb-5">
                <label for="" class="col-2 form-label">ارسال پیامک به مدیران کل</label>
                <div class="col-10">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="">
                        <label class="form-check-label">
                            با فعالسازی این گزینه، در هنگام ثبت و یا تغییر سفارش، برای مدیران کل سایت پیامک ارسال می گردد.
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group mb-10">
                <label for="" class="form-label">شماره موبایل های مدیران کل</label>
                <div>
                    <div>
                        <input dir="ltr" type="text" class="form-control">
                        <div class="form-text">
                            شماره ها را با کاما (,) جدا نمایید.
                        </div>
                    </div>
                </div>
            </div>
            <h4 class="my-8">متن پیامک مدیر کل</h4>
            <div class="row mb-5">
                <div class="col-2">
                    <span>شورت کد های قابل استفاده</span>
                </div>
                <div class="col-10">
                    <button type="button" class="btn" data-bs-toggle="collapse" data-bs-target="#shortcodes">برای مشاهده شورتکدهای قابل استفاده در متن پیامک ها کلیک کنید.</button>
                    <div class="collapse" id="shortcodes">
                        <div class="mb-6">
                            <b><i>جزئیات سفارش</i></b>
                            <div class="d-flex align-items-center flex-wrap gap-10 mt-3">
                                <div>
                                    <code>{mobile}</code>=
                                    <span>شماره موبایل مشتری</span>
                                </div>
                                <div>
                                    <code>{email}</code>=
                                    <span>ایمیل مشتری</span>
                                </div>
                                <div>
                                    <code>{status}</code>=
                                    <span>وضعیت سفارش</span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-6">
                            <b><i>جزییات حمل و نقل :</i></b>
                            <div class="d-flex align-items-center flex-wrap gap-10 mt-3">
                                <div>
                                    <code>{sh_first_name}</code>=
                                    <span>نام مشتری</span>
                                </div>
                                <div>
                                    <code>{sh_last_name}</code>=
                                    <span>نام خانوادگی مشتری</span>
                                </div>
                                <div>
                                    <code>{sh_country}</code>=
                                    <span>کشور</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row mb-5">
                <label for="" class="col-2 form-label">وضعیت در انتظار پرداخت (بلافاصله بعد از ثبت سفارش)</label>
                <div class="col-10">
                    <div>
                        <textarea name="" id="" class="form-control" rows="5">سلام مدیر سفارش {order_id} ثبت شده است و هم اکنون در وضعیت در انتظار پرداخت می باشد. آیتم های سفارش : {all_items} . مبلغ سفارش : {price}
                                </textarea>
                        <div class="form-text">
                            میتوانید از شورت کد های معرفی شده در بالای این بخش استفاده نمایید.
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection