@extends('layouts.primary')

@section('title', 'SMS ها')

@section("toolbar")
<a href="{{ route('sms.create') }}" class="btn btn-primary">ایجاد پیامک جدید</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form class="d-flex align-items-center justify-content-end" action="{{ route('sms.index') }}" method="get">
            @csrf
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span class="path2"></span></i>
                <input name="s" value="{{ request()->get('s') ?? '' }}" type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="جست و جو" />
            </div>
        </form>
        <form method="post" id="action_form" action="{{ route('sms.bulk_action') }}">
            @csrf
            <div class="d-flex tw-items-center tw-justify-start tw-w-full gap-4">
                <select class="form-select form-select-solid tw-w-max" name="action" id="">
                    <option value="">عملیات</option>
                    <option value="delete">حذف</option>
                </select>
                <button class="btn btn-primary" type="submit">اجرا</button>
            </div>

            <table id="global_table" class="table gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="w-10px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#global_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="cursor-pointer px-0 text-start">وضعیت رخداد</th>
                        <th class="text-end">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($smsList as $sms)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="checked_row[]" value="{{ $sms->id }}" />
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('sms.edit', ['id' => $sms->id]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder">{{ translateEvent($sms->event) }}</a>
                        </td>
                        <td class="text-end">
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                عملیات
                                <span class="svg-icon fs-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431427 12.2810586,7.9010683 12.6757242,8.26284435 L18.6757242,13.7628443 C19.0828438,14.1360383 19.1103467,14.7687271 18.7371527,15.1758467 C18.3639587,15.5829663 17.7312699,15.6104692 17.3241503,15.2372752 L12.0300736,10.3846187 L6.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero"></path>
                                            <path d="M8.70710678,20.7071068 C8.31658249,21.0976311 7.68341751,21.0976311 7.29289322,20.7071068 C6.90236893,20.3165825 6.90236893,19.6834175 7.29289322,19.2928932 L13.2928932,13.2928932 C13.6714722,12.9143143 14.2810586,12.9010683 14.6757242,13.2628443 L20.6757242,18.7628443 C21.0828438,19.1360383 21.1103467,19.7687271 20.7371527,20.1758467 C20.3639587,20.5829663 19.7312699,20.6104692 19.3241503,20.2372752 L14.0300736,15.3846187 L8.70710678,20.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <a href="{{ route('sms.edit', ['id' => $sms->id]) }}" class="menu-link px-3">ویرایش</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-docs-table-filter="delete_row" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $sms->id }}').submit();">حذف</a>
                                    <form id="delete-form-{{ $sms->id }}" action="{{ route('sms.delete') }}" method="POST" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $sms->id }}">
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
</div>
@endsection

@php
function translateEvent($event) {
    $translations = [
        'order_completed' => 'تکمیل سفارش',
        'order_in_progress' => 'در حال انجام سفارش',
        'order_confirmed' => 'تایید سفارش',
        'order_preparing' => 'آماده سازی سفارش',
        'order_confirmation_code' => 'کد تایید دریافت سفارش',
        'order_delivered' => 'تحویل سفارش',
        'registration' => 'ثبت نام',
        'review_submission' => 'ثبت دیدگاه',
        'order_cancelled' => 'لغو سفارش',
        'user_registration' => 'ثبت نام کاربر',
        'password_change' => 'تغییر رمزعبور کاربر',
    ];

    return $translations[$event] ?? $event;
}
@endphp
