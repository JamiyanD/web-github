<?php

// dd($_POST);

$username = post('username', 50);
$userpassword = post('userpassword', 45);
$confirmpassword = post('confirmpassword', 45);
$phone = post('phone', 15);
$email = post('email', 150);
$terms = post('terms');

$errors = [];

if (mb_strlen($username) < 4) {
    $errors[] = "Hereglegchiin neriin urt dor hayj 4 usgees togtono";
}
_select(
    $stmt,
    $count,
    "select count(*) from users where phone=?",
    's',
    [$phone],
    $numberOfPhone
);

_fetch($stmt);

if ($numberOfPhone > 0) {
    $errors[] = "$phone utasni dugaar ali hediin burtgeltei bna ";
};
_selectRow(

    "select count(*) from users where email=?",
    's',
    [$email],
    $numberOfEmail
);

_fetch($stmt);

if ($numberOfEmail > 0) {
    $errors[] = "$email tani email ali hediin burtgeltei bna ";
};
if ($userpassword != $confirmpassword) {
    $errors[] = 'Nuuts ug hooroondoo taarahgui baina';
};

if (empty($terms)) {
    $errors[] = "Ta uilchilgeenii nohtsliig unshih shaardlagatai";
}

// dd($_SESSION, true);

if (sizeof($errors) == 0) {
    $success = _exec(
        "insert into users set name=?, pass=?, phone=?, email=?",
        'ssss',
        [$username, $userpassword, $phone, $email],
        $count,
        $insertId
    );

    $_SESSION['name'] = $username;
    $_SESSION['phone'] = $phone;
    $_SESSION['email'] = $email;
    $_SESSION['type'] = 'user';
    $_SESSION['id'] = $insertId;

    redirect('/user/home');
} else {

    $_SESSION['errors'] = $errors;
    // print_r($errors);
    // exit;
    redirect("/sign-up");
}
