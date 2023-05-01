<?php require ROOT . '/pages/user/header.php'; ?>

<div class="w-100">
    <div class="card">
        <div class="card-body">
            <div class="chartjs-size-monitor">
                <div class="chartjs-size-monitor-expand">
                    <div class=""></div>
                </div>
                <div class="chartjs-size-monitor-shrink">
                    <div class=""></div>
                </div>
            </div>
            <h5 class="card-title">Line Chart</h5>
            <p class="card-title-desc d-inline-block text-truncate w-100">A line chart is a way of plotting data
                points on a line. Often, it is used to show trend data, and the
                comparison of two data sets.
            </p>
            <canvas id="lineChart" height="468" width="w-100" style="display: block; height: 300px; width: 733px;" class="chartjs-render-monitor"></canvas>
        </div>
    </div>
</div>

<?php require ROOT . '/pages/user/footer.php' ?>

<script>
    var lineChart = {
        labels: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
        ],
        datasets: [{
                label: "Conversion Rate",
                fill: false,
                backgroundColor: "#4eb7eb",
                borderColor: "#4eb7eb",
                data: [44, 60, -33, 58, -4, 57, -89, 60, -33, 58],
            },
            {
                label: "Average Sale Value",
                fill: false,
                backgroundColor: "#e3eaef",
                borderColor: "#e3eaef",
                borderDash: [5, 5],
                data: [-68, 41, 86, -49, 2, 65, -64, 86, -49, 2],
            },
        ],
    };

    var lineOpts = {
        responsive: true,
        // title:{
        //     display:true,
        //     text:'Chart.js Line Chart'
        // },
        tooltips: {
            mode: "index",
            intersect: false,
        },
        hover: {
            mode: "nearest",
            intersect: true,
        },
        scales: {
            xAxes: [{
                display: true,
                // scaleLabel: {
                //     display: true,
                //     labelString: 'Month'
                // },
                gridLines: {
                    color: "rgba(0,0,0,0.1)",
                },
            }, ],
            yAxes: [{
                gridLines: {
                    color: "rgba(255,255,255,0.05)",
                    fontColor: "#fff",
                },
                ticks: {
                    max: 100,
                    min: -100,
                    stepSize: 20,
                },
            }, ],
        },
    };

    window.jQuery.ChartJs.respChart($("#lineChart"), "Line", lineChart, lineOpts);
</script>