import ApexCharts from "apexcharts";

function generateTime(range) {
    var time = [];
    switch (range) {
        case '3days':
            // Generate hours for the last 3 days (72 hours)
            for (var i = 0; i < 72; i++) {
                time.push((i % 24) + ":00 روز " + Math.floor(i / 24 + 1));
            }
            break;
        case 'week':
            // Generate days for the last week (7 days)
            for (var i = 1; i <= 7; i++) {
                time.push(i + " روز");
            }
            break;
        case 'month':
            // Generate days for the last month (30 days)
            for (var i = 1; i <= 30; i++) {
                time.push(i + " روز");
            }
            break;
        case 'year':
            // Generate months for the last year (12 months)
            for (var i = 1; i <= 12; i++) {
                time.push(i + " ماه");
            }
            break;
        default:
            // Generate hours for today (24 hours)
            for (var i = 0; i < 24; i++) {
                time.push(i + ":00");
            }
            break;
    }
    return time;
}

if (document.getElementById("view_chart")) {
    let options1 = {
        series: [],
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
            categories: generateTime('today'), // Default to 'today'
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
    };

    var chart = new ApexCharts(document.getElementById("view_chart"), options1);
    chart.render();

    function fetchData(range) {
        $.ajax("/view-stat/" + range, {
            method: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                // Update x-axis categories based on the selected range
                chart.updateOptions({
                    xaxis: {
                        categories: generateTime(range),
                    }
                });
                // Update series data
                chart.updateSeries([{
                    data: data,
                }]);
            },
        });
    }

    $(document).on("DOMContentLoaded", () => {
        fetchData('today');
    });

    $("#dashboard-view-stat").on("change", (event) => {
        const selectedRange = event.target.value;
        fetchData(selectedRange);
    });
}


function generateSellTime(range) {
    var time = [];
    switch (range) {
        case '3days':
            // Generate hours for the last 3 days (72 hours)
            for (var i = 0; i < 72; i++) {
                var day = Math.floor(i / 24) + 1;
                var hour = i % 24;
                time.push(`روز ${day} - ${hour}:00`);
            }
            break;
        case 'week':
            // Generate days for the last week (7 days)
            for (var i = 1; i <= 7; i++) {
                time.push(`روز ${i}`);
            }
            break;
        case 'month':
            // Generate days for the last month (30 days)
            for (var i = 1; i <= 30; i++) {
                time.push(`روز ${i}`);
            }
            break;
        case 'year':
            // Generate months for the last year (12 months)
            for (var i = 1; i <= 12; i++) {
                time.push(`ماه ${i}`);
            }
            break;
        default:
            // Generate hours for today (24 hours)
            for (var i = 0; i < 24; i++) {
                time.push(i + ":00");
            }
            break;
    }
    return time;
}

if (document.getElementById("sell_chart")) {
    let options2 = {
        series: [],
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
            categories: generateSellTime('today'), // Default to 'today'
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
    };

    var chart2 = new ApexCharts(document.getElementById("sell_chart"), options2);
    chart2.render();

    function fetchSellData(range) {
        $.ajax("/sell-stat/" + range, {
            method: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                // Update x-axis categories based on the selected range
                chart2.updateOptions({
                    xaxis: {
                        categories: generateSellTime(range),
                    }
                });
                // Update series data
                chart2.updateSeries([{
                    data: data,
                }]);
            },
        });
    }

    $(document).on("DOMContentLoaded", () => {
        fetchSellData('today');
    });

    $("#dashboard-sell-stat").on("change", (event) => {
        const selectedRange = event.target.value;
        fetchSellData(selectedRange);
    });
}
