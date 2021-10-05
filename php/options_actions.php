<?php
require_once('../php/dbSelect.php');

$data = array();
switch ($_POST['key']) {
    case 1: // Изменение статуса
        $update_sql = ('UPDATE `users` SET
        status = '.$_POST['status'].'
        WHERE user_id ='.$_POST['user_id']);
        $result = mysqli_query($mysqli, $update_sql);
        break;
    case 2: // Изменение информации о пользователе
        if(trim($_POST['login'] == "")){
            $errors[] = 'Введите логин!';
        }
        if(!ctype_alpha(trim($_POST['login']))){
            $errors[] = 'Логин должен содержать только латиницу!';
        }
        $select_sql_login = ('SELECT * FROM users WHERE login = "'.mysqli_real_escape_string($mysqli, $_POST['login']).'" AND user_id != '.$_POST['user_id']);
        $result_login = mysqli_query($mysqli, $select_sql_login);
        $user_login = mysqli_fetch_assoc($result_login);
        if($user_login){
            if($_POST['login'] == $user_login['login']){
                $errors[] = 'Логин уже используется!';
            }
        }
        if($_POST['password_check'] == "true") {
            if (trim($_POST['password_one'] == "")) {
                $errors[] = 'Введите пароль!';
            }
            if (!ctype_alpha(trim($_POST['password_one']))) {
                $errors[] = 'Пароль должен содержать только латиницу!';
            }
            if (trim($_POST['password_one'] != $_POST['password_two'])) {
                $errors[] = 'Введенный пароль не совпадает!';
            }
        }
        if(trim($_POST['surname'] == "")){
            $errors[] = 'Введите фамилию!';
        }
        if(trim($_POST['name'] == "")){
            $errors[] = 'Введите имя!';
        }
        if(trim($_POST['patronymic'] == "")){
            $errors[] = 'Введите отчество!';
        }
        if ($_POST['email'] != "") {
            $select_sql_email = ('SELECT * FROM users WHERE email = "' . mysqli_real_escape_string($mysqli, $_POST['email']) . '" AND user_id != '.$_POST['user_id']);
            $result_email = mysqli_query($mysqli, $select_sql_email);
            $user_email = mysqli_fetch_assoc($result_email);
            if ($user_email) {
                if ($_POST['email'] == $user_email['email']) {
                    $errors[] = 'Email уже используется!';
                }
            }
        }
        if(empty($errors)){
            $update_sql = ('UPDATE `users` SET
            login = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['login']). /* Логин */'",""),
            surname = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['surname']). /* Фамилия */'",""),
            name = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['name']). /* Имя */'",""),
            patronymic = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['patronymic']). /* Отчество */'",""),
            email = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['email']). /* Почта */'","")');
            if($_POST['password_check'] == "true"){
                $update_sql .= (',
                password = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['password_one']). /* Пароль */'","") ');
            }
            $update_sql .= (' WHERE user_id ='.$_POST['user_id']);
            $result = mysqli_query($mysqli, $update_sql);
        }
        else{
            $data = array(
//                "error" => array_shift($errors),
                "error" => $errors[0],
            );
        }
        break;
    case 3:
        $select_sql = ('SELECT * FROM users WHERE user_id = '.$_POST['user_id']);
        $result_sql = mysqli_query($mysqli, $select_sql);
        $row = mysqli_fetch_assoc($result_sql);
        $data = array(
            'login' => $row['login'],
            'surname' => $row['surname'],
            'name' => $row['name'],
            'patronymic' => $row['patronymic'],
            'email' => $row['email']
        );
        break;
    case 4:
        $delete_sql = ('DELETE FROM users WHERE user_id = '.$_POST['user_id']);
        mysqli_query($mysqli, $delete_sql);
        break;
    default:
        break;
}
$json_data = array(
    "data" => $data
);
echo json_encode($data, JSON_UNESCAPED_UNICODE);