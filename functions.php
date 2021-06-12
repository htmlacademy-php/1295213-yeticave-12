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
