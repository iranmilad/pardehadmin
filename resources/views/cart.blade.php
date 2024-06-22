@extends('layouts.primary')

@if(Route::is('carts.create'))
@section('title', 'ایجاد سبد خرید')
@else
@section('title', 'ویرایش سبد خرید')
@endif

@section('content')
<form action="{{ Route::is('carts.create') ? route('carts.store') : route('carts.update', ['id' => $order->id]) }}" method="post">
    @csrf
    @if(!Route::is('carts.create'))
        @method('PUT')
    @endif
    <div class="card mb-10">
        <div class="card-header">
            <h4 class="card-title">جزئیات سبد</h4>
        </div>
        <div class="card-body">
            <div class="mb-5">
                @php
                    $user= [[
                        'id' => $order->user->id,
                        'text' => "{$order->user->fullName} ({$order->user->email})",
                    ]];
                @endphp
                <x-advanced-search type="user" label="مشتری" name="user" solid :selected="$user" disabled/>
            </div>
        </div>
    </div>
    <!-- PRODUCTS PATTERN -->
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
                            <a href="{{route('products.edit',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">
                                <img class="tw-size-16 tw-rounded-md" src="/images/1.jpg" alt="">
                                <span>پرده رنگی</span>
                            </a>
                        </td>
                        <td>
                            <a href="{{route('products.edit',['id' => 1])}}">12,000,000 تومان</a>
                        </td>
                        <td>
                            <span>1</span>
                        </td>
                        <td>
                            <span>12,000,000</span>
                        </td>
                        <td><button type="button" class="btn btn-sm btn-info" onclick="toggleDetails('details-1234')">جزئیات</button></td>
                        <td class="text-end">
                            <a href="{{route('products.edit',['id' => 1])}}" class="btn btn-danger btn-sm">
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
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#add_product_collapse">افزودن محصول</button>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#coupon">افزودن کد تخفیف</button>
                </div>
                <ul class="tw-space-y-3">
                    <li class="fs-6"><span class="fw-bold">هزینه سفارش : </span>{{ isset($order) ? $order->basket()->cart->total : '' }} تومان</li>
                    <li class="fs-6"><span class="fw-bold">هزینه ارسال : </span>{{ isset($order) ? $order->basket()->cart->deliveryCost  : '' }} تومان</li>
                    <li class="fs-6"><span class="fw-bold">قابل پرداخت: </span>{{ isset($order) ? $order->basket()->cart->totalPayed : '' }} تومان</li>
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
    <!-- PRODUCTS PATTERN -->

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
    </div>
    <button type="submit" class="btn btn-primary">ذخیره</button>
</form>

<!-- START: COUPON -->
<div class="modal fade" id="coupon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" class="modal-content">
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">کد تخفیف</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div>
                            <label for="discount_code" class="form-label">کد تخفیف</label>
                            <input class="form-control form-control-solid" type="text" name="discount_code" id="discount_code">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                <button type="submit" class="btn btn-primary">اعمال کد تخفیف</button>
            </div>
        </form>
    </div>
</div>
<!-- END: COUPON -->
@endsection

@section("script-before")
<script src="{{asset('plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
@endsection

@section('scripts')
<script>
    function toggleDetails(id) {
        const element = document.getElementById(id);
        element.style.display = (element.style.display === 'none') ? 'table-row' : 'none';
    }

</script>
@endsection
