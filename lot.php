<?php
require_once('helpers.php');
require_once('functions.php');

$lots_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

$con = mysqli_connect("localhost", "root", "root", "yeticave");
mysqli_set_charset($con, "utf8");
if ($con == false) {
    print("Ошибка подключения: " . mysqli_connect_error());
} else {
    $sql_lot_link = "SELECT l.id, l.name_lot, l.start_price, l.img, l.data_finish, l.description, l.step_rate, c.name_category
FROM lot l INNER JOIN category c
ON l.id = c.id AND l.id = $lots_id
ORDER BY add_time ASC";
    $result_lot = mysqli_query($con, $sql_lot_link);
    $lot_link = mysqli_fetch_all($result_lot, MYSQLI_ASSOC);

    $sql_category = "SELECT name_category, s_code FROM category";
    $result_category = mysqli_query($con, $sql_category);
    $rows = mysqli_fetch_all($result_category, MYSQLI_ASSOC);
};

$lot_id = $lot_link[0]['id'] ?? null;
if ($lot_id !== null) {
    $lot_content = include_template('lot.php', ['lot_link' => $lot_link, 'rows' => $rows]);
    print($lot_content);
} else {
    header("location: pages/404.html");
};
