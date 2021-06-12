<?php
require_once('helpers.php');
require_once('functions.php');


$is_auth = rand(0, 1);

$user_name = 'Эдуард'; // укажите здесь ваше имя

$con = mysqli_connect("localhost", "root", "root", "yeticave");
mysqli_set_charset($con, "utf8");
if ($con == false) {
    print("Ошибка подключения: " . mysqli_connect_error());
} else {
    $sql_category = "SELECT name_category, s_code FROM category";
    $result_category = mysqli_query($con, $sql_category);
    $rows = mysqli_fetch_all($result_category, MYSQLI_ASSOC);

    $sql_lot = "SELECT l.id, l.name_lot, l.start_price, l.img, l.data_finish, c.name_category FROM lot l INNER JOIN category c ON l.id = c.id ORDER BY add_time ASC";
    $result_lot = mysqli_query($con, $sql_lot);
    $lots = mysqli_fetch_all($result_lot, MYSQLI_ASSOC);
};

$page_content = include_template('main.php', ['rows' => $rows, 'lots' => $lots]);
$lot_content = include_template('lot.php', ['rows' => $rows, 'lots' => $lots]);

$layout_content = include_template('layout.php',
    ['page_content' => $page_content, 'title' => 'главная', 'user_name' => $user_name, 'is_auth' => $is_auth, 'rows' => $rows]);
print($layout_content);

?>
