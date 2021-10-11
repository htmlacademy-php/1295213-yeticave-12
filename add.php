<?php

require_once('helpers.php');
require_once('functions.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $required = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
    $errors = [];

    $rules = [
        'message' => function($value) {
            return validateLength($value, 10, 1000);
        },
        'lot-date' => function($value) {
            return is_date_valid($value);
        },
        'lot-rate' => function($value) {
            return validateNumber($value);
        },
        'lot-step' => function($value) {
            return validateNumber($value);
        }
    ];
    $gif = filter_input_array(INPUT_POST, ['lot-name' => FILTER_DEFAULT, 'category' => FILTER_DEFAULT,
        'message' => FILTER_DEFAULT, 'lot-rate' => FILTER_DEFAULT, 'lot-step' => FILTER_DEFAULT, 'lot-step' => 'lot-date'], true);

    foreach ($gif as $key => $value) {
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
        $tmp_name = $_FILES['foto']['tmp_name'];
        $path = $_FILES['foto']['name'];
        $filename = uniqid() . '.jpg';
//        Допустимые форматы файлов: jpg, jpeg, png;

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);
        if ($file_type !== "image/jpg") {
            $errors['file'] = 'Загрузите картинку в формате jpg, jpeg, png';
        }
        else {
            move_uploaded_file($tmp_name, 'uploads/' . $filename);
            $gif['path'] = $filename;
        }
    }
    else {
        $errors['file'] = 'Вы не загрузили файл';
    }

    if (count($errors)) {
        $page_content = include_template('add.php', ['gif' => $gif, 'errors' => $errors]);
    }
    else {
//        $link = mysqli_connect("localhost", "root", "root", "yeticave");  ?
//        $sql = 'INSERT INTO lot (dt_add, author_id, lot-name, category_id, description, start_price, step_rate, data_finish, path) VALUES (NOW(), 1, ?, ?, ?, ?, ?, ?)';
//        здесь не понял как записать правильно, в первых скобках наименования соответствуют столбцам в базе, и как установить соединение вообще
        $stmt = db_get_prepare_stmt($link, $sql, $gif);
        $res = mysqli_stmt_execute($stmt);

        if ($res) {
            $gif_id = mysqli_insert_id($link);

            header("Location: lot.php?id=" . $gif_id);
        }
    }
}
else {
    $page_content = include_template('add.php', ['gif' => $gif, 'errors' => $errors]);
}

$lot_content = include_template('add-lot.php', [
    'content'    => $page_content,
    'title'      => 'GifTube - Добавление лота',
    'gif' => $gif, 'errors' => $errors
]);

print($lot_content);

