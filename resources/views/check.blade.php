<!-- resources/views/checks/create_or_edit.blade.php -->

@extends('layouts.primary')

@section('title', Route::is('checks.create') ? 'ایجاد چک' : 'ویرایش چک')

@section('content')

<form method="post" action="{{ Route::is('checks.create') ? route('checks.store') : route('checks.update', ['id' => $order->id ?? 0]) }}">
    @csrf
    @if(Route::is('checks.edit'))
        @method('PUT')
    @endif
    <!-- PARENT -->
    <div class="card mb-8">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h3>مشخصات چک های سفارش</h3>
                </div>
            </div>
            <div class="card-body">
                @if(Route::is('checks.create'))
                    <div class="mb-10">

                        <x-advanced-search type="order" label="انتخاب سفارش" name="order_id"/>
                    </div>
                @else
                    <div class="symbol symbol-40px me-3 d-flex align-items-center flex-row" >

                            <div class="symbol symbol-40px me-3">
                                <img src="/images/avatar.png" class="" alt="" />
                            </div>
                            <div class="d-flex justify-content-start flex-column">
                                <span class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{ $order->user->name }}</span>
                                <span class="text-primary"><a href="{{ route('users.profile', ['id' => $order->user->id]) }}" >مشاهده کاربر</a></span>
                                <span class="text-primary"><a href="{{ route('orders.edit', ['id' => $order->id]) }}" >مشاهده سفارش</a></span>
                            </div>

                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                    </div>

                    <div class="row mt-10">
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                            <label class="form-label">تکمیل شده:</label>
                            <span class="badge badge-primary">{{ $order->getTotalChecksCount()==$order->getPaidChecksCount() ? 'بله' : 'خیر' }}</span>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                            <label class="form-label">تعداد پرداختی:</label>
                            <span class="badge badge-primary">{{ $order->getPaidChecksCount() }} <span class="mx-2">از</span>{{ $order->getTotalChecksCount() }}</span>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                            <label class="form-label">تاریخ پرداخت بعدی:</label>
                            <span class="text-primary">{{ $order->getnextDueDate() }}</span>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                            <label class="form-label">مبلغ کل چک:</label>
                            <span class="text-primary">{{ number_format($order->getTotalUnpaidChecksAmount()) }} تومان</span>
                        </div>
                    </div>

                @endif
            </div>
        </div>
    </div>
    <!-- PARENT -->
    <!-- CHILDREN COLOR -->
    <div class="card mb-10">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h3>مشخصات برگه چک‌ها</h3>
                </div>
            </div>
            <div class="card-body">
                <!-- CHILDREN -->
                <div class="row">
                    <div class="check_repeater">
                        <!--begin::Form group-->
                        <div class="form-group">
                            <div data-repeater-list="checks">
                                @if (Route::is('checks.edit'))
                                    @foreach ($order->checks as $check)

                                            <div class="mt-3" data-repeater-item>

                                                <div class="form-group row">
                                                    <div class="col-12 col-md">
                                                        <label class="form-label required">شناسه یکتا:</label>
                                                        <input name="checks[{{ $loop->index }}][check_number]" type="text" class="form-control mb-2 mb-md-0" placeholder="شناسه یکتا را وارد کنید" value="{{ old('check_number', $check->check_number) }}" required />
                                                    </div>
                                                    <div class="col-12 col-md">
                                                        <label class="form-label required">مبلغ:</label>
                                                        <input name="checks[{{ $loop->index }}][amount]" type="text" class="form-control mb-2 mb-md-0" placeholder="مبلغ را وارد کنید" value="{{ old('amount', $check->amount) }}" required />
                                                    </div>
                                                    <div class="col-12 col-md">
                                                        <label class="form-label required" for="">تاریخ:</label>
                                                        <input class="form-control mb-2 mb-md-0 form-date" type="text" name="checks[{{ $loop->index }}][due_date]" placeholder="تاریخ را انتخاب کنید" value="{{ old('due_date', $check->due_date) }}" required>
                                                    </div>
                                                    <div class="col-12 col-md">
                                                        <label class="form-label required">وضعیت:</label>
                                                        <select name="checks[{{ $loop->index }}][payment_status]" class="form-select mb-2 mb-md-0" required>
                                                            <option value="paid" {{ old('payment_status', $check->payment_status) == "paid" ? 'selected' : '' }}>پاس شده</option>
                                                            <option value="unpaid" {{ old('payment_status', $check->payment_status) == "unpaid" ? 'selected' : '' }}>پاس نشده</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-md">
                                                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                            حذف
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>

                                    @endforeach
                                @else
                                    <div class="form-group row">
                                        <div class="col-12 col-md">
                                            <label class="form-label required">شناسه یکتا:</label>
                                            <input name="checks[][check_number]" type="text" class="form-control mb-2 mb-md-0" placeholder="شناسه یکتا را وارد کنید" value="" required />
                                        </div>
                                        <div class="col-12 col-md">
                                            <label class="form-label required">مبلغ:</label>
                                            <input name="checks[][amount]" type="text" class="form-control mb-2 mb-md-0" placeholder="مبلغ را وارد کنید" value="" required />
                                        </div>
                                        <div class="col-12 col-md">
                                            <label class="form-label required" for="">تاریخ:</label>
                                            <input class="form-control mb-2 mb-md-0 form-date" type="text" name="checks[][due_date]" placeholder="تاریخ را انتخاب کنید" value="" required>
                                        </div>
                                        <div class="col-12 col-md">
                                            <label class="form-label required">وضعیت:</label>
                                            <select name="checks[][payment_status]" class="form-select mb-2 mb-md-0" required>
                                                <option value="paid">پاس شده</option>
                                                <option value="unpaid" selected>پاس نشده</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md">
                                            <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                حذف
                                            </a>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                        <!--end::Form group-->
                        <!--begin::Form group-->
                        <div class="form-group mt-5">
                            <a href="javascript:;" data-repeater-create class="btn btn-primary btn-sm">
                                افزودن
                                <i class="ki-duotone ki-plus fs-3 pe-0"></i>
                            </a>
                        </div>
                        <!--end::Form group-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CHILDREN COLOR -->

    <button type="submit" class="mt-10 btn btn-success">ذخیره</button>
</form>

@endsection

@section('script-before')
<script src="{{ asset('plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
<script src="{{ asset('plugins/flatpicker_fa.js') }}"></script>
<script src="{{ asset('plugins/jdate.min.js') }}"></script>
@endsection

@section("scripts")
<script>
    window.Date = window.JDate;
    document.addEventListener("DOMContentLoaded", function() {
        $(".check_repeater").repeater({
            initEmpty: false,
            ready: function() {
                $('.form-date').flatpickr({
                    disableMobile: "true",
                    altInput: true,
                    altFormat: "Y-m-d",
                    dateFormat: "Y-m-d",
                    locale: "fa",
                });
            },
            show: function() {
                $(this).slideDown();
                $(this).parent().find('.form-date').flatpickr({
                    disableMobile: "true",
                    altInput: true,
                    altFormat: "Y-m-d",
                    dateFormat: "Y-m-d",
                    locale: "fa",
                });
            },
            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    });
</script>
@endsection
