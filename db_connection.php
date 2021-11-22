<?php

/**
 * Подключение к БД.
 *
 * @return mysqli Возвращает подключение к БД.
 */
function db_connect():mysqli
{
$config = include('config.php.dist');
    $con = mysqli_connect($config->host, $config->user, $config->password, $config->database);
    if ($con == false){
        print ("Ошибка подключения" . mysqli_connect_error());
    die();
    }
    mysqli_set_charset($con, "utf8");
    return $con;
}
