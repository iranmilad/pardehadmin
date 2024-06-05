<!-- USE LIVEWIRE TO GET DATA ON DATE PICKER -->
<!-- USE LIVEWIRE TO GET DATA ON DATE PICKER -->
<!-- USE LIVEWIRE TO GET DATA ON DATE PICKER -->
<!-- USE LIVEWIRE TO GET DATA ON DATE PICKER -->


@extends('layouts.primary')

@section('title', 'گزارش ها')

@section('content')

<div class="row g-5 g-xl-10 mb-10">
    <!--begin::Col-->
    <div class="col-xl-6">
        <!--begin::Chart widget 36-->
        <div class="card card-flush dashboard-card-chart overflow-hidden h-lg-100">
            <!--begin::Header-->
            <div class="card-header pt-5">
                <!--begin::Title-->
                <h3 class="card-title align-items-center flex-row">
                    <span class="card-label fw-bold text-dark tw-whitespace-nowrap">بستانکار</span>
                </h3>
                <!--end::Title-->
                <!--begin::Toolbar-->
                <div class="card-toolbar">
                    <!--begin::Menu-->
                    <input placeholder="انتخاب تاریخ" class="form-select form-control-sm form-select-solid" name="" id="date_picker1">
                    <!--end::Menu-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Header-->
            <!--begin::کارت body-->
            <div class="card-body px-0">
                <!--begin::Chart-->
                <div id="chart1" class="min-h-auto w-100 ps-4 pe-6" style="height: auto"></div>
                <!--end::Chart-->
            </div>
            <!--end::کارت body-->
        </div>
        <!--end::Chart widget 36-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-xl-6">
        <!--begin::Chart widget 36-->
        <div class="card card-flush dashboard-card-chart overflow-hidden h-lg-100">
            <!--begin::Header-->
            <div class="card-header pt-5">
                <!--begin::Title-->
                <h3 class="card-title align-items-center flex-row">
                    <span class="card-label fw-bold text-dark tw-whitespace-nowrap">بدهکار</span>
                </h3>
                <!--end::Title-->
                <!--begin::Toolbar-->
                <div class="card-toolbar">
                    <!--begin::Menu-->
                    <input placeholder="انتخاب تاریخ" class="form-select form-control-sm form-select-solid" name="" id="date_picker2">
                    <!--end::Menu-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Header-->
            <!--begin::کارت body-->
            <div class="card-body px-0">
                <!--begin::Chart-->
                <div id="chart2" class="min-h-auto w-100 ps-4 pe-6" style="height: auto"></div>
                <!--end::Chart-->
            </div>
            <!--end::کارت body-->
        </div>
        <!--end::Chart widget 36-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-xl-6">
        <!--begin::Chart widget 36-->
        <div class="card card-flush dashboard-card-chart overflow-hidden h-lg-100">
            <!--begin::Header-->
            <div class="card-header pt-5">
                <!--begin::Title-->
                <h3 class="card-title align-items-center flex-row">
                    <span class="card-label fw-bold text-dark tw-whitespace-nowrap">آمار فروش</span>
                </h3>
                <!--end::Title-->
                <!--begin::Toolbar-->
                <div class="card-toolbar">
                    <!--begin::Menu-->
                    <input placeholder="انتخاب تاریخ" class="form-select form-control-sm form-select-solid" name="" id="date_picker3">
                    <!--end::Menu-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Header-->
            <!--begin::کارت body-->
            <div class="card-body px-0">
                <!--begin::Chart-->
                <div id="chart3" class="min-h-auto w-100 ps-4 pe-6" style="height: auto"></div>
                <!--end::Chart-->
            </div>
            <!--end::کارت body-->
        </div>
        <!--end::Chart widget 36-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-xl-6">
        <!--begin::Chart widget 36-->
        <div class="card card-flush dashboard-card-chart overflow-hidden h-lg-100">
            <!--begin::Header-->
            <div class="card-header pt-5">
                <!--begin::Title-->
                <h3 class="card-title align-items-center flex-row">
                    <span class="card-label fw-bold text-dark tw-whitespace-nowrap">آمار بازدید</span>
                </h3>
                <!--end::Title-->
                <!--begin::Toolbar-->
                <div class="card-toolbar">
                    <!--begin::Menu-->
                    <input placeholder="انتخاب تاریخ" class="form-select form-control-sm form-select-solid" name="" id="date_picker4">
                    <!--end::Menu-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Header-->
            <!--begin::کارت body-->
            <div class="card-body px-0">
                <!--begin::Chart-->
                <div id="chart4" class="min-h-auto w-100 ps-4 pe-6" style="height: auto"></div>
                <!--end::Chart-->
            </div>
            <!--end::کارت body-->
        </div>
        <!--end::Chart widget 36-->
    </div>
    <!--end::Col-->
</div>

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
        <form method="post" class="" id="action_form">
            <div class="d-flex tw-items-center tw-justify-between tw-w-full gap-4 mb-5">
                <div class="d-flex align-items-center gap-5">
                    <select class="form-select form-select-solid tw-w-max" name="" id="">
                        <option>عملیات</option>
                        <option value="delete">حذف</option>
                    </select>
                    <button class="btn btn-primary" type="submit">اجرا</button>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#filter_collapse">فیلتر</button>
                </div>
            </div>

            <div id="filter_collapse" class="collapse">
                <div class="d-flex align-items-end flex-wrap w-100 gap-10">
                    <div>
                        <label class="form-label" for="">بازه زمانی</label>
                        <input class="form-control form-control-solid" id="filter_date" type="text" placeholder="انتخاب کنید">
                    </div>
                    <div>
                        <label class="form-label" for="">وضعیت</label>
                        <select multiple class="form-select form-select-solid" data-placeholder="انتخاب وضعیت" data-control="select2" name="" id="">
                            <option value="1">در انتظار بررسی</option>
                            <option value="2">درحال بررسی</option>
                            <option value="3">انجام شده</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label" for="">نوع تسویه</label>
                        <select multiple class="form-select form-select-solid" data-placeholder="انتخاب نوع پرداختی" data-control="select2" name="" id="">
                            <option value="1">کارت به کارت</option>
                            <option value="2">درگاه بانکی</option>
                            <option value="3">چک</option>
                        </select>
                    </div>
                    <button type="submit" name="filter" class="btn btn-primary tw-h-max">اجرا</button>
                </div>
            </div>

            <table id="reports_table" class="table gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="w-10px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#reports_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="cursor-pointer px-0 text-start">سفارش</th>
                        <th class="cursor-pointer px-0 text-start">تاریخ</th>
                        <th class="cursor-pointer px-0 text-start">وضعیت</th>
                        <th class="px-0 text-start">مجموع خدمت</th>
                        <th class="px-0 text-start">کمیسیون سایت</th>
                        <th class="px-0 text-start">نوع تسویه</th>
                        <th class="px-0 text-start">شماره سررسید</th>
                        <th class="px-0 text-start">شماره تراکنش</th>
                        <th class="text-end">عملیات</th>
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
                            <span>#12312</span>
                        </td>
                        <td>
                            <span>1400/01/01</span>
                        </td>
                        <td>
                            <span>در انتظار بررسی</span>
                        </td>
                        <td>
                            <span>1000000</span>
                        </td>
                        <td>
                            <span>20000</span>
                        </td>
                        <td>
                            <span>کارت به کارت</span>
                        </td>
                        <td>
                            <span>123456</span>
                        </td>
                        <td>
                            <span>123456</span>
                        </td>
                        <td class="text-end">
                            <a href="{{route('order.show',['id' => 1])}}" class="btn btn-light btn-sm">
                                مشاهده
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <!--end::Group actions-->

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