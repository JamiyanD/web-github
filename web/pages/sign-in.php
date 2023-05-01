<?php

?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Login : Huviin sanhhuu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body class="auth-body-bg">

    <div class="container-fluid">
        <!-- Log In page -->
        <div class="row">
            <div class="col-lg-3 pr-0">
                <div class="card mb-0 shadow-none">
                    <div class="card-body">

                        <h3 class="text-center m-0">
                            <a href="index.html" class="logo logo-admin"><img src="assets/images/logo-sm.png" height="60" alt="logo" class="my-3"></a>
                        </h3>

                        <div class="px-2 mt-2">
                            <h4 class="text-muted font-size-18 mb-2 text-center">Тавтай морил !</h4>
                            <p class="text-muted text-center">Та өөрийн бүртгэлтэй эрхээр нэвтэрнэ үү</p>

                            <form method="post" class="form-horizontal my-4" action="/sign-in-do">

                                <?php if (!empty($_SESSION['errors'])) : ?>
                                    <ul>
                                        <?php foreach ($_SESSION['errors'] as $error); ?>
                                        <li style="color:red"><?= $error ?></li>

                                    </ul>
                                <?php unset($_SESSION['errors']);
                                endif; ?>


                                <div class="form-group">
                                    <label for="username">Утас</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="far fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="phone" value="99882652" name="phone" placeholder="Таны утасны дугаар">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="userpassword">Нууц үг</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon2"><i class="fa fa-key"></i></span>
                                        </div>
                                        <input type="password" class="form-control" id="userpassword" value="1234" name="userpassword" placeholder="Таны нууц үг">
                                    </div>
                                </div>

                                <div class="form-group row mt-4">
                                    <div class="col-sm-6">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="remember" id="customControlInline">
                                            <label class="custom-control-label" for="customControlInline">Намайг сана</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <a href="pages-recoverpw-2.html" class="text-muted font-13"><i class="mdi mdi-lock"></i>Намайг мартсан уу?</a>
                                    </div>
                                </div>

                                <div class="form-group mb-0 row">
                                    <div class="col-12 mt-2">
                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Нэвтрэх <i class="fas fa-sign-in-alt ml-1"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="m-2 text-center bg-light p-4 text-primary">
                            <h4 class="">Танд бүртгэл байхгүй юу ? </h4>
                            <p class="font-size-13"><?= DOMAIN; ?> нэвтрэх эрх нээх</p>
                            <a href="/sign-up" class="btn btn-primary waves-effect waves-light">Үнэгүй бүртгүүлэх</a>
                        </div>
                        <div class="mt-4 text-center">
                            <p class="mb-0">© 2023 <?= DOMAIN; ?> Бүтээсэн<i class="mdi mdi-heart text-danger"></i> Жаяа</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 p-0 vh-100  d-flex justify-content-center">
                <div class="accountbg d-flex align-items-center">
                    <div class="account-title text-center text-white">
                        <h4 class="mt-3 text-white">Welcome To <span class="text-warning">AMEZIA</span> </h4>
                        <h1 class="text-white">Let's Get Started</h1>
                        <p class="mt-3 font-size-14">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod.</p>
                        <div class="border w-25 mx-auto border-warning"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Log In page -->
    </div>



    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <script src="assets/js/app.js"></script>

</body>

</html>