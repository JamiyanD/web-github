<?php

$month = get('month', 2);
$year = get('year', 4);

$_SESSION['year'] = $year;
$_SESSION['month'] = $month;

redirect('/user/home');
