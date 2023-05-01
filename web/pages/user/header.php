<?php
if ($_SESSION['type'] !== 'user') {
    $_SESSION['errors'] = ["Ta ene huudsiig uzehiin tuld ehleed ooriin erheer nevterne uu"];
    redirect('/sign-in');
};
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title><?= DOMAIN ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body data-topbar="dark" data-layout="horizontal">

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar" style="z-index:900">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->


                    <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-toggle="collapse" data-target="#topnav-menu-content">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>


                    <div class="d-none d-lg-inline-block">
                        <?php
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
                        ?>
                        <strong class="badge badge-boxed badge-dark p-2">Нийт : <?= formatMoney($smungu_usuh - $smungu_buurah + $shurungu_usuh - $shurungu_buurah + $sbaraa_usuh - $sbaraa_buurah + $savlaga_usuh - $savlaga_buurah)  ?></strong>
                        <strong class="badge badge-boxed badge-success p-2">Мөнгө : <?= formatMoney($smungu_usuh - $smungu_buurah  + $sbaraa_usuh - $sbaraa_buurah + $savlaga_usuh - $savlaga_buurah)  ?></strong>
                        <strong class="badge badge-boxed badge-success p-2">Хөрөнгө : <?= formatMoney($shurungu_usuh - $shurungu_buurah)  ?></strong>
                        <strong class="badge badge-boxed badge-danger p-2">Өр : <?= formatMoney($sur_usuh - $sur_buurah)  ?></strong>

                    </div>

                </div>

                <!-- Search input -->
                <div class="search-wrap" id="search-wrap">
                    <div class="search-bar">
                        <input class="search-input form-control" placeholder="Search" />
                        <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                            <i class="mdi mdi-close-circle"></i>
                        </a>
                    </div>
                </div>

                <div class="d-flex">

                    <div class="dropdown d-none d-lg-inline-block">
                        <button type="button" class="btn header-item toggle-search noti-icon waves-effect" data-target="#search-wrap">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                    </div>








                    <div class="dropdown d-none d-lg-inline-block ml-1">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                            <i class="mdi mdi-fullscreen"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block">

                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="/assets/images/users/user-1.jpg" alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ml-1"><?= $_SESSION['name'] ?></span>

                        </button>

                    </div>



                </div>
            </div>
        </header>

        <?php require 'navbar.php' ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <?php if (!empty($_SESSION['errors'])) : ?>
                    <div class="alert alert-danger mb-0" role="alert">
                        <ul class="m-0">
                            <?php foreach ($_SESSION['errors'] as $error); ?>
                            <li style="color:red"><?= $error ?></li>

                        </ul>
                    </div>
                <?php unset($_SESSION['errors']);
                endif; ?>
                <?php if (!empty($_SESSION['messages'])) : ?>
                    <div class="alert alert-primary mb-0" role="alert">
                        <ul class="m-0">
                            <?php foreach ($_SESSION['messages'] as $messsage); ?>
                            <li style="color:red"><?= $messsage ?></li>

                        </ul>
                    </div>
                <?php unset($_SESSION['messages']);
                endif; ?>
                <!-- start page title -->