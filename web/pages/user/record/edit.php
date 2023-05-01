<?php require ROOT . '/pages/user/header.php';

$id = get('id', 10);


?>

<?php
_selectRow(

    "select id, ognoo, utga, togtmol, turul, hariltsagch, mungu_usuh, mungu_buurah, hurungu_usuh
    , hurungu_buurah, baraa_usuh, baraa_buurah, avlaga_usuh
    , avlaga_buurah, ur_usuh, ur_buurah, orlogo, zardal from transaction where id=? and create_user_id=?",
    'ii',
    [$id,  $_SESSION['id']],
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

);

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

                <h5 class="card-title">Таны санхүүгийн гүйлгээ</h5>
                <p class="card-title-desc">
                    Use <code>.table-striped</code> to add zebra-striping to any table row
                    within the <code>&lt;tbody&gt;</code>.
                </p>
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>

                                <th class="px-0 pl-1">Огноо</th class="px-0 pl-1">
                                <th class="px-0 pl-1">Гүйлгээний утга</th class="px-0 pl-1">
                                <th class="px-0 pl-1">СБ</th class="px-0 pl-1">
                                <th class="px-0 pl-1">Төрөл</th class="px-0 pl-1">
                                <th class="px-0 pl-1">Харилцагч</th class="px-0 pl-1">
                                <th class="px-0 pl-1">Мөнгө <i class="fa fa-arrow-up text-success mr-1 font-10"></i></th class="px-0 pl-1">
                                <th class="px-0 pl-1">Мөнгө <i class="fa fa-arrow-down text-danger mr-1 font-10"></i></th class="px-0 pl-1">
                                <th class="px-0 pl-1">Хөрөнгө <i class="fa fa-arrow-up text-success mr-1 font-10"></i></th class="px-0 pl-1">
                                <th class="px-0 pl-1">Хөрөнгө <i class="fa fa-arrow-down text-danger mr-1 font-10"></i></th class="px-0 pl-1">
                                <th class="px-0 pl-1">Бараа <i class="fa fa-arrow-up text-success mr-1 font-10"></i></th class="px-0 pl-1">
                                <th class="px-0 pl-1">Бараа <i class="fa fa-arrow-down text-danger mr-1 font-10"></i></th class="px-0 pl-1">
                                <th class="px-0 pl-1">Авлага <i class="fa fa-arrow-up text-success mr-1 font-10"></i></th class="px-0 pl-1">
                                <th class="px-0 pl-1">Авлага <i class="fa fa-arrow-down text-danger mr-1 font-10"></i></th class="px-0 pl-1">
                                <th class="px-0 pl-1">Өр <i class="fa fa-arrow-down text-danger mr-1 font-10"></i></th class="px-0 pl-1">
                                <th class="px-0 pl-1">Өр <i class="fa fa-arrow-up text-success mr-1 font-10"></i></th class="px-0 pl-1">
                                <th class="px-0 pl-1">Орлого </th class="px-0 pl-1">
                                <th class="px-0 pl-1">Зардал</th class="px-0 pl-1">
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action='/user/record/edit-save?id=<?= $id ?>' method="post">
                                <tr>

                                    <td class="px-0 pl-1 "><input class="form-control form-control-sm" type="text" id="datepicker" value="<?= $ognoo ?>" data-date-format="yyyy-mm-dd" name="ognoo"></td>
                                    <td class="px-0 pl-1"> <input class="form-control form-control-sm" type="text" name="utga" style="width: 200px;" value="<?= $utga ?>"> </td>
                                    <td class="px-0 pl-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="togtmol" <?php if (!empty($togtmol)) : ?> checked <?php endif ?> class="custom-control-input" id="customCheck02" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                            <label class="custom-control-label" for="customCheck02"></label>
                                        </div>
                                    </td>
                                    <td class="px-0 pr-1"><input name="turul" class="form-control form-control-sm" type="text" value="<?= $turul ?>"></td>
                                    <td class="px-0 pr-1">
                                        <input class="form-control form-control-sm" type="text" name="hariltsagch" value="<?= $hariltsagch ?>">
                                    </td>
                                    <td class="px-0 pr-1">
                                        <input class="form-control form-control-sm" type="text" name="mungu_usuh" value="<?= $mungu_usuh ?>">
                                    </td>
                                    <td class="px-0 pr-1">
                                        <input class="form-control form-control-sm" type="text" name="mungu_buurah" value="<?= $mungu_buurah ?>">
                                    </td>
                                    <td class="px-0 pr-1"><input class="form-control form-control-sm" value="<?= $hurungu_usuh ?>" name="hurungu_usuh" type="text"></td class="px-0 pr-1">
                                    <td class="px-0 pr-1"><input class="form-control form-control-sm" value="<?= $hurungu_buurah ?>" name="hurungu_buurah" type="text"></td class="px-0 pr-1">
                                    <td class="px-0 pr-1"><input class="form-control form-control-sm" value="<?= $baraa_usuh ?>" name="baraa_usuh" type="text"></td class="px-0 pr-1">
                                    <td class="px-0 pr-1"><input class="form-control form-control-sm" value="<?= $baraa_buurah ?>" name="baraa_buurah" type="text"></td class="px-0 pr-1">
                                    <td class="px-0 pr-1"><input class="form-control form-control-sm" value="<?= $avlaga_usuh ?>" name="avlaga_usuh" type="text"></td class="px-0 pr-1">
                                    <td class="px-0 pr-1"><input class="form-control form-control-sm" value="<?= $avlaga_buurah ?>" name="avlaga_buurah" type="text"></td class="px-0 pr-1">
                                    <td class="px-0 pr-1"><input class="form-control form-control-sm" value="<?= $ur_buurah ?>" name="ur_buurah" type="text"></td>
                                    <td class="px-0 pr-1"><input class="form-control form-control-sm" value="<?= $ur_usuh ?>" name="ur_usuh" type="text"></td class="px-0 pr-1">

                                    <td class="px-0 pr-1"><input class="form-control form-control-sm" value="<?= $orlogo ?>" name="orlogo" type="text"></td>
                                    <td class="px-0 pr-1">
                                        <input class="form-control form-control-sm" type="text" value="<?= $zardal ?>" name="zardal">
                                    </td>
                                    <td class=""><button type="submit" class="btn btn-instagram ml-1 btn-sm">
                                            <i class="ti-save mr-1font-10"></i>
                                        </button></td>
                                </tr>
                            </form>






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
    }
</script>
<?php require ROOT . '/pages/user/footer.php'; ?>