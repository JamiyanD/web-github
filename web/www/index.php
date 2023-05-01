<?php
ini_set('display_errors', 1);
session_start();
define('ROOT', dirname(dirname(__FILE__)));


require ROOT . '/inc/conf.php';

$page = @$_SERVER['REDIRECT_URL'];

if ($page == '/500') {
    require ROOT . '/pages/500.php';
    exit;
}

require ROOT . '/inc/db.php';

if (empty($page)) {
    require ROOT . '/pages/sign-in.php';
} else {
    $script = ROOT . "/pages$page.php";
    if (file_exists($script)) {
        require $script;
    } else {
        require ROOT . '/pages/404.php';
    }
}

function dd($arr, $exit = false)
{
    echo '<pre  >';
    print_r($arr);
    if ($exit) {
        exit;
    }
}

function post($name, $length = null)
{
    $value = $_POST[$name];
    $value = addslashes($value);
    if (!is_null($length) && mb_strlen($value) > $length) {
        $value = mb_substr($value, 0, $length);
        echo "<br>security alert : $name indextei ogogdol $length urtaas hetersen baina ";
    }

    return $value;
}

function logError($e)
{
    _exec(
        "insert into error set 
    ognoo = now(),
    ip=?,
    error_code=?,
    error=?,
    file=?,
    line=?,
    site='user'
    ",
        'sissi',
        [getIpAddress(), $e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine()],
        $count
    );
}

function redirect($page)
{
    // require ROOT . "/pages$page";
    header("Location: $page");
    exit;
};

function getIpAddress()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    return $_SERVER['REMOTE_ADDR'];
}

function formatMoney($value)
{


    if ($value == '0') {
        return ' ';
    } else {
        $value = number_format(sprintf('%0.2f', preg_replace("/[^0-9.]/", "", $value)), 0);
        return $value;
    }
}

function get($name, $length = null)
{
    if (isset($_GET[$name])) {
        $value = $_GET[$name];
        // die("$value");
        $value = addslashes($value);
        if (!is_null($length) && mb_strlen($value) > $length) {
            $value = mb_substr($value, 0, $length);
            echo "<br>security alert : $name indextei ogogdol $length urtaas hetersen baina ";
        }
    } else {
        return '';
    }


    return $value;
}
