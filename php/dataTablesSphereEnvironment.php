<?php
require_once('dbSelect.php');
$data = array();

if ($_POST['key'] == 1) {
    if ($_POST['product_type'] == "sensor") {
        $select_sql = ('SELECT * FROM environment');
//        $select_sql = ('SELECT * FROM environment LEFT JOIN sensor_environment ON environment.environment_id = sensor_environment.environment_id');
    } else {
        $select_sql = ('SELECT * FROM environment LEFT JOIN device_environment ON environment.environment_id = device_environment.environment_id');
    }
    $result = mysqli_query($mysqli, $select_sql);
    $subdata = array();
    $subdata[] = '<input type="text" id="new_environment_name" placeholder="Наименование">'; // Наименование
    $subdata[] = '<input type="button" id="new_environment_add" value="Добавить">'; // Включено
    $data[] = $subdata;
    while ($row = mysqli_fetch_assoc($result)) {
        $subdata = array();
        $subdata[] = $row['environment_name']; // Наименование
        $subdata[] = '<input type="checkbox">'; // Включено
        $data[] = $subdata;
    }
}
else{
    if ($_POST['product_type'] == "sensor") {
        $select_sql = ('SELECT * FROM application_sphere');
//        $select_sql = ('SELECT * FROM environment LEFT JOIN sensor_environment ON environment.environment_id = sensor_environment.environment_id');
    } else {
        $select_sql = ('SELECT * FROM environment LEFT JOIN device_environment ON environment.environment_id = device_environment.environment_id');
    }
    $result = mysqli_query($mysqli, $select_sql);
    $subdata = array();
    $subdata[] = '<input type="text" id="new_sphere_name" placeholder="Наименование">'; // Наименование
    $subdata[] = '<input type="button" id="new_sphere_add" value="Добавить">'; // Включено
    $data[] = $subdata;
    while ($row = mysqli_fetch_assoc($result)) {
        $subdata = array();
        $subdata[] = $row['application_sphere_name']; // Наименование
        $subdata[] = '<input type="checkbox">'; // Включено
        $data[] = $subdata;
    }
}
$json_data = array(
    "data" =>  $data
);
echo json_encode($json_data, JSON_UNESCAPED_UNICODE);