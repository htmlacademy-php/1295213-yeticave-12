<?php
require ('helpers.php');

$is_auth = rand(0, 1);

$user_name = 'Эдуард'; // укажите здесь ваше имя

$categories = ['Доски и лыжи', 'Крепления', 'Ботинки', 'Одежда', 'Инструменты', 'Разное'];

$ads = [
    [
        'name' => '2014 Rossignol District Snowboard',
        'category' => 'Доски и лыжи',
        'price' => 10999,
        'url' => 'img/lot-1.jpg',
        'time_finish' => '2021-04-25'
    ],
    [
        'name' => 'DC Ply Mens 2016/2017 Snowboard',
        'category' => 'Доски и лыжи',
        'price' => 159999,
        'url' => 'img/lot-2.jpg',
        'time_finish' => '2021-04-26'
    ],
    [
        'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'category' => 'Крепления',
        'price' => 8000,
        'url' => 'img/lot-3.jpg',
        'time_finish' => '2021-04-27'
    ],
    [
        'name' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'category' => 'Ботинки',
        'price' => 10999,
        'url' => 'img/lot-4.jpg',
        'time_finish' => '2021-04-28'
    ],
    [
        'name' => 'Куртка для сноуборда DC Mutiny Charocal',
        'category' => 'Одежда',
        'price' => 7500,
        'url' => 'img/lot-5.jpg',
        'time_finish' => '2021-04-29'
    ],
    [
        'name' => 'Маска Oakley Canopy',
        'category' => 'Разное',
        'price' => 5400,
        'url' => 'img/lot-6.jpg',
        'time_finish' => '2021-04-30'
    ]
];

function format_price($number) {
    $number = ceil($number);
    if ($number >= 1000) {
        $number = number_format($number, 0, ',', ' ');
    }
    $number = $number . ' p';
    return $number;
};

function get_time ($data_finish) {
    $now_date = time();
    $next_date = strtotime($data_finish);
    $diff = $next_date - $now_date;
    $hour = floor($diff / 3600);
    $minute = floor(($diff % 3600) / 60);
    $hour_minute = array($hour, $minute);
    return $hour_minute;
};

$page_content = include_template('main.php', ['categories' => $categories, 'ads' => $ads]);

$layout_content = include_template('layout.php', ['page_content' => $page_content, 'categories' => $categories, 'ads' => $ads, 'title' => 'Главная', 'user_name' => $user_name, 'is_auth' => $is_auth]);

print($layout_content);

?>
