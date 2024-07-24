@extends('layouts.primary')

@section('title', 'گزارش ها')

@section('content')

<!-- START:TABLE -->
<div class="card">
    <div class="card-body">
        <form class="d-flex align-items-center justify-content-between mb-5" action="" method="get">
            @csrf
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span class="path2"></span></i>
                <input name="s" value="{{ request()->get('s') ?? '' }}" type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="جست و جو" />
            </div>
            <div>
                <button type="submit" name="export_csv" class="btn btn-success">خروجی csv</button>
            </div>
        </form>
        <form action="{{ route('settlement_documents.index') }}" method="get">
            <div id="filter_collapse" class="collapse mb-4">
                <div class="d-flex align-items-end flex-wrap w-100 gap-10">
                    <div>
                        <label class="form-label" for="filter_date">بازه زمانی</label>
                        <input class="form-control form-control-solid" id="filter_date" name="filter_date" type="text" placeholder="انتخاب کنید">
                    </div>
                    <div>
                        <label class="form-label" for="status">وضعیت</label>
                        <select multiple class="form-select form-select-solid" data-placeholder="انتخاب وضعیت" data-control="select2" name="status[]" id="status">
                            <option value="pending">در انتظار بررسی</option>
                            <option value="in_progress">درحال بررسی</option>
                            <option value="completed">انجام شده</option>
                            <option value="canceled">لفو شده</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label" for="document_type">نوع سند</label>
                        <select multiple class="form-select form-select-solid" data-placeholder="انتخاب نوع سند" data-control="select2" name="document_type[]" id="document_type">
                            <option value="debit">بدهکار</option>
                            <option value="credit">بستانکار</option>
                        </select>
                    </div>
                    <button type="submit" name="filter" class="btn btn-primary tw-h-max">اجرا</button>
                </div>
            </div>
        </form>

        <form method="post" class="" id="action_form" action="{{ route('settlement_documents.bulk_delete') }}">
            @csrf
            <div class="d-flex tw-items-center tw-justify-between tw-w-full gap-4 mb-5">
                <div class="d-flex align-items-center gap-5">
                    <select class="form-select form-select-solid tw-w-max" name="action" id="action_select">
                        <option>عملیات</option>
                        <option value="delete">حذف</option>
                    </select>
                    <button class="btn btn-primary" type="submit">اجرا</button>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#filter_collapse">فیلتر</button>
                </div>
            </div>

            <table id="settlement_documents_table" class="table gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="w-10px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#settlement_documents_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="cursor-pointer px-0 text-start">شماره درخواست</th>
                        <th class="cursor-pointer px-0 text-start">تاریخ</th>
                        <th class="cursor-pointer px-0 text-start">وضعیت</th>
                        <th class="px-0 text-start">مجموع خدمت</th>
                        <th class="px-0 text-start">کمیسیون سایت</th>
                        <th class="px-0 text-start">نوع سند</th>
                        <th class="px-0 text-start">شماره حساب</th>
                        <th class="px-0 text-start">شماره تراکنش</th>
                        <th class="text-end">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($settlement_documents as $document)
                        <tr>
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" name="checked_rows[]" value="{{ $document->id }}" />
                                </div>
                            </td>
                            <td>
                                <span><a href="{{ route('settlement_documents.edit',['settlement_document' => $document->id]) }}"># {{$document->id }}</a></span>
                            </td>
                            <td>
                                <span>{{ jdate($document->date)->format('Y/m/d') }}</span>
                            </td>
                            <td>
                                <span>{{ $statusTranslations[$document->status] }}</span>
                            </td>
                            <td>
                                <span>{{ number_format($document->service_total) }}</span>
                            </td>
                            <td>
                                <span>{{ number_format($document->site_commission) }}</span>
                            </td>
                            <td>
                                <span>{{ $documentTypeTranslations[$document->document_type] }}</span>
                            </td>
                            <td>
                                <span>{{ $document->account_number }}</span>
                            </td>
                            <td>
                                <span>{{ $document->transaction_number }}</span>
                            </td>
                            <td class="text-end">
                                <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                    عملیات
                                    <span class="svg-icon fs-5 m-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                            </g>
                                        </svg>
                                    </span>
                                </a>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="{{ route('settlement_documents.edit', ['settlement_document' => $document->id]) }}" class="menu-link px-3">
                                            ویرایش
                                        </a>
                                    </div>
                                    <!--end::Menu item-->

                                </div>
                                <!--end::Menu-->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>

        <!--end::Group actions-->

        <ul class="pagination">
            {{ $settlement_documents->links("vendor.pagination.custom-pagination") }}
        </ul>
    </div>
</div>
<!-- END:TABLE -->

@endsection


@section("script-before")
<script src="{{asset('plugins/flatpicker_fa.js')}}"></script>
<script src="{{asset('plugins/jdate.min.js')}}"></script>
@endsection

@section("scripts")
    <script>
        window.Date = window.JDate;

        flatpickr = $("#filter_date").flatpickr({
            disableMobile: "true",
            altInput: true,
            altFormat: "Y-m-d",
            dateFormat: "Y-m-d",
            locale: "fa",
            mode: "range"
        })

        $("#date_picker1").flatpickr({
            disableMobile: "true",
            altInput: true,
            altFormat: "Y-m-d",
            dateFormat: "Y-m-d",
            locale: "fa",
            defaultDate: ["today", "today"],
            mode: "range",
            onChange: function(selectedDates, dateStr, instance) {
                // DO LIVEWIRE
            }
        })

        $("#date_picker2").flatpickr({
            disableMobile: "true",
            altInput: true,
            altFormat: "Y-m-d",
            dateFormat: "Y-m-d",
            locale: "fa",
            defaultDate: ["today", "today"],
            mode: "range",
            onChange: function(selectedDates, dateStr, instance) {
                // DO LIVEWIRE
            }
        })

        $("#date_picker3").flatpickr({
            disableMobile: "true",
            altInput: true,
            altFormat: "Y-m-d",
            dateFormat: "Y-m-d",
            locale: "fa",
            defaultDate: ["today", "today"],
            mode: "range",
            onChange: function(selectedDates, dateStr, instance) {
                // DO LIVEWIRE
            }
        })

        $("#date_picker4").flatpickr({
            disableMobile: "true",
            altInput: true,
            altFormat: "Y-m-d",
            dateFormat: "Y-m-d",
            locale: "fa",
            defaultDate: ["today", "today"],
            mode: "range",
            onChange: function(selectedDates, dateStr, instance) {
                // DO LIVEWIRE
            }
        })

        function generateTime() {
            var time = [];
            for (var i = 0; i < 24; i++) {
                time.push(i + ":00");
            }
            return time;
        }

        document.addEventListener("DOMContentLoaded", function() {
            let chart1 = new ApexCharts(document.getElementById("chart1"), {
                series: [{
                    data: [100, 80, 70, 90, 50, 40, 30, 20]
                }],
                chart: {
                    height: 350,
                    type: "area",
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: "smooth",
                },
                colors: ["#14b8a6"],
                xaxis: {
                    type: "category",
                    // set fromt 00 to 24
                    categories: generateTime(),
                    tooltip: {
                        enabled: false,
                    },
                    tickAmount: 6,
                    tickPlacement: "on",
                    labels: {
                        show: true,
                        rotate: 0,
                    },
                },
                yaxis: {
                    labels: {
                        show: true,
                        offsetX: -10,
                    },
                },
                tooltip: {
                    x: {
                        format: "dd/MM/yy HH:mm",
                    },
                    y: {
                        title: {
                            formatter: (seriesName) => " تعداد ",
                        },
                    },
                },
            })
            chart1.render();

            let chart2 = new ApexCharts(document.getElementById("chart2"), {
                series: [{
                    data: [100, 80, 70, 90, 50, 40, 30, 20]
                }],
                chart: {
                    height: 350,
                    type: "area",
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: "smooth",
                },
                colors: ["#8b5cf6"],
                xaxis: {
                    type: "category",
                    // set fromt 00 to 24
                    categories: generateTime(),
                    tooltip: {
                        enabled: false,
                    },
                    tickAmount: 6,
                    tickPlacement: "on",
                    labels: {
                        show: true,
                        rotate: 0,
                    },
                },
                yaxis: {
                    labels: {
                        show: true,
                        offsetX: -10,
                    },
                },
                tooltip: {
                    x: {
                        format: "dd/MM/yy HH:mm",
                    },
                    y: {
                        title: {
                            formatter: (seriesName) => " تعداد ",
                        },
                    },
                },
            })
            chart2.render();

            let chart3 = new ApexCharts(document.getElementById("chart3"), {
                series: [{
                    data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
                }],
                chart: {
                    height: 350,
                    type: "area",
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: "smooth",
                },
                colors: ["#0ea5e9"],
                xaxis: {
                    type: "category",
                    // set fromt 00 to 24
                    categories: generateTime(),
                    tooltip: {
                        enabled: false,
                    },
                    tickAmount: 6,
                    tickPlacement: "on",
                    labels: {
                        show: true,
                        rotate: 0,
                    },
                },
                yaxis: {
                    labels: {
                        show: true,
                        offsetX: -10,
                    },
                },
                tooltip: {
                    x: {
                        format: "dd/MM/yy HH:mm",
                    },
                    y: {
                        title: {
                            formatter: (seriesName) => " فروش ",
                        },
                    },
                },
            })
            chart3.render();

            let chart4 = new ApexCharts(document.getElementById("chart4"), {
                series: [{
                    data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
                }],
                chart: {
                    height: 350,
                    type: "area",
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: "smooth",
                },
                colors: ["#1e293b"],
                xaxis: {
                    type: "category",
                    // set fromt 00 to 24
                    categories: generateTime(),
                    tooltip: {
                        enabled: false,
                    },
                    tickAmount: 6,
                    tickPlacement: "on",
                    labels: {
                        show: true,
                        rotate: 0,
                    },
                },
                yaxis: {
                    labels: {
                        show: true,
                        offsetX: -10,
                    },
                },
                tooltip: {
                    x: {
                        format: "dd/MM/yy HH:mm",
                    },
                    y: {
                        title: {
                            formatter: (seriesName) => " بازدید ",
                        },
                    },
                },
            })
            chart4.render();
        })
    </script>
@endsection
