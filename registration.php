<?php
require_once('helpers.php');
require_once('db_connection.php');
require_once('service_functions.php');

$con = db_connect();
$incoming_data = ['email' => '', 'password' => '', 'name' => '', 'message' => ''];
$form_errors = [];

if(isset($_POST['submit'])){
    $incoming_data = $_POST;
    $form_errors = checkRegistrationErrors($con, $incoming_data);

    if (count($form_errors) == 0){
        setUserOnDb ($con, $incoming_data);
        header('Location:login.php');
        die();
    }
}

$categories_arr = [];
$categories_arr = getCategories($con);

$page_content = include_template('sign-up.php', ['categories_arr' => $categories_arr, 'incoming_data' => $incoming_data, 'form_errors' => $form_errors]);

$layout_content = include_template('layout.php', ['is_auth' => 0 ,'categories_arr' => $categories_arr, 'content' => $page_content ,'title' => 'Регистрация']);

print($layout_content);

function checkRegistrationErrors($con, $data): array{
    $result = [];
    if($email_error = checkEmail($con, $data['email'])){
        $result['email'] = $email_error;
    }
    if ($data['password'] == ''){
        $result['password'] = 'Введите пароль';
    }
    if ($data['name'] == ''){
        $result['name'] = 'Введите имя';
    }
    if ($data['message'] == ''){
        $result['message'] = 'Введите контактные данные';
    }

    return $result;
}

function checkEmail($con, $email): string{
    if($email == ''){
        return 'Введите e-mail';
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return 'Введен некорректный e-mail';
    }

    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = db_get_prepare_stmt($con, $sql, [$email]);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $result = mysqli_num_rows($res) == 0 ? false: true; 
    
    if ($result){
        return 'Данный email занят';
    }
    return '';
}

function setUserOnDb ($con, $incoming_data){
    $password = password_hash($incoming_data['password'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO user (registration_date, email, name, password, contacts) 
        VALUE (?, ?, ?, ?, ?)";
    $stmt = db_get_prepare_stmt($con, $sql, [date('Y-m-d H:i:s', time()), $incoming_data['email'], $incoming_data['name'], 
    $password, $incoming_data['message']]);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if(mysqli_errno($con)){
        printf("Connect failed: %s\n", mysqli_connect_error()); 
        die();
    }
}