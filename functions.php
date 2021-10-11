<?php

function format_price($number)
{
$number = ceil($number);
if ($number >= 1000) {
$number = number_format($number, 0, ',', ' ');
}
$number = $number . ' p';
return $number;
};

function get_time($data_finish)
{
$now_date = time();
$next_date = strtotime($data_finish);
$diff = $next_date - $now_date;
$hour = floor($diff / 3600);
$minute = floor(($diff % 3600) / 60);
$hour_minute = array($hour, $minute);
return $hour_minute;
};

function validateLength($value, $min, $max) {
    if ($value) {
        $len = strlen($value);
        if ($len < $min or $len > $max) {
            return "Значение должно быть от $min до $max символов";
        }
    }

    return null;
}

function validateNumber($value) {
    if ($value < 0) {
            return "Значение должно быть больше 0";
        }

    return null;
}


function getPostVal($name) {
    return $_POST[$name] ?? "";
}





