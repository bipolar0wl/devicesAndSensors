<?php
require_once('dbSelect.php');

$key = $_POST['key'];

$login = $_POST['login'];
$password = $_POST['password'];

$regLogin = $_POST['regLogin'];
$regPassword = $_POST['regPassword'];
$regPasswordRepeat = $_POST['regPasswordRepeat'];
$regSurname = $_POST['regSurname'];
$regName = $_POST['regName'];
$regPatronymic = $_POST['regPatronymic'];
$email = $_POST['regEmail'];

$errors = array();
$data = '';
switch ($key) {
    case 1: // Авторизация
        if(trim($login == "")){
            $errors[] = 'Введите логин!';
        }
        else {
            $select_sql = ('SELECT * FROM users WHERE login = "'.mysqli_real_escape_string($mysqli, $login).'"');
            $result = mysqli_query($mysqli, $select_sql);
            $user = mysqli_fetch_assoc($result);
            if ($user) {
                if($user['password'] == $password){
                    $userSurname = $user['surname'];
                    $userName = $user['name'];
                    $userPatronymic = $user['patronymic'];
                    $_SESSION['logged_user'] = $user;
                }
                else{
                    $errors[] = 'Неверный пароль!';
                }
            }
            else{
                $errors[] = 'Пользователь с таким логином не найден!';
            }
        }
        if(empty($errors)){
            $data = array(
                'html' => return_login_html($userSurname, $userName, $userPatronymic)
            );
        }
        else{
            $data = array(
                "error" => $errors
            );
        }
        break;
    case 2: // Регистрация
        if(trim($regLogin == "")){
            $errors[] = 'Введите логин!';
        }
        //if(!ctype_alpha(trim($regLogin))){
        //    $errors[] = 'Логин должен содержать только латиницу!';
        //}
        $select_sql_login = ('SELECT * FROM users WHERE login = "'.mysqli_real_escape_string($mysqli, $regLogin).'"');
        $result_login = mysqli_query($mysqli, $select_sql_login);
        $user_login = mysqli_fetch_assoc($result_login);
        if($user_login){
            if($regLogin == $user_login['login']){
                $errors[] = 'Логин уже используется!';
            }
        }
        if(trim($regPassword == "")){
            $errors[] = 'Введите пароль!';
        }
        //if(!ctype_alpha(trim($regPassword))){
        //    $errors[] = 'Пароль должен содержать только латиницу!';
        //}
        if(trim($regPasswordRepeat != $regPassword)){
            $errors[] = 'Введенный пароль не совпадает!';
        }
        if(trim($regSurname == "")){
            $errors[] = 'Введите фамилию!';
        }
        if(trim($regName == "")){
            $errors[] = 'Введите имя!';
        }
        if(trim($regPatronymic == "")){
            $errors[] = 'Введите отчество!';
        }
        if ($email != "") {
            $select_sql_email = ('SELECT * FROM users WHERE email = "' . mysqli_real_escape_string($mysqli, $email) . '"');
            $result_email = mysqli_query($mysqli, $select_sql_email);
            $user_email = mysqli_fetch_assoc($result_email);
            if ($user_email) {
                if ($email == $user_email['email']) {
                    $errors[] = 'Email уже используется!';
                }
            }
        }
        if(empty($errors)){
            $insert_sql = trim('INSERT INTO users (user_id, login, password, status,
            surname, name, patronymic, email, regDate)
            VALUES (NULL,
            "'.mysqli_real_escape_string($mysqli, $regLogin).'",
            "'.mysqli_real_escape_string($mysqli, $regPassword).'",
            "'.mysqli_real_escape_string($mysqli, 1).'",
            "'.mysqli_real_escape_string($mysqli, $regSurname).'",
            "'.mysqli_real_escape_string($mysqli, $regName).'",
            "'.mysqli_real_escape_string($mysqli, $regPatronymic).'",
            "'.mysqli_real_escape_string($mysqli, $email).'",
            "'.mysqli_real_escape_string($mysqli, date("Y-m-d H:i:s")).'"
            )');
            $result = mysqli_query($mysqli, $insert_sql);
            // Костыль, вызывать ради авторизации SQL запрос исчерпывающе
            // Логин не повторяется, впрочем можно и по id
            $select_sql = ('SELECT * FROM users WHERE login = "'.mysqli_real_escape_string($mysqli, $regLogin).'"');
            $result = mysqli_query($mysqli, $select_sql);
            $user = mysqli_fetch_assoc($result);
            $_SESSION['logged_user'] = $user;
            $data = array(
                "html" => return_login_html($_SESSION['logged_user']['surname'], $_SESSION['logged_user']['name'], $_SESSION['logged_user']['patronymic']),
                "regLogin" => $insert_sql,
            );
        }
        else{
            $data = array(
//                "error" => array_shift($errors),
                "error" => $errors[0],
            );
        }
        break;
    case 3: // Проверка авторизации
        $select_sql = ('SELECT * FROM users WHERE login = "'.$_POST["login"].'" AND password = "'.$_POST["password"].'"');
        $result = mysqli_query($mysqli, $select_sql);
        $user = mysqli_fetch_assoc($result);
        if ($user) {
            $_SESSION['logged_user'] = $user;
        }
        if(isset($_SESSION['logged_user'])){
//            $data = array(
//                'login' => $_SESSION['logged_user']['login'],
//                'password' => $_SESSION['logged_user']['password']
//            );
        }
        else{
            $data = array(
//                'userSurname' => $_SESSION['logged_user']['surname'],
//                'userName' => $_SESSION['logged_user']['name'],
//                'userPatronymic' => $_SESSION['logged_user']['patronymic'],
//                'userStatus' => 0
            );
        }
        break;
    case 4: // Выход
        unset($_SESSION['logged_user']);
        break;
}
function return_login_html($userSurname, $userName, $userPatronymic){
return '<div style="text-align: right; margin-right: 387px; white-space: nowrap">
    <label>'.$userSurname.' '.$userName.' '.$userPatronymic.' </label>
    <button onclick="open_options()">Параметры</button>
    <button onclick="sign_out()">Выйти из аккаунта</button>
</div>';
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);