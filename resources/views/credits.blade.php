@extends('layouts.primary')

@section('title', 'اقساط')

@section("toolbar")
<a href="{{route('credits.create')}}" class="btn btn-primary">افزودن اقساط برای کاربر</a>
@endsection

@section('content')
<!-- START:TABLE -->
<div class="card">
    <div class="card-body">
        <form class="d-flex align-items-center justify-content-between mb-5" action="" method="get">
            @csrf
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span class="path2"></span></i>
                <input name="s" value="{{ request()->get('s') ?? '' }}" type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid lg:w-250px ps-15" placeholder="جست و جو" />
            </div>
            <button class="btn btn-success tw-w-max" name="export-csv">خروجی csv</button>
        </form>
        <form method="post" class="" id="action_form">
            <div class="d-flex tw-items-center tw-justify-between tw-w-full gap-4 mb-5">
                <div class="d-flex align-items-center gap-5">
                    <select class="form-select form-select-solid tw-w-max" name="action" id="action_select">
                        <option value="">عملیات</option>
                        <option value="delete">حذف</option>
                    </select>
                    <button class="btn btn-primary" type="submit">اجرا</button>
                </div>
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#filter_collapse">فیلتر</button>
            </div>

            <div id="filter_collapse" class="collapse">
                <div class="d-flex align-items-end flex-wrap w-100 gap-10">
                    <div>
                        <label class="form-label" for="filter_date">تاریخ سررسید</label>
                        <input type="text" name="date" placeholder="انتخاب تاریخ" class="form-control form-control-solid" data-jdp>
                    </div>
                    <div>
                        <label class="form-label" for="payment_type">نوع پرداخت</label>
                        <select name="payment_type" id="payment_type" class="form-select form-select-solid">
                            <option value="all" selected>همه</option>
                            <option value="gateway">درگاه پرداخت</option>
                            <option value="in_person">حضوری</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label" for="is_paid">پرداخت شده</label>
                        <select name="is_paid" id="is_paid" class="form-select form-select-solid">
                            <option value="all" selected>همه</option>
                            <option value="yes">بله</option>
                            <option value="no">خیر</option>
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit">اجرا</button>
                </div>
            </div>

            <table id="credits_table" class="table gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="w-10px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#credits_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="cursor-pointer px-0 text-start">عنوان</th>
                        <th class="cursor-pointer px-0 text-start">تاریخ سر رسید</th>
                        <th class="cursor-pointer px-0 text-start">تاریخ پرداخت</th>
                        <th class="cursor-pointer px-0 text-start">شماره تلفن کاربر</th>
                        <th class="cursor-pointer px-0 text-start">نوع پرداخت</th>
                        <th class="cursor-pointer px-0 text-start">کد رهگیری</th>
                        <th class="min-w-100px text-end">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($credits as $credit)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="checked_row[]" value="{{ $credit->id }}" />
                            </div>
                        </td>
                        <td>
                            <a href="{{route('credits.edit',['id' => $credit->id])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">{{ $credit->order->customer_name .' شماره قسط '.$credit->id  }}</a>
                        </td>
                        <td>
                            <a href="{{route('credits.edit',['id' => $credit->id])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">{{ $credit->getDueDateShamsiAttribute() }}</a>
                        </td>
                        <td>
                            <a href="{{route('credits.edit',['id' => $credit->id])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">{{ $credit->payment_date ? \Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($credit->payment_date))->format('Y/m/d') : '---' }}</a>
                        </td>
                        <td>
                            <a href="{{route('credits.edit',['id' => $credit->id])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">{{ $credit->user->mobile }}</a>
                        </td>
                        <td>
                            <a href="{{route('credits.edit',['id' => $credit->id])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">{{ $credit->payment->status ?? 'عدم پرداخت' }}</a>
                        </td>
                        <td>
                            <a href="{{route('credits.edit',['id' => $credit->id])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">{{ $credit->payment->reference_id ?? ''}}</a>
                        </td>
                        <td class="text-end">
                            <a href="{{route('credits.edit',['id' => $credit->id])}}" class="btn btn-light btn-sm">
                                ویرایش
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
        <!--end::Group actions-->

        {{ $credits->links() }}
    </div>
</div>
<!-- END:TABLE -->
@endsection

@section('script-before')
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('plugins/jalalidatepicker.min.js')}}"></script>
@endsection

@section("scripts")
<script>
jalaliDatepicker.startWatch();
</script>
@endsection
