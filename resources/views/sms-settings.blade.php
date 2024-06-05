@extends('layouts.primary')

@section('title', 'پیامک')

@section('content')
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-webservice-tab" data-bs-toggle="pill" data-bs-target="#pills-webservice" type="button" role="tab" aria-controls="pills-webservice" aria-selected="true">وبسرویس</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-manager-sms-tab" data-bs-toggle="pill" data-bs-target="#pills-manager-sms" type="button" role="tab" aria-controls="pills-manager-sms" aria-selected="false">پیامک مدیر کل</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-customer-sms-tab" data-bs-toggle="pill" data-bs-target="#pills-customer-sms" type="button" role="tab" aria-controls="pills-customer-sms" aria-selected="false">پیامک مشتری</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-tailor-sms-tab" data-bs-toggle="pill" data-bs-target="#pills-tailor-sms" type="button" role="tab" aria-controls="pills-tailor-sms" aria-selected="false">پیامک خیاط</button>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-webservice" role="tabpanel" aria-labelledby="pills-webservice-tab">
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group mb-5">
                        <label for="" class="form-label">وبسرویس پیامک</label>
                        <div>
                            <select dir="ltr" data-control="select2" name="service" id="" class="form-select">
                                <option value="1">ippanel.com</option>
                                <option value="2">yektatech.net</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <label for="" class="form-label">نام کاربری سرویس</label>
                        <div>
                            <input dir="ltr" type="text" class="form-control" name="username">
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <label for="" class="form-label">کلمه عبور وبسرویس</label>
                        <div>
                            <input dir="ltr" type="text" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <label for="" class="form-label">شماره ارسال کننده پیامک</label>
                        <div>
                            <input dir="ltr" type="text" class="form-control" name="sender_phone">
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <label for="" class="form-label">دامنه سامانه پیامک</label>
                        <div>
                            <input type="url" class="form-control" name="sender_phone">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-manager-sms" role="tabpanel" aria-labelledby="pills-manager-sms-tab">
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
                    <div class="form-group mb-5">
                        <label for="" class=" form-label">وضعیت های دریافت پیامک</label>
                        <div>
                            <div>
                                <select data-control="select2" multiple name="" id="" class="form-select">
                                    <option selected value="">در انتظار پرداخت (بلافاصله بعد از ثبت سفارش)</option>
                                    <option value="">در انتظار پرداخت (بعد از تغییر وضعیت سفارش)</option>
                                    <option value="">در حال انجام</option>
                                    <option value="">در انتظار بررسی</option>
                                </select>
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
    </div>
    <div class="tab-pane fade" id="pills-customer-sms" role="tabpanel" aria-labelledby="pills-customer-sms-tab">
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group row mb-5">
                        <label for="" class="col-2 form-label">ارسال پیامک به مشتریان کل</label>
                        <div class="col-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="">
                                <label class="form-check-label">
                                    با فعالسازی این گزینه، در هنگام ثبت و یا تغییر سفارش، برای مشتریان کل سایت پیامک ارسال می گردد.
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <label for="" class=" form-label">وضعیت های دریافت پیامک</label>
                        <div>
                            <div>
                                <select data-control="select2" multiple name="" id="" class="form-select">
                                    <option selected value="">در انتظار پرداخت (بلافاصله بعد از ثبت سفارش)</option>
                                    <option value="">در انتظار پرداخت (بعد از تغییر وضعیت سفارش)</option>
                                    <option value="">در حال انجام</option>
                                    <option value="">در انتظار بررسی</option>
                                </select>
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
    </div>
    <div class="tab-pane fade" id="pills-tailor-sms" role="tabpanel" aria-labelledby="pills-tailor-sms-tab">
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group row mb-5">
                        <label for="" class="col-2 form-label">ارسال پیامک به خیاط ها</label>
                        <div class="col-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="">
                                <label class="form-check-label">
                                    با فعالسازی این گزینه، در هنگام ثبت و یا تغییر سفارش، برای خیاط های کل سایت پیامک ارسال می گردد.
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <label for="" class=" form-label">وضعیت های دریافت پیامک</label>
                        <div>
                            <div>
                                <select data-control="select2" multiple name="" id="" class="form-select">
                                    <option selected value="">در انتظار پرداخت (بلافاصله بعد از ثبت سفارش)</option>
                                    <option value="">در انتظار پرداخت (بعد از تغییر وضعیت سفارش)</option>
                                    <option value="">در حال انجام</option>
                                    <option value="">در انتظار بررسی</option>
                                </select>
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
    </div>
</div>
@endsection