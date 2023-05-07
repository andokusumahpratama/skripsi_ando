! function(l) {
    "use strict";

    function r() {}
    r.prototype.respChart = function(r, o, e, a) {
        Chart.defaults.global.defaultFontColor = "#8791af", Chart.defaults.scale.gridLines.color = "rgba(166, 176, 207, 0.1)";
        var t = r.get(0).getContext("2d"),
            n = l(r).parent();

        function i() {
            r.attr("width", l(n).width());
            switch (o) {
                case "Line":
                    new Chart(t, {
                        type: "line",
                        data: e,
                        options: a
                    });
                    break;
                case "Doughnut":
                    new Chart(t, {
                        type: "doughnut",
                        data: e,
                        options: a
                    });
                    break;
                case "Pie":
                    new Chart(t, {
                        type: "pie",
                        data: e,
                        options: a
                    });
                    break;
                case "Bar":
                    new Chart(t, {
                        type: "bar",
                        data: e,
                        options: a
                    });
                    break;
                case "Radar":
                    new Chart(t, {
                        type: "radar",
                        data: e,
                        options: a
                    });
                    break;
                case "PolarArea":
                    new Chart(t, {
                        data: e,
                        type: "polarArea",
                        options: a
                    })
            }
        }
        l(window).resize(i), i()
    }, r.prototype.init = function() {
        this.respChart(l("#lineChart"), "Line", {
            // labels: bulan.map((bulan) => {
            //     return new Date(year, bulan - 1, 1).toLocaleString('default', { month: 'long' });
            //   }),
            labels: waktu,
            // labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October"],
            datasets: [{
                label: 'Grafik Pembayaran',
                fill: !0,
                lineTension: .5,
                backgroundColor: "rgba(85, 110, 230, 0.2)",
                borderColor: "#0f9cf3",
                borderCapStyle: "butt",
                borderDash: [],
                borderDashOffset: 0,
                borderJoinStyle: "miter",
                pointBorderColor: "#0f9cf3",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "#0f9cf3",
                pointHoverBorderColor: "#fff",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
                data: total.map(value => value.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }))
                // data: [65, 59, 80, 81, 56, 55, 40, 55, 30, 80]
            }, 
            // {
            //     label: "Monthly Earnings",
            //     fill: !0,
            //     lineTension: .5,
            //     backgroundColor: "rgba(252, 185, 44, 0.2)",
            //     borderColor: "#fcb92c",
            //     borderCapStyle: "butt",
            //     borderDash: [],
            //     borderDashOffset: 0,
            //     borderJoinStyle: "miter",
            //     pointBorderColor: "#fcb92c",
            //     pointBackgroundColor: "#fff",
            //     pointBorderWidth: 1,
            //     pointHoverRadius: 5,
            //     pointHoverBackgroundColor: "#fcb92c",
            //     pointHoverBorderColor: "#eef0f2",
            //     pointHoverBorderWidth: 2,
            //     pointRadius: 1,
            //     pointHitRadius: 10,
            //     data: [80, 23, 56, 65, 23, 35, 85, 25, 92, 36]
            // }
        ]
        }, {
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(value, index, values) {
                            return value.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                        },
                        max: maxTotal,
                        min: minTotal,
                        stepSize: maxTotal/8
                    }
                }],
            }
        });
        
        this.respChart(l("#bar"), "Bar", {
            // labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
            // labels: bulan.map((bulan) => {
            //     return new Date(year, bulan - 1, 1).toLocaleString('default', { month: 'long' });
            //   }),
            labels: bulan.map((waktu) => {
                return new Date(year, waktu - 1, 1).toLocaleString('default', { month: 'long' });
            }),
            datasets: dataset
        }, {        
            scales: {                
                xAxes: [{
                    barPercentage: .4,                    
                }]
            }, 
                              
        });
                

    }, l.ChartJs = new r, l.ChartJs.Constructor = r
}(window.jQuery),
function() {
    "use strict";
    window.jQuery.ChartJs.init()
}();