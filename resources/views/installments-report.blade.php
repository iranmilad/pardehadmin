```blade
@extends('layouts.primary')

@section('title', 'گزارش اقساط')

@section('content')

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <a href="#pills-today-installments" class="nav-link active" id="pills-today-installments-tab" data-bs-toggle="pill" type="button" role="tab" aria-controls="pills-today-installments" aria-selected="true">اقساط امروز</a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="#pills-next-week" class="nav-link" id="pills-next-week-tab" data-bs-toggle="pill" type="button" role="tab" aria-controls="pills-next-week" aria-selected="false">اقساط هفته جاری</a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="#pills-datedue" class="nav-link" id="pills-datedue-tab" data-bs-toggle="pill" type="button" role="tab" aria-controls="pills-datedue" aria-selected="false">اقساط عقب افتاده</a>
    </li>
</ul>

<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-today-installments" role="tabpanel" aria-labelledby="pills-today-installments-tab" tabindex="0">
        <div class="card">
            <div class="card-body">

                <table id="installments_table" class="table gy-5 gs-7">
                    <thead>
                        <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                            <th class="w-10px">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#installments_table .form-check-input" value="1" />
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
                        @forelse($todayInstallments as $installment)
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="checked_row" value="{{ $installment->id }}" />
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('credits.edit', ['id' => $installment->id]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">{{ $installment->order->customer_name .' شماره قسط '.$installment->id }}</a>
                                </td>
                                <td>
                                    <span class="text-gray-800 fs-6 fw-bolder mb-1">{{ $installment->due_date_shamsi }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fs-6 fw-bolder mb-1">{{ $installment->payment->payedDateShamsi ?? '' }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fs-6 fw-bolder mb-1">{{ $installment->user->mobile }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fs-6 fw-bolder mb-1">{{ $installment->payment->payment_method ?? '' }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fs-6 fw-bolder mb-1">{{ $installment->payment->ref_id ?? '' }}</span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('credits.edit', ['id' => $installment->id]) }}" class="btn btn-light btn-sm">ویرایش</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">اقساطی برای نمایش وجود ندارد</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $todayInstallments->links() }}
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="pills-next-week" role="tabpanel" aria-labelledby="pills-next-week-tab" tabindex="0">
        <div class="card">
            <div class="card-body">
                <table id="installments_table" class="table gy-5 gs-7">
                    <thead>
                        <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                            <th class="w-10px">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#installments_table .form-check-input" value="1" />
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
                        @forelse($nextWeekInstallments as $installment)
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="checked_row" value="{{ $installment->id }}" />
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('credits.edit', ['id' => $installment->id]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">{{ $installment->order->customer_name .' شماره قسط '.$installment->id }}</a>
                                </td>
                                <td>
                                    <span class="text-gray-800 fs-6 fw-bolder mb-1">{{ $installment->due_date_shamsi }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fs-6 fw-bolder mb-1">{{ $installment->payment->payedDateShamsi ?? '' }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fs-6 fw-bolder mb-1">{{ $installment->user->mobile }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fs-6 fw-bolder mb-1">{{ $installment->payment->payment_method ?? '' }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fs-6 fw-bolder mb-1">{{ $installment->payment->ref_id ?? '' }}</span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('credits.edit', ['id' => $installment->id]) }}" class="btn btn-light btn-sm">ویرایش</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">اقساطی برای نمایش وجود ندارد</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $nextWeekInstallments->links() }}
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="pills-datedue" role="tabpanel" aria-labelledby="pills-datedue-tab" tabindex="0">
        <div class="card">
            <div class="card-body">
                <table id="installments_table" class="table gy-5 gs-7">
                    <thead>
                        <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                            <th class="w-10px">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#installments_table .form-check-input" value="1" />
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
                        @forelse($datedueInstallments as $installment)
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="checked_row" value="{{ $installment->id }}" />
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('credits.edit', ['id' => $installment->id]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">{{ $installment->order->customer_name .' شماره قسط '.$installment->id }}</a>
                                </td>
                                <td>
                                    <span class="text-gray-800 fs-6 fw-bolder mb-1">{{ $installment->due_date_shamsi }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fs-6 fw-bolder mb-1">{{ $installment->payment->payedDateShamsi ?? '' }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fs-6 fw-bolder mb-1">{{ $installment->user->mobile }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fs-6 fw-bolder mb-1">{{ $installment->payment->payment_method ?? '' }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fs-6 fw-bolder mb-1">{{ $installment->payment->ref_id ?? '' }}</span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('credits.edit', ['id' => $installment->id]) }}" class="btn btn-light btn-sm">ویرایش</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">اقساطی برای نمایش وجود ندارد</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $datedueInstallments->links() }}
            </div>
        </div>
    </div>
</div>


@endsection

@section("scripts")
<script>
    $(document).ready(function() {
        // Function to show the tab based on the hash in the URL
        function showTabFromHash() {
            var hash = window.location.hash;
            if (hash) {
                var tabTrigger = new bootstrap.Tab($('a[href="' + hash + '"]')[0]);
                tabTrigger.show();
            }
        }

        // Show the tab on initial load
        showTabFromHash();

        // Update the URL hash and show the tab when a tab is clicked
        $('.nav-pills a').on('click', function(e) {
            var newHash = $(this).attr('href');
            if (history.pushState) {
                history.pushState(null, null, newHash);
            } else {
                location.hash = newHash;
            }

            var tabTrigger = new bootstrap.Tab(this);
            tabTrigger.show();
        });

        // Listen for hash change events and show the corresponding tab
        $(window).on('hashchange', function() {
            showTabFromHash();
        });
    });
</script>
@endsection
