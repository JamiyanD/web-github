<?php require 'header.php';

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





_select(
    $stmt,
    $count,
    "select id, ognoo, utga, togtmol, turul, hariltsagch, mungu_usuh,
     mungu_buurah, hurungu_usuh, hurungu_buurah, baraa_usuh, baraa_buurah,
      avlaga_usuh, avlaga_buurah, ur_usuh, ur_buurah, orlogo, zardal, zuruu from transaction where create_user_id=? and ognoo>=? and ognoo<? order by ognoo desc ,id desc",
    'iss',
    [
        $_SESSION['id'], $startDate, $endDate
    ],
    $id,
    $ognoo,
    $utga,
    $togtmol,
    $turul,
    $hariltsagch,
    $mungu_usuh,
    $mungu_buurah,
    $hurungu_usuh,
    $hurungu_buurah,
    $baraa_usuh,
    $baraa_buurah,
    $avlaga_usuh,
    $avlaga_buurah,
    $ur_usuh,
    $ur_buurah,
    $orlogo,
    $zardal,
    $zuruu
);

_selectRow(

    "select  sum(mungu_usuh), sum(mungu_buurah) ,sum(hurungu_usuh), sum(hurungu_buurah), sum(baraa_usuh),
     sum(baraa_buurah), sum(avlaga_usuh), sum(avlaga_buurah), sum(ur_usuh), sum(ur_buurah), sum(orlogo),
      sum(zardal)  from transaction  where create_user_id=?",
    "i",
    [
        $_SESSION['id']
    ],
    $smungu_usuh,
    $smungu_buurah,
    $shurungu_usuh,
    $shurungu_buurah,
    $sbaraa_usuh,
    $sbaraa_buurah,
    $savlaga_usuh,
    $savlaga_buurah,
    $sur_usuh,
    $sur_buurah,
    $sorlogo,
    $szardal

);

$active = $smungu_usuh - $smungu_buurah + $shurungu_usuh - $shurungu_buurah + $sbaraa_usuh - $sbaraa_buurah + $savlaga_usuh - $savlaga_buurah;
$passive = $sur_usuh - $sur_buurah + $sorlogo - $szardal

?>
<?php if ($active - $passive == 0) {
    $class = 'badge-soft-success';
    $value = 0;
} else {
    $class = 'badge-warning';
    $value = formatMoney($active - $passive) . ' Энэ утга 0 -ээс ялтгаатай бол буруу байна';
}
?>

<style>
    td,
    th {
        font-size: 10px;
    }
</style>

<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-body">

                <h5 class="card-title">Таны санхүүгийн гүйлгээ Нийт : <span class="badge badge-boxed badge-soft-primary p-2"> <?= $count ?> ш</span> </h5>
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
                    <?php if ($count > 0) : ?>
                        <span class="badge badge-boxed badge-soft-success p-2"> <?= formatMoney($active) ?> </span>
                        <span class="badge badge-boxed badge-soft-danger p-2"> <?= formatMoney($passive) ?> </span>
                        <span class="badge badge-boxed <?= $class ?> p-2"> <?= $value ?> </span>
                    <?php endif ?>
                </div>



                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>

                                <th class="px-0 pl-1">Огноо</th>
                                <th class="px-0 pl-1">Гүйлгээний утга</th>
                                <th class="px-0 pl-1">СБ</th>
                                <th class="px-0 pl-1">Төрөл</th>
                                <th class="px-0 pl-1">Харилцагч</th>
                                <th class="px-0 pl-1 bg-soft-primary ">Мөнгө <i class="fa fa-arrow-up text-success mr-1 font-10"></i></th>
                                <th class="px-0 pl-1 bg-soft-primary">Мөнгө <i class="fa fa-arrow-down text-danger mr-1 font-10"></i></th>
                                <th class="px-0 pl-1 bg-soft-primary">Хөрөнгө <i class="fa fa-arrow-up text-success mr-1 font-10"></i></th>
                                <th class="px-0 pl-1 bg-soft-primary">Хөрөнгө <i class="fa fa-arrow-down text-danger mr-1 font-10"></i></th>
                                <th class="px-0 pl-1 bg-soft-primary">Бараа <i class="fa fa-arrow-up text-success mr-1 font-10"></i></th>
                                <th class="px-0 pl-1 bg-soft-primary">Бараа <i class="fa fa-arrow-down text-danger mr-1 font-10"></i></th>
                                <th class="px-0 pl-1 bg-soft-primary ">Авлага <i class="fa fa-arrow-up text-success mr-1 font-10"></i></th>
                                <th class="px-0 pl-1 bg-soft-primary">Авлага <i class="fa fa-arrow-down text-danger mr-1 font-10"></i></th>
                                <th class="px-0 pl-1 bg-soft-warning">Өр <i class="fa fa-arrow-down text-danger mr-1 font-10"></i></th>
                                <th class="px-0 pl-1 bg-soft-warning">Өр <i class="fa fa-arrow-up text-success mr-1 font-10"></i></th>
                                <th class="px-0 pl-1 bg-soft-warning">Орлого </th class="px-0 pl-1">
                                <th class="px-0 pl-1 bg-soft-warning">Зардал</th class="px-0 pl-1">
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td class="px-0 pl-1"></td>
                                <td class="px-0 pl-1"></td>
                                <td class="px-0 pl-1"></td>
                                <td></td>
                                <td>
                                    Niilber:
                                </td>
                                <td class=""><strong>
                                        <?= formatMoney($smungu_usuh) ?>
                                    </strong>
                                </td>
                                <td><strong>
                                        <?= formatMoney($smungu_buurah) ?> </strong>
                                </td>
                                <td><strong> <?= formatMoney($shurungu_usuh) ?> </strong></td>
                                <td><strong> <?= formatMoney($shurungu_buurah) ?> </strong></td>
                                <td> <strong><?= formatMoney($sbaraa_usuh) ?> </strong></td>
                                <td><strong> <?= formatMoney($sbaraa_buurah) ?> </strong></td>
                                <td> <strong><?= formatMoney($savlaga_usuh) ?> </strong></td>
                                <td> <strong><?= formatMoney($savlaga_buurah) ?> </strong></td>
                                <td><strong> <?= formatMoney($sur_buurah) ?> </strong></td>
                                <td><strong> <?= formatMoney($sur_usuh) ?> </strong></td>

                                <td><strong> <?= formatMoney($sorlogo) ?> </strong></td>
                                <td><strong><?= formatMoney($szardal) ?> </strong></td>

                                <td class="">
                                </td>
                            </tr>
                            <tr>

                                <td class="px-0 pl-1"></td>
                                <td class="px-0 pl-1"></td>
                                <td class="px-0 pl-1"></td>
                                <td></td>
                                <td>
                                    Niilber:
                                </td>
                                <td><strong class="badge badge-boxed badge-success p-2">
                                        <?= formatMoney($smungu_usuh - $smungu_buurah) ?>
                                    </strong>
                                </td>
                                <td>
                                </td>
                                <td><strong class="badge badge-boxed badge-success p-2"> <?= formatMoney($shurungu_usuh - $shurungu_buurah) ?> </strong></td>
                                <td></td>
                                <td> <strong class="badge badge-boxed badge-success p-2"><?= formatMoney($sbaraa_usuh - $sbaraa_buurah) ?> </strong></td>
                                <td></td>
                                <td> <strong class="badge badge-boxed badge-success p-2"><?= formatMoney($savlaga_usuh - $savlaga_buurah) ?> </strong></td>
                                <td></td>
                                <td><strong class="badge badge-boxed badge-danger p-2"> <?= formatMoney($sur_buurah - $sur_usuh) ?> </strong></td>
                                <td></td>

                                <td><strong class="badge badge-boxed badge-danger p-2"> <?= formatMoney($sorlogo - $szardal) ?> </strong></td>
                                <td></td>

                                <td class="">
                                </td>
                            </tr>

                            <form action='/user/record/new' method="post">
                                <tr>

                                    <td class="px-0 pl-1 "><input class="form-control form-control-sm" style="width: 80px;" type="text" id="datepicker" data-date-format="yy/mm/dd" name="ognoo"></td>

                                    <td class="px-0 pl-1"> <input class="form-control form-control-sm" type="text" name="utga" style="width: 150px;" value="" placeholder="Гүйлгээний утга"> </td>
                                    <td class="px-0 pl-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="togtmol" class="custom-control-input" id="customCheck02" data-parsley-multiple="groups" data-parsley-mincheck="2" checked>
                                            <label class="custom-control-label" for="customCheck02"></label>
                                        </div>
                                    </td>
                                    <td class="px-0 pr-1"><input name="turul" placeholder="Төрөл" class="form-control form-control-sm" type="text" value=""></td>
                                    <td class="px-0 pr-1">
                                        <input class="form-control form-control-sm" placeholder="Харилцагч" type="text" name="hariltsagch" value="">
                                    </td>
                                    <td class="px-0 pr-1 ">
                                        <input class="form-control form-control-sm bg-soft-primary" type="text" name="mungu_usuh" value="">
                                    </td>
                                    <td class="px-0 pr-1">
                                        <input class="form-control form-control-sm bg-soft-primary" type="text" name="mungu_buurah" value="">
                                    </td>
                                    <td class="px-0 pr-1"><input class="form-control form-control-sm bg-soft-primary" value="" name="hurungu_usuh" type="text"></td class="px-0 pr-1">
                                    <td class="px-0 pr-1"><input class="form-control form-control-sm bg-soft-primary" value="" name="hurungu_buurah" type="text"></td class="px-0 pr-1">
                                    <td class="px-0 pr-1"><input class="form-control form-control-sm bg-soft-primary" value="" name="baraa_usuh" type="text"></td class="px-0 pr-1">
                                    <td class="px-0 pr-1"><input class="form-control form-control-sm bg-soft-primary" value="" name="baraa_buurah" type="text"></td class="px-0 pr-1">
                                    <td class="px-0 pr-1"><input class="form-control form-control-sm bg-soft-primary" value="" name="avlaga_usuh" type="text"></td class="px-0 pr-1">
                                    <td class="px-0 pr-1"><input class="form-control form-control-sm bg-soft-primary" value="" name="avlaga_buurah" type="text"></td class="px-0 pr-1">
                                    <td class="px-0 pr-1"><input class="form-control form-control-sm bg-soft-warning" value="" name="ur_buurah" type="text"></td>
                                    <td class="px-0 pr-1"><input class="form-control form-control-sm bg-soft-warning" value="" name="ur_usuh" type="text"></td class="px-0 pr-1">

                                    <td class="px-0 pr-1"><input class="form-control form-control-sm bg-soft-warning" value="" name="orlogo" type="text"></td>
                                    <td class="px-0 pr-1">
                                        <input class="form-control form-control-sm bg-soft-warning" type="text" value="" name="zardal">
                                    </td>
                                    <td class="p-0"><button type="submit" class="btn btn-instagram ml-2 mt-2 p-1 btn-sm">
                                            <i class="ti-save "></i>
                                        </button></td>
                                </tr>
                            </form>
                            <?php
                            $rowCount = 0;
                            while (_fetch($stmt)) : $rowCount++;
                                if ($rowCount == 1) {
                                    $suuliinOgnoo = $ognoo;
                                }
                            ?>
                                <tr>

                                    <td class="px-0 pl-1"><?= substr(str_replace('-', '/', $ognoo), 5) ?></td>
                                    <td class="px-0 pl-1"><a href="/user/record/edit?id=<?= $id ?>">
                                            <?php if (!empty($zuruu)) : ?>
                                                <span class="badge badge-boxed <?= $class ?> p-2"> <?= formatMoney($zuruu) ?> </span>
                                                <?php endif ?><?= $utga ?></a></td>
                                    <td class="px-0 pl-1">
                                        <?php if (!empty($togtmol)) : ?>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck02" data-parsley-multiple="groups" data-parsley-mincheck="2" checked>
                                                <label class="custom-control-label" for="customCheck02"></label>
                                            </div>
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <?= $turul ?>
                                    </td>
                                    <td>
                                        <?= $hariltsagch ?>
                                    </td>
                                    <td <?php if ($mungu_usuh > 0) : ?>class="table-success" <?php endif ?>>
                                        <?= formatMoney($mungu_usuh) ?>
                                    </td>
                                    <td <?php if ($mungu_buurah > 0) : ?>class="table-danger" <?php endif ?>>
                                        <?= formatMoney($mungu_buurah) ?>
                                    </td>
                                    <td <?php if ($hurungu_usuh > 0) : ?>class="table-success " <?php endif ?>> <?= formatMoney($hurungu_usuh) ?></td>
                                    <td <?php if ($hurungu_buurah > 0) : ?>class="table-danger" <?php endif ?>> <?= formatMoney($hurungu_buurah) ?></td>
                                    <td <?php if ($baraa_usuh > 0) : ?>class="table-success" <?php endif ?>> <?= formatMoney($baraa_usuh) ?></td>
                                    <td <?php if ($baraa_buurah > 0) : ?>class="table-danger" <?php endif ?>> <?= formatMoney($baraa_buurah) ?></td>
                                    <td <?php if ($avlaga_usuh > 0) : ?>class="table-success" <?php endif ?>> <?= formatMoney($avlaga_usuh) ?></td>
                                    <td <?php if ($avlaga_buurah > 0) : ?>class="table-danger" <?php endif ?>> <?= formatMoney($avlaga_buurah) ?></td>
                                    <td <?php if ($ur_buurah > 0) : ?>class="table-success" <?php endif ?>> <?= formatMoney($ur_buurah) ?></td>
                                    <td <?php if ($ur_usuh > 0) : ?>class="table-danger" <?php endif ?>> <?= formatMoney($ur_usuh) ?></td>

                                    <td <?php if ($orlogo > 0) : ?>class="table-success" <?php endif ?>> <?= formatMoney($orlogo) ?></td>
                                    <td <?php if ($zardal > 0) : ?>class="table-danger" <?php endif ?>><?= formatMoney($zardal) ?></td>

                                    <td class=""> <button onclick="confirmDelete(<?= $id ?>,'<?= $utga ?>')" type="button" class="btn btn-dribbble btn-sm  p-1 ml-1 mt-1">
                                            <i class="ti-trash mr-1 font-10"></i>
                                        </button>
                                        <a onclick="confirmDelete(<?= $id ?>,'<?= $utga ?>')" href="/user/record/delete?id=<?= $id ?>&utga=<?= $utga ?>"></a>
                                    </td>
                                </tr>
                            <?php endwhile ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function confirmDelete(recordId, recordUtga) {
        var ok = confirm("Ta " + recordUtga + " guilgeeg ustgahdaa itgeltei bna uu?");
        if (ok) {
            location = "/user/record/delete?id=" + recordId + "$utga=<?= $utga ?>";
        }
    };

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
        location = "/user/home-filter?year=" + year + "&month=" + month;
    }
</script>
<?php require 'footer.php'; ?>

<script>
    <?php
    if (empty($suuliinOgnoo)) {
        $suuliinOgnoo = "$year-$month-01";
    }
    $token = explode('-', $suuliinOgnoo); ?>
    jQuery('#datepicker').datepicker('setDate', new Date(<?= $token[0] ?>, <?= intval($token[1]) - 1 ?>, <?= $token[2] ?>));
</script>