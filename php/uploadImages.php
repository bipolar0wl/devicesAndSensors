<?php
//header('content-type: application-json; charset=UTF-8');
require_once('dbSelect.php');

$id = $_POST['id'];
$key = $_POST['key'];
//$files = $_POST['file'];

$file_name = $_FILES['file']['name'];
$file_size = $_FILES['file']['size'];
$file_tmp = $_FILES['file']['tmp_name'];
$file_type = $_FILES['file']['type'];
$file_ext = ".".strtolower(end(explode('.',$_FILES['file']['name'])));

date_default_timezone_set("Europe/Moscow");
$uploadDir = '';
$data = "";
switch ($key){
    case 1: // Частотная характеристика (изображение)
        $uploadDir = '../upload/frequency/';
        $file_name = "ID-".$id."_".date("Y-m-d\_H-i-s").$file_ext;
        move_uploaded_file($file_tmp, $uploadDir.$file_name);
        $_POST['type_of_product'] == "sensor" ?
        $update_sql = ('UPDATE sensors SET
            dynamic_frequency_response = "'.mysqli_real_escape_string($mysqli, "upload/frequency/".$file_name).'"
            WHERE sensor_id = '.$id) :
            $update_sql = ('UPDATE devices SET
            dynamic_frequency_response = "'.mysqli_real_escape_string($mysqli, "upload/frequency/".$file_name).'"
            WHERE device_id = '.$id);
        $result = mysqli_query($mysqli, $update_sql);
        $data = $update_sql;
        break;
    case 2: // Изображение
        $uploadDir = '../upload/picture/';
        $file_name = "ID-".$id."_".date("Y-m-d\_H-i-s").$file_ext;
        move_uploaded_file($file_tmp, $uploadDir.$file_name);
        $_POST['type_of_product'] == "sensor" ?
        $update_sql = ('UPDATE sensors SET
            picture = "'.mysqli_real_escape_string($mysqli, "upload/picture/".$file_name).'"
            WHERE sensor_id = '.$id) :
            $update_sql = ('UPDATE devices SET
            picture = "'.mysqli_real_escape_string($mysqli, "upload/picture/".$file_name).'"
            WHERE device_id = '.$id);
        $result = mysqli_query($mysqli, $update_sql);
        $data = $update_sql;
        break;
    case 3: // Чертеж
        $uploadDir = '../upload/blueprint/';
        $file_name = "ID-".$id."_".date("Y-m-d\_H-i-s").$file_ext;
        move_uploaded_file($file_tmp, $uploadDir.$file_name);
        $_POST['type_of_product'] == "sensor" ?
        $update_sql = ('UPDATE sensors SET
            blueprint = "'.mysqli_real_escape_string($mysqli, "upload/blueprint/".$file_name).'"
            WHERE sensor_id = '.$id) :
            $update_sql = ('UPDATE devices SET
            blueprint = "'.mysqli_real_escape_string($mysqli, "upload/blueprint/".$file_name).'"
            WHERE device_id = '.$id);
        $result = mysqli_query($mysqli, $update_sql);
        $data = $update_sql;
        break;
    case 4: // Схема
        $uploadDir = '../upload/scheme/';
        $file_name = "ID-".$id."_".date("Y-m-d\_H-i-s").$file_ext;
        move_uploaded_file($file_tmp, $uploadDir.$file_name);
        $_POST['type_of_product'] == "sensor" ?
        $update_sql = ('UPDATE sensors SET
            scheme = "'.mysqli_real_escape_string($mysqli, "upload/scheme/".$file_name).'"
            WHERE sensor_id = '.$id) :
            $update_sql = ('UPDATE devices SET
            scheme = "'.mysqli_real_escape_string($mysqli, "upload/scheme/".$file_name).'"
            WHERE device_id = '.$id);
        $result = mysqli_query($mysqli, $update_sql);
        $data = $update_sql;
        break;
//    case 1:
//        $uploadDir = '../upload/scheme/';
//        $file_name = "ID-".$id."_".date("Y-m-d\_H-i-s").$file_ext;
//        move_uploaded_file($file_tmp, $uploadDir.$file_name);
//        $select_sql = ("SELECT * FROM acc_prod");
//        $update_sql = ('UPDATE acc_accelerometers SET
//        electric_circuit = "'.mysqli_real_escape_string($mysqli, "upload/scheme/".$file_name).'"
//        WHERE ID = '.$id);
//        $result = mysqli_query($mysqli, $update_sql);
//        $data = $update_sql;
//        break;
//    case 2:
//        $uploadDir = '/upload/images';
//        break;
    default:
        break;
}

echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>