<?php
require_once('dbSelect.php');
$data = array();

$select_sql = ('SELECT * FROM users');
$result = mysqli_query($mysqli, $select_sql);
while ($row = mysqli_fetch_assoc($result)) {
    $subdata = array();
    $subdata[] = $row['login']; // Логин
//    $subdata[] = '<input type="button" value="Установить " width="150px">'; // Сброс пароля
//    $subdata[] = $row['status']; // Уровень доступа
    $subdata[] = selectStatus($row['user_id'], $row['status'], $mysqli); // Уровень доступа
    $subdata[] = $row['surname']; // Фамилия
    $subdata[] = $row['name']; // Имя
    $subdata[] = $row['patronymic']; // Отчество
    $subdata[] = $row['email']; // Почта
    $subdata[] = $row['regDate']; // Дата регистрации
    if ($row['status'] >= $_SESSION['logged_user']['status']){
        $subdata[] = "";
    }
    else {
        $subdata[] = '<b>
            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" data-id="' . $row['user_id'] . '" onclick="show_hide_user(' . $row['user_id'] . ')" title="Редактировать информацию">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-box-arrow-in-down-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M9.636 2.5a.5.5 0 0 0-.5-.5H2.5A1.5 1.5 0 0 0 1 3.5v10A1.5 1.5 0 0 0 2.5 15h10a1.5 1.5 0 0 0 1.5-1.5V6.864a.5.5 0 0 0-1 0V13.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"></path>
                    <path fill-rule="evenodd" d="M5 10.5a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 0-1H6.707l8.147-8.146a.5.5 0 0 0-.708-.708L6 9.293V5.5a.5.5 0 0 0-1 0v5z"></path>
                </svg>
            </a>
            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal" data-id="' . $row['user_id'] . '" onclick="del_user(' . $row['user_id'] . ')" title="Удалить пользователя">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
                </svg>
            </a>
        </b>';
    }
    $data[] = $subdata;
}

$json_data = array(
    "data" =>  $data
);

echo json_encode($json_data, JSON_UNESCAPED_UNICODE);

function selectStatus($user_id, $status, $mysqli){
//    if ($_SESSION['logged_user']['status'] < 5){
//        $select_status = ('SELECT * FROM status_list WHERE status < 5');
//    }
//    else {
//        $select_status = ('SELECT * FROM status_list');
//    }
    $select_status = ('SELECT * FROM status_list');
    $result_status = mysqli_query($mysqli, $select_status);
    if ($status == 5){
        $result = '<select disabled style="color: var(--theme-color); width: 185px" >';
    }
    else {
        $result = '<select class="status_select" style="width: 185px" onchange="select_status('.$user_id.','.$status.', this)">';
//        $result = '<select class="status_select" style="width: 150px">';
    }
    while ($row = mysqli_fetch_assoc($result_status)) {
        if ($status == $row['status']){
            $result .= '<option selected value="'.$row['status'].'">'.$row['status_name'].'</option>';
        }
        else{
            $result .= '<option value="'.$row['status'].'">'.$row['status_name'].'</option>';
        }
    }
    $result .= '</select>';
    return $result;
}