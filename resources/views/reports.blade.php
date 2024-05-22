<!-- USE LIVEWIRE TO GET DATA ON DATE PICKER -->
<!-- USE LIVEWIRE TO GET DATA ON DATE PICKER -->
<!-- USE LIVEWIRE TO GET DATA ON DATE PICKER -->
<!-- USE LIVEWIRE TO GET DATA ON DATE PICKER -->


@extends('layouts.primary')

@section('title', 'گزارش ها')

@section('content')

<div class="row g-5 g-xl-10 ">
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
@endsection

@section("script-before")
<script src="{{asset('plugins/flatpicker_fa.js')}}"></script>
<script src="{{asset('plugins/jdate.min.js')}}"></script>
@endsection

@section("scripts")
<script>
    window.Date = window.JDate;

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