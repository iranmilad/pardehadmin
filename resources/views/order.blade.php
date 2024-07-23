<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')

@section('title', 'سفارش #060')

@section("toolbar")
<div>
    <a href="#" class="btn btn-success">خروجی csv</a>
    <a href="{{route('order.print.show',['id' => 1])}}" class="btn btn-info" target="_blank">پرینت</a>
</div>
@endsection

@section('content')

<div class="card mb-10">
    <div class="card-header">
        <div class="card-title">
            <h4>جزئیات سفارش</h4>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg">
                <div class="mb-5">
                    <label class="form-label" for="">تاریخ و زمان ایجاد</label>
                    <input class="form-control form-control-solid" type="text" id="date_time">
                </div>
                <div class="mb-5">
                    <label class="form-label" for="">وضعیت</label>
                    <select multiple class="form-select form-select-solid" data-placeholder="انتخاب وضعیت" data-control="select2" name="" id="">
                        <option value="1">در انتظار بررسی</option>
                        <option value="2">درحال بررسی</option>
                        <option value="3">انجام شده</option>
                    </select>
                </div>
                <div class="mb-5">
                    <x-advanced-search type="user" label="مشتری" name="user" solid />
                </div>
            </div>
            <div class="col-lg">
                <div class="d-flex align-items-center justify-content-between">
                    <h4>صورت حساب</h4>
                    <button data-bs-toggle="modal" data-bs-target="#edit_billing" class="btn btn-sm btn-light"><i class="fa-duotone fa-pen"></i>ویرایش</button>
                </div>
                <ul class="tw-list-none tw-space-y-3">
                    <li><span class="fw-bold">نام و نام خانوادگی : </span>فرهاد باقری</li>
                    <li><span class="fw-bold">تلفن : </span>09374039436</li>
                    <li><span class="fw-bold">ایمیل : </span>coding.farhad@gmail.com</li>
                    <li><span class="fw-bold">کشور : </span>ایران</li>
                    <li><span class="fw-bold">استان : </span>فارس</li>
                    <li><span class="fw-bold">شهر : </span>شیراز</li>
                    <li><span class="fw-bold">آدرس : </span>فارس - شیراز - خیابان ارم - کوچه 8 - پلاک 123</li>
                    <li><span class="fw-bold">یادداشت : </span>این یک یادداشت تستی است</li>
                </ul>
            </div>
            <div class="col-lg">
                <div class="d-flex align-items-center justify-content-between">
                    <h4>حمل و نقل</h4>
                    <button data-bs-toggle="modal" data-bs-target="#edit_shipping" class="btn btn-sm btn-light"><i class="fa-duotone fa-pen"></i>ویرایش</button>
                </div>
                <ul class="tw-list-none tw-space-y-3">
                    <li><span class="fw-bold">نام و نام خانوادگی : </span>فرهاد باقری</li>
                    <li><span class="fw-bold">تلفن : </span>09374039436</li>
                    <li><span class="fw-bold">ایمیل : </span>coding.farhad@gmail.com</li>
                    <li><span class="fw-bold">کشور : </span>ایران</li>
                    <li><span class="fw-bold">استان : </span>فارس</li>
                    <li><span class="fw-bold">شهر : </span>شیراز</li>
                    <li><span class="fw-bold">آدرس : </span>فارس - شیراز - خیابان ارم - کوچه 8 - پلاک 123</li>
                    <li><span class="fw-bold">یادداشت : </span>این یک یادداشت تستی است</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="card mb-10">
    <div class="card-header">
        <div class="card-title">
            <h4>محصولات</h4>
        </div>
    </div>
    <div class="card-body">
        <table id="order_table" class="table gy-5 gs-7 tw-align-middle">
            <thead>
                <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                    <th class="cursor-pointer px-0 text-start">محصول</th>
                    <th class="cursor-pointer px-0 text-start">هزینه</th>
                    <th class="cursor-pointer px-0 text-start">تعداد</th>
                    <th class="cursor-pointer px-0 text-start">مجموع</th>
                    <th class="cursor-pointer px-0 text-start">جزئیات</th>
                    <th class="text-end">عملیات</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <a href="{{route('attribute.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">
                            <img class="tw-size-16 tw-rounded-md" src="/images/1.jpg" alt="">
                            <span>پرده رنگی</span>
                        </a>
                    </td>
                    <td>
                        <a href="{{route('attribute.show',['id' => 1])}}">12,000,000 تومان</a>
                    </td>
                    <td>
                        <span>1</span>
                    </td>
                    <td>
                        <span>12,000,000</span>
                    </td>
                    <td><button class="btn btn-sm btn-info" onclick="toggleDetails('details-1234')">جزئیات</button></td>
                    <td class="text-end">
                        <a href="{{route('attribute.show',['id' => 1])}}" class="btn btn-danger btn-sm">
                            حذف
                        </a>
                    </td>
                </tr>
                <tr id="details-1234" style="display:none;">
                    <td colspan="6">
                        <form id="product-details-1234">
                            <label class="form-label">رنگ: 
                                <select disabled class="form-select">
                                    <option value="red">قرمز</option>
                                    <option value="green">سبز</option>
                                    <option value="blue">آبی</option>
                                </select>
                            </label>
                            <label class="form-label">جنس: 
                                <select disabled class="form-select">
                                    <option value="cotton">پنبه</option>
                                    <option value="silk">ابریشم</option>
                                    <option value="wool">پشم</option>
                                </select>
                            </label>
                            <label class="form-label">سایز: 
                                <select disabled class="form-select">
                                    <option value="small">کوچک</option>
                                    <option value="medium">متوسط</option>
                                    <option value="large">بزرگ</option>
                                </select>
                            </label>
                            <label class="form-label">تعداد: 
                                <input disabled type="number" class="form-control" value="1">
                            </label>
                            <button type="button" class="btn btn-secondary editOptionsToggleOrder" data-clicked="false">ویرایش</button>
                            <button class="btn btn-success" type="submit">ذخیره</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <div class="d-flex align-items-center justify-content-between flex-column-reverse flex-md-row">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-5 mb-5">
                <button class="btn btn-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#add_product_collapse">افزودن محصول</button>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#coupon">افزودن کد تخفیف</button>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#refund">برگشت</button>
            </div>
            <ul class="tw-space-y-3">
                <li class="fs-6"><span class="fw-bold">کد تخفیف اعمال شده : </span>12OFF</li>
                <li class="fs-6"><span class="fw-bold">تخفیف اعمال شده : </span>20%</li>
                <li class="fs-6"><span class="fw-bold">مجموع سفارش: </span>12,000,000</li>
            </ul>
        </div>
        <div class="collapse" id="add_product_collapse">
            <div class="row align-items-end gap-5">
                <div class="col-md-6 col-lg-4">
                    <x-advanced-search type="product" label="محصول" name="new_products" solid />
                </div>
                <div class="col-md-6 col-lg">
                    <button class="btn btn-sm btn-success" type="submit">افزودن</button>
                    <button class="btn btn-sm btn-danger" data-bs-toggle="collapse" data-bs-target="#add_product_collapse">لغو</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-10">
    <div class="card-header">
        <div class="card-title">
            <h4>خدمت ها</h4>
        </div>
    </div>
    <div class="card-body">
        <table id="global_table" class="table gy-5 gs-7 tw-align-middle">
            <thead>
                <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                    <th class="cursor-pointer px-0 text-start">عنوان</th>
                    <th class="cursor-pointer px-0 text-start">هزینه</th>
                    <th class="cursor-pointer px-0 text-start">تعداد</th>
                    <th class="cursor-pointer px-0 text-start">مجموع</th>
                    <th class="text-end">عملیات</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <a href="{{route('attribute.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">
                            <span>خیاطی پارچه مخمل</span>
                        </a>
                    </td>
                    <td>
                        <a href="{{route('attribute.show',['id' => 1])}}">12,000,000 تومان</a>
                    </td>
                    <td>
                        <span>1</span>
                    </td>
                    <td>
                        <span>12,000,000</span>
                    </td>
                    <td class="text-end">
                        <a href="{{route('attribute.show',['id' => 1])}}" class="btn btn-danger btn-sm">
                            حذف
                        </a>
                    </td>
                </tr>
                <tr id="details-1234" style="display:none;">
                    <td colspan="6">
                        <form id="product-details-1234">
                            <label class="form-label">رنگ: 
                                <select disabled class="form-select">
                                    <option value="red">قرمز</option>
                                    <option value="green">سبز</option>
                                    <option value="blue">آبی</option>
                                </select>
                            </label>
                            <label class="form-label">جنس: 
                                <select disabled class="form-select">
                                    <option value="cotton">پنبه</option>
                                    <option value="silk">ابریشم</option>
                                    <option value="wool">پشم</option>
                                </select>
                            </label>
                            <label class="form-label">سایز: 
                                <select disabled class="form-select">
                                    <option value="small">کوچک</option>
                                    <option value="medium">متوسط</option>
                                    <option value="large">بزرگ</option>
                                </select>
                            </label>
                            <label class="form-label">تعداد: 
                                <input disabled type="number" class="form-control" value="1">
                            </label>
                            <button type="button" class="btn btn-secondary editOptionsToggleOrder" data-clicked="false">ویرایش</button>
                            <button class="btn btn-success" type="submit">ذخیره</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <div class="d-flex align-items-center justify-content-between flex-column-reverse flex-md-row">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-5 mb-5">
                <button class="btn btn-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#add_service_collapse">افزودن خدمت</button>
            </div>
            <ul class="tw-space-y-3">
                <li class="fs-6"><span class="fw-bold">مجموع سفارش: </span>12,000,000</li>
            </ul>
        </div>
        <div class="collapse" id="add_service_collapse">
            <div class="row align-items-end gap-5">
                <div class="col-md-6 col-lg-4">
                    <x-advanced-search type="product" label="خدمت" name="new_products" solid />
                </div>
                <div class="col-md-6 col-lg">
                    <button class="btn btn-sm btn-success" type="submit">افزودن</button>
                    <button class="btn btn-sm btn-danger" data-bs-toggle="collapse" data-bs-target="#add_service_collapse">لغو</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card mb-10">
            <div class="card-header">
                <div class="card-title">
                    <h4>یادداشت</h4>
                </div>
            </div>
            <div class="card-body">
                <form class="row gap-5">
                    <div class="col-12">
                        <label class="form-label fs-6" for="">یادداشت</label>
                        <textarea class="form-control form-control-solid" placeholder="یادداشت" rows="10"></textarea>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-success btn-sm">ذخیره</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card mb-10">
            <div class="card-header">
                <div class="card-title">
                    <h4>عملیات</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="" class="row gap-5">
                    <div>
                        <label class="form-label" for="">انجام عملیات</label>
                        <select class="form-select form-select-solid" name="" id="">
                            <option value="1">ارسال مجدد پیامک صورت حساب</option>
                            <option value="2">حذف سفارش</option>
                        </select>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-primary">اجرا</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- START: REFUND -->
<div class="modal fade" id="refund" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">بازگشت</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gap-5">
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                موارد برگشتی به انبار
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <span><b>مبلغ قبلا مسترد شده است : </b> 0 تومان</span>
                    </div>
                    <div class="col-12">
                        <span><b>مجموع موجود برای استرداد : </b> 12,000,000 تومان</span>
                    </div>
                    <div class="col-12">
                        <div>
                            <label class="form-label" for="">مبلغ استرداد</label>
                            <input class="form-control form-control-solid" placeholder="وارد کنید" type="text">
                        </div>
                    </div>
                    <div class="col-12">
                        <div>
                            <label class="form-label" for="">دلیل استرداد (دلخواه)</label>
                            <textarea class="form-control form-control-solid" placeholder="وارد کنید"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                <button type="button" class="btn btn-primary">ذخیره</button>
            </div>
        </form>
    </div>
</div>
<!-- END: REFUND -->

<!-- START: COUPON -->
<div class="modal fade" id="coupon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">کد تخفیف</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div>
                            <label for="" class="form-label">کد تخفیف</label>
                            <input class="form-control form-control-solid" type="text">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                <button type="button" class="btn btn-primary">اعمال کد تخفیف</button>
            </div>
        </div>
    </div>
</div>
<!-- END: COUPON -->


<!-- START: BILLING -->
<div class="modal fade" id="edit_billing" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">ویرایش صورت حساب</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-4">
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="" class="form-label">نام</label>
                            <input class="form-control form-control-solid" type="text">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="" class="form-label">نام خانوادگی</label>
                            <input class="form-control form-control-solid" type="text">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="" class="form-label">شماره تلفن</label>
                            <input class="form-control form-control-solid" type="text">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="" class="form-label">آدرس ایمیل</label>
                            <input class="form-control form-control-solid" type="text">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="" class="form-label">کد ملی</label>
                            <input class="form-control form-control-solid" type="text">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="" class="form-label">کشور</label>
                            <input class="form-control form-control-solid" type="text">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="" class="form-label">استان</label>
                            <input class="form-control form-control-solid" type="text">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="" class="form-label">شهر</label>
                            <input class="form-control form-control-solid" type="text">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="" class="form-label">آدرس</label>
                            <input class="form-control form-control-solid" type="text">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="" class="form-label">کد پستی 10 رقمی ( انگلیسی وارد کنید )</label>
                            <input class="form-control form-control-solid" type="text">
                        </div>
                    </div>
                    <div class="col-12">
                        <div>
                            <label for="" class="form-label">یادداشت سفارش</label>
                            <textarea class="form-control form-control-solid"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                <button type="button" class="btn btn-primary">اعمال</button>
            </div>
        </form>
    </div>
</div>
<!-- END: BILLING -->


<!-- START: BILLING -->
<div class="modal fade" id="edit_shipping" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">ویرایش حمل و نقل</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-4">
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="" class="form-label">نام</label>
                            <input class="form-control form-control-solid" type="text">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="" class="form-label">نام خانوادگی</label>
                            <input class="form-control form-control-solid" type="text">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="" class="form-label">شماره تلفن</label>
                            <input class="form-control form-control-solid" type="text">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="" class="form-label">آدرس ایمیل</label>
                            <input class="form-control form-control-solid" type="text">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="" class="form-label">کد ملی</label>
                            <input class="form-control form-control-solid" type="text">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="" class="form-label">کشور</label>
                            <input class="form-control form-control-solid" type="text">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="" class="form-label">استان</label>
                            <input class="form-control form-control-solid" type="text">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="" class="form-label">شهر</label>
                            <input class="form-control form-control-solid" type="text">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="" class="form-label">آدرس</label>
                            <input class="form-control form-control-solid" type="text">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="" class="form-label">کد پستی 10 رقمی ( انگلیسی وارد کنید )</label>
                            <input class="form-control form-control-solid" type="text">
                        </div>
                    </div>
                    <div class="col-12">
                        <div>
                            <label for="" class="form-label">یادداشت سفارش</label>
                            <textarea class="form-control form-control-solid"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                <button type="button" class="btn btn-primary">اعمال</button>
            </div>
        </form>
    </div>
</div>
<!-- END: BILLING -->

@endsection

@section("script-before")
<script src="{{asset('plugins/flatpicker_fa.js')}}"></script>
<script src="{{asset('plugins/jdate.min.js')}}"></script>
@endsection


@section("scripts")
<script>
    window.Date = window.JDate;
    flatpickr = $("#date_time").flatpickr({
        disableMobile: "true",
        altInput: true,
        altFormat: "H:i Y-m-d",
        dateFormat: "H:i Y-m-d",
        locale: "fa",
        enableTime: true,
        time_24hr: true,
        monthSelectorType: "static"
    });

    function toggleDetails(id) {
        const element = document.getElementById(id);
        element.style.display = (element.style.display === 'none') ? 'table-row' : 'none';
    }
</script>
@endsection