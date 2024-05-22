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
                <h4 class="text-center">امروز اقساطی برای پرداخت ندارد</h4>
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
                        <tr>
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" name="checked_row" value="1" />
                                </div>
                            </td>
                            <td>
                                <a href="{{route('installment.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">قسط اول سفارش #1212</a>
                            </td>
                            <td>
                                <a href="{{route('installment.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">12/12/1403</a>
                            </td>
                            <td>
                                <a href="{{route('installment.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">12/12/1403</a>
                            </td>
                            <td>
                                <a href="{{route('installment.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">09374039436</a>
                            </td>
                            <td>
                                <a href="{{route('installment.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">درگاه پرداخت</a>
                            </td>
                            <td>
                                <a href="{{route('installment.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">24235123</a>
                            </td>
                            <td class="text-end">
                                <a href="{{route('installment.show',['id' => 1])}}" class="btn btn-light btn-sm">
                                    ویرایش
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <ul class="pagination">
                    <li class="page-item previous disabled"><a href="#" class="page-link"><i class="previous"></i></a></li>
                    <li class="page-item active"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item "><a href="#" class="page-link">3</a></li>
                    <li class="page-item "><a href="#" class="page-link">4</a></li>
                    <li class="page-item "><a href="#" class="page-link">5</a></li>
                    <li class="page-item "><a href="#" class="page-link">6</a></li>
                    <li class="page-item next"><a href="#" class="page-link"><i class="next"></i></a></li>
                </ul>
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
                        <tr>
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" name="checked_row" value="1" />
                                </div>
                            </td>
                            <td>
                                <a href="{{route('installment.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">قسط اول سفارش #1212</a>
                            </td>
                            <td>
                                <a href="{{route('installment.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">12/12/1403</a>
                            </td>
                            <td>
                                <a href="{{route('installment.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">12/12/1403</a>
                            </td>
                            <td>
                                <a href="{{route('installment.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">09374039436</a>
                            </td>
                            <td>
                                <a href="{{route('installment.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">درگاه پرداخت</a>
                            </td>
                            <td>
                                <a href="{{route('installment.show',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">24235123</a>
                            </td>
                            <td class="text-end">
                                <a href="{{route('installment.show',['id' => 1])}}" class="btn btn-light btn-sm">
                                    ویرایش
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <ul class="pagination">
                    <li class="page-item previous disabled"><a href="#" class="page-link"><i class="previous"></i></a></li>
                    <li class="page-item active"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item "><a href="#" class="page-link">3</a></li>
                    <li class="page-item "><a href="#" class="page-link">4</a></li>
                    <li class="page-item "><a href="#" class="page-link">5</a></li>
                    <li class="page-item "><a href="#" class="page-link">6</a></li>
                    <li class="page-item next"><a href="#" class="page-link"><i class="next"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-datedue" role="tabpanel" aria-labelledby="pills-datedue-tab" tabindex="0">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">امروز اقساطی برای پرداخت ندارد</h4>
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