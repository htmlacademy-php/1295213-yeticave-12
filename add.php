<?php

require_once('helpers.php');
require_once('functions.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $required = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step'];
    $errors = [];

    $rules = [
//        'lot-date' => function ($value) {
//            return is_date_valid($value);
//        },
        'lot-rate' => function ($value) {
            return validateNumber($value);
        },
        'lot-step' => function ($value) {
            return validateNumber($value);
        }
    ];
    $lot = filter_input_array(INPUT_POST, ['lot-name' => FILTER_DEFAULT, 'category' => FILTER_DEFAULT,
        'message' => FILTER_DEFAULT, 'lot-rate' => FILTER_DEFAULT, 'lot-step' => FILTER_DEFAULT, 'lot-date' => FILTER_DEFAULT], true);

    foreach ($lot as $key => $value) {
        if (isset($rules[$key])) {
            $rule = $rules[$key];
            $errors[$key] = $rule($value);
        }

        if (in_array($key, $required) && empty($value)) {
            $errors[$key] = "Поле $key надо заполнить";
        }
    }

    $errors = array_filter($errors);

    if (!empty($_FILES['foto']['name'])) {

        $file_name = $_FILES['foto']['name'];
        $file_path = __DIR__ . '/uploads/';
        $file_url = '/uploads/' . $file_name;
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $file_name);

        if ($file_type !== "image/jpg") {
            $errors['file'] = 'Загрузите картинку в формате jpg, jpeg, png';
        } else {
            move_uploaded_file($_FILES['foto']['tmp_name'], $file_path . $file_name);
        }

        move_uploaded_file($_FILES['foto']['tmp_name'], $file_path . $file_name);

    } else {
        $errors['file'] = 'Вы не загрузили файл';
    }

    if (count($errors)) {
        $page_content = include_template('add.php', ['lot' => $lot, 'errors' => $errors]);
    } else {

        $con = mysqli_connect("localhost", "root", "root", "yeticave");
        if ($con == false) {
            print("Ошибка подключения: " . mysqli_connect_error());
        } else {
            $sql = 'INSERT INTO lot (add_time, author_id, name_lot, category_id, description, start_price, step_rate, data_finish, img) VALUES (NOW(), 1, ?, ?, ?, ?, ?, ?, ?)';
//        здесь не понял как записать правильно, в первых скобках наименования соответствуют столбцам в базе, и как установить соединение вообще
            $stmt = db_get_prepare_stmt($con, $sql, $lot);
            $res = mysqli_stmt_execute($stmt);

            $sql_category = "SELECT name_category, s_code FROM category";
            $result_category = mysqli_query($con, $sql_category);
            $rows = mysqli_fetch_all($result_category, MYSQLI_ASSOC);
        }


        if ($res) {
            $lot_id = mysqli_insert_id($con);

            header("Location: lot.php?id=" . $lot_id);
        }
    }
}
else {
    $page_content = include_template('add-lot.php');
}

$is_auth = rand(0, 1);
$user_name = 'Эдуард';

$page_content = include_template('add-lot.php', [
    'title' => 'yeti - Добавление лота',
    'lot' => $lot, 'errors' => $errors
]);

$layout_content = include_template('layout.php',
    ['page_content' => $page_content, 'title' => 'главная',
        'user_name' => $user_name, 'is_auth' => $is_auth, 'rows' => $rows,
    ]);
print($layout_content);

