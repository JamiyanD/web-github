<?php require ROOT . '/pages/user/header.php';

$month = get('month', 2);
$year = get('year', 4);


if (!empty($_SESSION['year'])) {
    $year = $_SESSION['year'];
} else {
    $year = date('Y');
}


if (!empty($_SESSION['month'])) {
    $month = $_SESSION['month'];
} else {
    $month = date('m');
}

$_SESSION['year'] = $year;
$_SESSION['month'] = $month;





$startDate = "$year-$month-01";
$nextYear = $year;
$nextMonth = $month + 1;
if ($nextMonth == 13) {
    $nextMonth = 1;
    $nextYear++;
}
$endDate = "$nextYear-$nextMonth-01";










?>




<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-body">

                <h5 class="card-title">Таны мөнгөний үзүүлэлт : <span class="badge badge-boxed badge-soft-success p-2"> <?= $month ?> сар</span> </h5>
                <div class="mb-2">
                    <div class="btn-group  mr-1">
                        <button class="btn btn-primary btn-sm" type="button">
                            <span id="year"><?= $year ?></span>
                        </button>
                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu">
                            <?php foreach (range(2016, 2030) as $valueYear) : ?>
                                <a class="dropdown-item" href="javascript::void();" onclick="chooseYear(<?= $valueYear ?>)"><?= $valueYear ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="btn-group  mr-1">
                        <button class="btn btn-primary btn-sm" type="button">
                            <span id="month"><?= $month ?></span>
                        </button>
                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu">
                            <?php foreach (range(1, 12) as $valueMonth) : ?>
                                <a class="dropdown-item" href="javascript::void();" onclick="chooseMonth(<?= $valueMonth ?>)"><?= $valueMonth ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary btn-sm mr-3 text-white" onclick="filterTransaction()">Шүүх</button>
                    <canvas id="lineChart" height="468" width="w-100" style="display: block; height: 300px; width: 733px;" class="chartjs-render-monitor"></canvas>





                </div>
            </div>
        </div>
    </div>


    <script>
        let year = <?= $year ?>;
        let month = <?= $month ?>;

        function chooseYear(value) {
            year = value
            console.log(year)
            document.getElementById("year").innerHTML = value

        }

        function chooseMonth(value) {

            month = value
            console.log(month)
            document.getElementById("month").innerHTML = value

        }

        function filterTransaction() {
            location = "/user/graph/mungu-filter?year=" + year + "&month=" + month;
        }
    </script>
    <?php require ROOT . '/pages/user/footer.php'; ?>




    <script>
        <?php
        _select(
            $stmt,
            $count,
            "select  day(ognoo) as ognoo, sum(mungu_usuh) as mungu_usuh, sum(mungu_buurah) as mungu_buurah, sum(mungu_usuh-mungu_buurah) as mungu from transaction where create_user_id=? and ognoo>=? and ognoo<? group by ognoo order by ognoo desc ,id desc",
            'iss',
            [
                $_SESSION['id'], $startDate, $endDate
            ],
            $day,
            $mungu_usuh,
            $mungu_buurah,
            $sum_mungu
        );
        $labels = [];
        $labels = [];
        $labels = [];
        $mungu = [];
        $zardal = [];
        while (_fetch($stmt)) {
            $labels[] = $day;
            $mungu[] = $sum_mungu;
            $zardal[] = $mungu_buurah;
        }


        ?>
        var lineChart = {
            labels: [
                <?php
                foreach ($labels as $label) {
                    echo '"' . $label . '",';
                }
                ?>
            ],
            datasets: [{
                    label: "Мөнгөний үзүүлэлт",
                    fill: false,
                    backgroundColor: "#4eb7eb",
                    borderColor: "#4eb7eb",
                    data: [
                        <?php
                        $sum = 0;
                        foreach ($mungu as $value) {
                            $sum += intval($value);
                            echo '"' . $sum . '",';
                        }
                        ?>
                    ],
                },
                {
                    label: "Зардал",
                    fill: false,
                    backgroundColor: "#e3eaef",
                    borderColor: "#e3eaef",
                    borderDash: [5, 5],
                    data: [
                        <?php
                        foreach ($zardal as $value) {
                            echo '"' . $value . '",';
                        }
                        ?>
                    ],
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
                        max: 20000000,
                        min: -0,
                        stepSize: 1000000,
                    },
                }, ],
            },
        };

        window.jQuery.ChartJs.respChart($("#lineChart"), "Line", lineChart, lineOpts);
    </script>