<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')

@section('title', 'سفارش #'.$order->id)

@section("toolbar")
<div class="d-none">
    <a href="#" class="btn btn-success">خروجی csv</a>
    <a href="{{route('orders.print',['id' =>  $order->id])}}" class="btn btn-info" target="_blank">پرینت</a>
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
                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')


                        <!-- تاریخ و زمان ایجاد -->
                        <div class="mb-5">
                            <label class="form-label" for="date_time">تاریخ و زمان ایجاد</label>
                            <input class="form-control form-control-solid" name="created_at" type="text" data-jdp id="date_time" value="{{ $order->created_at }}" readonly>
                        </div>

                        <!-- وضعیت سفارش -->
                        <div class="mb-5">
                            <label class="form-label" for="status">وضعیت</label>
                            <select class="form-select form-select-solid" name="status" id="status">
                                <option value="basket" {{ $order->status == 'basket' ? 'selected' : '' }}>سبد خرید</option>
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>در انتظار بررسی</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>درحال بررسی</option>
                                <option value="complete" {{ $order->status == 'complete' ? 'selected' : '' }}>انجام شده</option>
                                <option value="cancel" {{ $order->status == 'cancel' ? 'selected' : '' }}>لغو شده</option>
                                <option value="reject" {{ $order->status == 'reject' ? 'selected' : '' }}>رد شده</option>
                            </select>
                        </div>

                        <!-- اطلاعات مشتری -->
                        <div class="mb-5">
                            <label class="form-label" for="customer">مشتری</label>
                            <input class="form-control form-control-solid" type="text" id="customer" value="{{ $order->customer_name }}" readonly>
                        </div>

                        <!-- دکمه ذخیره تغییرات -->
                        <div class="mb-5">
                            <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                        </div>

                </form>
            </div>
            <div class="col-lg">
                <div class="d-flex align-items-center justify-content-between">
                    <h4>صورت حساب</h4>
                    <button data-bs-toggle="modal" data-bs-target="#edit_billing" class="btn btn-sm btn-light"><i class="fa-duotone fa-pen"></i>ویرایش</button>
                </div>
                <ul class="tw-list-none tw-space-y-3">
                    <li><span class="fw-bold">نام و نام خانوادگی : </span>{{ $order->user->fullName }}</li>
                    <li><span class="fw-bold">تلفن : </span>{{ $order->user->mobile }}</li>
                    <li><span class="fw-bold">ایمیل : </span>{{ $order->user->email }}</li>
                    <li><span class="fw-bold">کشور : </span>{{ $order->user->country }}</li>
                    <li><span class="fw-bold">استان : </span>{{ $order->user->province }}</li>
                    <li><span class="fw-bold">شهر : </span>{{ $order->user->city }}</li>
                    <li><span class="fw-bold">آدرس : </span>{{ $order->user->address }}</li>
                    <li><span class="fw-bold">کد پستی : </span>{{ $order->user->postal_code }}</li>
                </ul>
            </div>
            <div class="col-lg">
                <div class="d-flex align-items-center justify-content-between">
                    <h4>حمل و نقل</h4>
                    <button data-bs-toggle="modal" data-bs-target="#edit_shipping" class="btn btn-sm btn-light"><i class="fa-duotone fa-pen"></i>ویرایش</button>
                </div>
                <ul class="tw-list-none tw-space-y-3">
                    <li><span class="fw-bold">نام و نام خانوادگی : </span>{{ $order->customer_name }}</li>
                    <li><span class="fw-bold">تلفن : </span>{{ $order->shipping_phone }}</li>
                    <li><span class="fw-bold">ایمیل : </span>{{ $order->customer_email }}</li>
                    <li><span class="fw-bold">کشور : </span>{{ $order->shipping_country }}</li>
                    <li><span class="fw-bold">استان : </span>{{ $order->shipping_province }}</li>
                    <li><span class="fw-bold">شهر : </span>{{ $order->shipping_city }}</li>
                    <li><span class="fw-bold">آدرس : </span>{{ $order->shipping_address }}</li>
                    <li><span class="fw-bold">کد پستی : </span>{{ $order->shipping_postal_code }}</li>
                    <li><span class="fw-bold">یادداشت : </span>{{ $order->shipping_note }}</li>
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
            @forelse ($order->orderItems as $item)
                @if (isset($item->product))


                    <tr>
                        <td>
                            <a href="{{ route('products.edit', ['id' => $item->product_id]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">
                                <img class="tw-size-16 tw-rounded-md" src="{{ $item->product->img }}" alt="">
                                <span>{{ $item->product->title }}</span>
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('products.edit', ['id' => $item->product_id]) }}">{{ $item->sale_price>0 ? $item->sale_price:$item->price }} تومان</a>
                        </td>
                        <td>
                            <span>{{ $item->quantity }}</span>
                        </td>
                        <td>
                            <span>{{ number_format($item->total) }} تومان</span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="toggleDetails('details-{{ $item->id }}')">جزئیات</button>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('products.edit', ['id' => $item->product_id]) }}" class="btn btn-danger btn-sm">
                                حذف
                            </a>
                        </td>
                    </tr>
                    <tr id="details-{{ $item->id }}" style="display:none;">
                        <td colspan="6">
                            <form id="product-details-{{ $item->id }}" action="{{ route('updateProductDetails', ['id' => $item->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->product_id }}">

                                @php
                                    $property = [];
                                    $selectedProperties = [];

                                    // دریافت ترکیبات ویژگی‌های آیتم سفارش با استفاده از متد getCombinationAttributesProperties
                                    $combinations = $item->getCombinationAttributesProperties();

                                    foreach($combinations as $combination) {
                                        $property[$combination['attribute_id']][$combination['attribute_name']][] = $combination['property_id'];
                                        // ذخیره ویژگی‌های انتخاب شده
                                        $selectedProperties[$combination['attribute_id']] = ["property_value"=>$combination['property_value'],"property_id"=>$combination['property_id']];
                                    }
                                @endphp
                                @if ($property)
                                    @foreach ($property as $id => $attributes)
                                        @foreach ($attributes as $attribute => $props)
                                            <label class="form-label">{{ $attribute }}:
                                                <select class="form-select" name="param[attribute][{{ $id }}]">
                                                    @foreach($props as $select)
                                                        <option value="{{ $selectedProperties[$id]["property_id"] }}" {{ $selectedProperties[$id]["property_id"] == $select ? 'selected' : '' }}>{{ $selectedProperties[$id]["property_value"] }}</option>
                                                    @endforeach
                                                </select>
                                            </label>
                                        @endforeach
                                    @endforeach
                                @else

                                    @foreach ($item->product->attributes as $attribute)

                                        @if ($attribute->independent != 1)
                                            <label class="form-label">{{ $attribute->name }}:
                                                <select class="form-select" name="param[attribute][{{ $attribute->id }}]">
                                                    @foreach($attribute->properties as $property)
                                                        <option value="{{ $property->id }}">{{ $property->value }}</option>
                                                    @endforeach
                                                </select>
                                            </label>
                                        @endif
                                    @endforeach
                                @endif

                                <label class="form-label">تعداد:
                                    <input type="number" class="form-control" name="quantity" value="{{ $item->quantity }}">
                                </label>

                                <button type="button" class="btn btn-secondary editOptionsToggleOrder" data-clicked="false">ویرایش</button>
                                <button class="btn btn-success" type="submit">ذخیره</button>
                            </form>




                        </td>
                    </tr>
                @endif
            @empty
                <tr><td>هیچ محصولی یافت نشد</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer">
        <div class="d-flex align-items-center justify-content-between flex-column-reverse flex-md-row">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-5 mb-5">
                <button class="btn btn-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#add_product_collapse">افزودن محصول</button>
                <button class="btn btn-primary btn-sm d-none" data-bs-toggle="modal" data-bs-target="#coupon">افزودن کد تخفیف</button>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#refund">برگشت</button>
            </div>
            <ul class="tw-space-y-3">
                <li class="fs-6"><span class="fw-bold">هزینه سفارش : </span>{{ isset($order) ? $order->basket()->cart->total : '' }} تومان</li>
                <li class="fs-6"><span class="fw-bold">هزینه ارسال : </span>{{ isset($order) ? $order->basket()->cart->deliveryCost  : '' }} تومان</li>
                <li class="fs-6"><span class="fw-bold">قابل پرداخت: </span>{{ isset($order) ? $order->basket()->cart->totalPayed : '' }} تومان</li>
            </ul>
        </div>
        <div class="collapse" id="add_product_collapse">
            <div class="row align-items-end gap-5">
                <form action="{{ route('orders.addProduct', ['order' => $order->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <x-advanced-search type="product" label="محصول" name="product_id" solid />
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <label class="form-label" for="quantity">تعداد:</label>
                            <input type="number" class="form-control" name="quantity" required min="1">

                        </div>

                    </div>
                    <div class="col-md-6 col-lg mt-2">
                        <button class="btn btn-sm btn-success" type="submit">افزودن</button>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="collapse" data-bs-target="#add_product_collapse">لغو</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="card mb-10 d-none">
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
                        <a href="{{route('orders.edit',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">
                            <span>خیاطی پارچه مخمل</span>
                        </a>
                    </td>
                    <td>
                        <a href="{{route('orders.edit',['id' => 1])}}">12,000,000 تومان</a>
                    </td>
                    <td>
                        <span>1</span>
                    </td>
                    <td>
                        <span>12,000,000</span>
                    </td>
                    <td class="text-end">
                        <a href="{{route('orders.edit',['id' => 1])}}" class="btn btn-danger btn-sm">
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
                <form class="row gap-5" method="POST" action="{{ route('orders.updateShippingNote', $order->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="col-12">
                        <label class="form-label fs-6" for="shipping_admin_note">یادداشت</label>
                        <textarea class="form-control form-control-solid" placeholder="یادداشت" rows="10" name="shipping_admin_note">{{ $order->shipping_admin_note }}</textarea>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-success btn-sm" type="submit">ذخیره</button>
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
        <form class="modal-content" method="POST" action="{{ route('orders.updateBilling', $order->id) }}">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">ویرایش صورت حساب</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-4">
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="first_name" class="form-label">نام</label>
                            <input class="form-control form-control-solid" type="text" id="first_name" name="first_name" value="{{ $order->user->first_name }}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="last_name" class="form-label">نام خانوادگی</label>
                            <input class="form-control form-control-solid" type="text" id="last_name" name="last_name" value="{{ $order->user->last_name }}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="mobile" class="form-label">شماره تلفن</label>
                            <input class="form-control form-control-solid" type="text" id="mobile" name="mobile" value="{{ $order->user->mobile }}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="email" class="form-label">آدرس ایمیل</label>
                            <input class="form-control form-control-solid" type="text" id="email" name="email" value="{{ $order->user->email }}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="country" class="form-label">کشور</label>
                            <input class="form-control form-control-solid" type="text" id="country" name="country" value="{{ $order->user->country }}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="province" class="form-label">استان</label>
                            <input class="form-control form-control-solid" type="text" id="province" name="province" value="{{ $order->user->province }}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="city" class="form-label">شهر</label>
                            <input class="form-control form-control-solid" type="text" id="city" name="city" value="{{ $order->user->city }}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="address" class="form-label">آدرس</label>
                            <input class="form-control form-control-solid" type="text" id="address" name="address" value="{{ $order->user->address }}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="postal_code" class="form-label">کد پستی 10 رقمی ( انگلیسی وارد کنید )</label>
                            <input class="form-control form-control-solid" type="text" id="postal_code" name="postal_code" value="{{ $order->user->postal_code }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                <button type="submit" class="btn btn-primary">اعمال</button>
            </div>
        </form>
    </div>
</div>
<!-- END: BILLING -->


<!-- START: SHIPPING -->
<div class="modal fade" id="edit_shipping" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" method="POST" action="{{ route('orders.updateShipping', $order->id) }}">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">ویرایش حمل و نقل</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-4">
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="customer_name" class="form-label">نام و نام خانوادگی</label>
                            <input class="form-control form-control-solid" type="text" id="customer_name" name="customer_name" value="{{ $order->customer_name }}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="shipping_phone" class="form-label">شماره تلفن</label>
                            <input class="form-control form-control-solid" type="text" id="shipping_phone" name="shipping_phone" value="{{ $order->shipping_phone }}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="customer_email" class="form-label">آدرس ایمیل</label>
                            <input class="form-control form-control-solid" type="text" id="customer_email" name="customer_email" value="{{ $order->customer_email }}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="shipping_country" class="form-label">کشور</label>
                            <input class="form-control form-control-solid" type="text" id="shipping_country" name="shipping_country" value="{{ $order->shipping_country }}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="shipping_province" class="form-label">استان</label>
                            <input class="form-control form-control-solid" type="text" id="shipping_province" name="shipping_province" value="{{ $order->shipping_province }}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="shipping_city" class="form-label">شهر</label>
                            <input class="form-control form-control-solid" type="text" id="shipping_city" name="shipping_city" value="{{ $order->shipping_city }}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="shipping_address" class="form-label">آدرس</label>
                            <input class="form-control form-control-solid" type="text" id="shipping_address" name="shipping_address" value="{{ $order->shipping_address }}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div>
                            <label for="shipping_postal_code" class="form-label">کد پستی سفارش</label>
                            <input class="form-control form-control-solid" type="text" id="shipping_postal_code" name="shipping_postal_code" value="{{ $order->shipping_postal_code }}">
                        </div>
                    </div>
                    <div class="col-12">
                        <div>
                            <label for="shipping_note" class="form-label">یادداشت سفارش</label>
                            <textarea class="form-control form-control-solid" id="shipping_note" name="shipping_note">{{ $order->shipping_note }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                <button type="submit" class="btn btn-primary">اعمال</button>
            </div>
        </form>
    </div>
</div>
<!-- END: SHIPPING -->


@endsection

@section("script-before")
<script src="{{asset('plugins/jalalidatepicker.min.js')}}"></script>
@endsection


@section("scripts")
<script>
    jalaliDatepicker.startWatch({
        time: true,
        hasSecond: false
    });

    function toggleDetails(id) {
        const element = document.getElementById(id);
        element.style.display = (element.style.display === 'none') ? 'table-row' : 'none';
    }


</script>
@endsection

