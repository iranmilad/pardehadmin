import ApexCharts from "apexcharts";

function generateTime() {
    var time = [];
    for (var i = 0; i < 24; i++) {
        time.push(i + ":00");
    }
    return time;
}

if(document.getElementById("view_chart")){
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
    };
    
    
    var chart = new ApexCharts(document.getElementById("view_chart"), options1);
    chart.render();
    
    $(document).on("DOMContentLoaded", () => {
        $.ajax("/api/view-stat", {
            method: "GET",
            success: (data) => {
                chart.updateSeries([
                    {
                        data: data,
                    },
                ]);
            },
        });
    });
    
    $("#dashboard-view-stat").on("change", () => {
        $.ajax("/api/view-stat", {
            method: "GET",
            success: (data) => {
                chart.updateSeries([
                    {
                        data: data,
                    },
                ]);
            },
        });
    });
}

if(document.getElementById("sell_chart")){
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
        colors: ["#8b5cf6"],
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
    
    $("#dashboard-sell-stat").on("change", () => {
        $.ajax("/api/view-stat", {
            method: "GET",
            success: (data) => {
                chart2.updateSeries([
                    {
                        data: data,
                    },
                ]);
            },
        });
    });
    
    
    $(document).on("DOMContentLoaded", () => {
      $.ajax("/api/sell-stat", {
          method: "GET",
          success: (data) => {
            chart2.updateSeries([
                  {
                      data: data,
                  },
              ]);
          },
      });
    });
}
