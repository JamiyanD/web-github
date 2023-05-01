<?php

// $success = _exec(
//     "update users set  phone=? where id>?",
//     'si',
//     ['9999', 25],
//     $count
// );
// $success = _exec(
//     "delete from users  where id>?",
//     'i',
//     [32],
//     $count
// );
// $success = _exec(
//     "insert into users set  name=? ,phone=? ",
//     'ss',
//     ['Usukhuu', '1234'],
//     $count
// );

// echo "Amjilttai eseh : $success, oorchlogdson bichlegnii too : $count <br>";

_selectAll(
    $stmt, $count,
    "select id,name,phone from users ",
    $id, $name, $phone
);

echo "<br> niit : $count <br>";

while (_fetch($stmt)) {
    echo "<br>$id, $name, $phone";
}

_close($stmt);
