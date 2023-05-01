<?php

@$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (mysqli_connect_errno() === 1049) {
    // die('Iim nertei baaz bhgui');
    $_SESSION['errors'] = ['Ийм нэртэй бааз байхгүй байна'];

    redirect('/500');
} elseif (mysqli_connect_errno() === 1045) {
    // die('Hereglegchiin medeelel buruu bna');
    $_SESSION['errors'] = ['Hereglegchiin medeelel buruu bna'];
    redirect('/500');
} elseif (mysqli_connect_errno()) {
    // die('Aldaa garlaa :' . mysqli_connect_error());
    $_SESSION['errors'] = ['Aldaa garlaa :' . mysqli_connect_error()];
    redirect('/500');
}

function _select(&$stmt, &$count, $sql, $types, $sqlParams, &...$bindParams)
{
    global $con;
    // mysqli_report(MYSQLI_REPORT_ALL);
    $stmt = mysqli_prepare($con, $sql);
    if (!is_null($types)) {
        mysqli_stmt_bind_param($stmt, $types, ...$sqlParams);
    }

    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $count = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_bind_result($stmt, ...$bindParams);
}

function _selectRow($sql, $types, $sqlParams, &...$bindParams)
{
    _select($stmt, $count, $sql, $types, $sqlParams, ...$bindParams);
    _fetch($stmt);
}

function _selectRowNoParam(&$stmt, &$count, $sql, &...$bindParams)
{
    _select($stmt, $count, $sql, null, null,  ...$bindParams);
    _fetch($stmt);
}

function _selectNoParam(&$stmt, &$count, $sql, &...$bindParams)
{
    _select($stmt, $count, $sql, null, null, ...$bindParams);
}

function _close_stmt($stmt)
{
    mysqli_stmt_close($stmt);
}

function _close($stmt = null)
{
    global $con;

    if (!is_null($stmt)) {
        _close_stmt($stmt);
    }
    mysqli_close($con);
}

function _fetch($stmt)
{
    return mysqli_stmt_fetch($stmt);
}

function _exec($sql, $types, $sqlParams, &$count, &$insertId = -1)
{
    global $con;
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, $types, ...$sqlParams);
    $success = mysqli_stmt_execute($stmt);
    if ($insertId != -1) {
        $insertId = mysqli_stmt_insert_id($stmt);
    }
    $count = mysqli_stmt_affected_rows($stmt);
    _close_stmt($stmt);
    return $success;
}
