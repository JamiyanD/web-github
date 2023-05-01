<?php

// dd($_POST);
$phone = post('phone', 15);
$password = post('userpassword', 12);

$errors = [];

if (strlen($phone) < 8) {
    $errors[] = "Utasni dugaar buruu baina";
}

if (strlen($password) < 4) {
    $errors[] = "Nuuts ugee zov oruulna uu";
}

if (sizeof($errors) > 0) {
    $_SESSION['errors'] = $errors;
    redirect('/sign-in');
}

_selectRow(

    "select id, name,email,phone from users where phone=? and pass=?",
    'ss',
    [$phone, $password],
    $id,
    $name,
    $email,
    $phone
);

if (!empty($name)) {
    $_SESSION['id'] = $id;
    $_SESSION['name'] = $name;
    $_SESSION['phone'] = $phone;
    $_SESSION['email'] = $email;
    $_SESSION['type'] = 'user';
    redirect('/user/home');
} else {
    $_SESSION['errors'] = ["Tani utas umuu nuuts ug buruu baina"];
    redirect('/sign-in');
}

exit;
