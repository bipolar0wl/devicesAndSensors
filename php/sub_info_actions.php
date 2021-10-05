<?php
require_once('dbSelect.php');

$data = "";
$errors = array();

switch ($_POST['function_key']) {
    case 1: // Загрузить информацию
        switch ($_POST['key']) {
            case 1: // Производитель
                if (is_numeric($_POST['producer_id'])) {
                    $select_sql = ('SELECT * FROM producer WHERE producer_id = ' . $_POST['producer_id']);
                    $result = mysqli_query($mysqli, $select_sql);
                    $row = mysqli_fetch_assoc($result);
                    $data = array(
                        "producer_name" => $row['producer_name'],
                        "producer_address" => $row['producer_address'],
                        "producer_phone" => $row['producer_phone'],
                        "producer_website" => $row['producer_website'],
                        "producer_email" => $row['producer_email']
                    );
                }
                break;
            case 2: // Литература
                if (is_numeric($_POST['literature_id'])) {
                    $select_sql = ('SELECT * FROM literature WHERE literature_id = ' . $_POST['literature_id']);
                    $result = mysqli_query($mysqli, $select_sql);
                    $row = mysqli_fetch_assoc($result);
                    $data = array(
                        "literature_name" => $row['literature_name'],
                        "literature_author" => $row['literature_author'],
                        "literature_date" => $row['literature_date'],
                        "literature_publisher" => $row['literature_publisher'],
                        "literature_website" => $row['literature_website']
                    );
                }
                break;
            case 3: // Среда измерения
                if (is_numeric($_POST['environment_id'])) {
                    $select_sql = ('SELECT * FROM environment WHERE environment_id = ' . $_POST['environment_id']);
                    $result = mysqli_query($mysqli, $select_sql);
                    $row = mysqli_fetch_assoc($result);
                    $data = array(
                        "environment_name" => $row['environment_name'],
                        "environment_description" => $row['environment_description']
                    );
                }
                break;
            case 4: // Область применения
                if (is_numeric($_POST['application_sphere_id'])) {
                    $select_sql = ('SELECT * FROM application_sphere WHERE application_sphere_id = ' . $_POST['application_sphere_id']);
                    $result = mysqli_query($mysqli, $select_sql);
                    $row = mysqli_fetch_assoc($result);
                    $data = array(
                        "application_sphere_name" => $row['application_sphere_name'],
                    );
                }
                break;
            case 5: // Технология изготовления
                if (is_numeric($_POST['manufacturing_technology_id'])) {
                    $select_sql = ('SELECT * FROM manufacturing_technology WHERE manufacturing_technology_id = ' . $_POST['manufacturing_technology_id']);
                    $result = mysqli_query($mysqli, $select_sql);
                    $row = mysqli_fetch_assoc($result);
                    $data = array(
                        "manufacturing_technology_name" => $row['manufacturing_technology_name'],
                        "manufacturing_technology_description" => $row['manufacturing_technology_description']
                    );
                }
                break;
            case 6: // Принцип действия
                if (is_numeric($_POST['operation_principle_id'])) {
                    $select_sql = ('SELECT * FROM operation_principle WHERE operation_principle_id = ' . $_POST['operation_principle_id']);
                    $result = mysqli_query($mysqli, $select_sql);
                    $row = mysqli_fetch_assoc($result);
                    $data = array(
                        "operation_principle_name" => $row['operation_principle_name'],
                        "operation_principle_description" => $row['operation_principle_description']
                    );
                }
                break;
            case 7: // Тип датчика
                if (is_numeric($_POST['sensor_type_id'])) {
                    $select_sql = ('SELECT * FROM sensor_type WHERE sensor_type_id = ' . $_POST['sensor_type_id']);
                    $result = mysqli_query($mysqli, $select_sql);
                    $row = mysqli_fetch_assoc($result);
                    if ($row) {
                        $select_sql_sub = ('SELECT * FROM measurable_value WHERE measurable_value_id = ' . $row['measurable_value_id']);
                        $result_sub = mysqli_query($mysqli, $select_sql_sub);
                        $row_sub = mysqli_fetch_assoc($result_sub);
                    }
                    $data = array(
                        "sensor_type_name" => $row['sensor_type_name'],
                        "measurable_value_id" => $row['measurable_value_id'],
                        "measurable_value_name" => $row_sub['measurable_value_name']
                    );
                }
                break;
            case 8: // Чувствительный элемент
                if (is_numeric($_POST['sensitive_element_id'])) {
                    $select_sql = ('SELECT * FROM sensitive_element WHERE sensitive_element_id = ' . $_POST['sensitive_element_id']);
                    $result = mysqli_query($mysqli, $select_sql);
                    $row = mysqli_fetch_assoc($result);
                    $data = array(
                        "sensitive_element_name" => $row['sensitive_element_name'],
                        "sensitive_element_description" => $row['sensitive_element_description']
                    );
                }
                break;
            case 9: // Характер выходного сигнала
                if (is_numeric($_POST['output_signal_id'])) {
                    $select_sql = ('SELECT * FROM output_signal WHERE output_signal_id = ' . $_POST['output_signal_id']);
                    $result = mysqli_query($mysqli, $select_sql);
                    $row = mysqli_fetch_assoc($result);
                    $data = array(
                        "output_signal_name" => $row['output_signal_name'],
                        "output_signal_description" => $row['output_signal_description']
                    );
                }
                break;
            case 10: // Характер преобразования сигнала
                if (is_numeric($_POST['signal_conversation_id'])) {
                    $select_sql = ('SELECT * FROM signal_conversation WHERE signal_conversation_id = ' . $_POST['signal_conversation_id']);
                    $result = mysqli_query($mysqli, $select_sql);
                    $row = mysqli_fetch_assoc($result);
                    $data = array(
                        "signal_conversation_name" => $row['signal_conversation_name'],
                        "signal_conversation_description" => $row['signal_conversation_description']
                    );
                }
                break;
            case 11: // Тип прибора
                if (is_numeric($_POST['device_type_id'])) {
                    $select_sql = ('SELECT * FROM device_type WHERE device_type_id = ' . $_POST['device_type_id']);
                    $result = mysqli_query($mysqli, $select_sql);
                    $row = mysqli_fetch_assoc($result);
                    $data = array(
                        "signal_conversation_name" => $row['signal_conversation_name'],
                    );
                }
                break;
            case 12: // Назначение прибора
                if (is_numeric($_POST['device_purpose_id'])) {
                    $select_sql = ('SELECT * FROM device_purpose WHERE device_purpose_id = ' . $_POST['device_purpose_id']);
                    $result = mysqli_query($mysqli, $select_sql);
                    $row = mysqli_fetch_assoc($result);
                    $data = array(
                        "signal_conversation_name" => $row['signal_conversation_name'],
                    );
                }
                break;
            case 13: // Способ управления
                if (is_numeric($_POST['control_type_id'])) {
                    $select_sql = ('SELECT * FROM device_control_type WHERE control_type_id = ' . $_POST['control_type_id']);
                    $result = mysqli_query($mysqli, $select_sql);
                    $row = mysqli_fetch_assoc($result);
                    $data = array(
                        "control_type_name" => $row['control_type_name'],
                    );
                }
                break;
            case 14: // Воспроизведение измеряемой величины
                if (is_numeric($_POST['device_measure_show_type_id'])) {
                    $select_sql = ('SELECT * FROM measure_show_type WHERE measure_show_type_id = ' . $_POST['device_measure_show_type_id']);
                    $result = mysqli_query($mysqli, $select_sql);
                    $row = mysqli_fetch_assoc($result);
                    $data = array(
                        "measure_show_type_name" => $row['measure_show_type_name'],
                    );
                }
                break;
            default:
                break;
        }
        break;
    case 2: // Кнопка сохранить или изменить
        switch ($_POST['key']) {
            case 1: // Производитель
                if ($_POST['producer_id'] == 0) {
                    $insert_sql = ('INSERT INTO producer SET
                    producer_id = NULL,
                    producer_name = "' . mysqli_real_escape_string($mysqli, $_POST['producer_name']) . '",
                    producer_address = "' . mysqli_real_escape_string($mysqli, $_POST['producer_address']) . '",
                    producer_phone = "' . mysqli_real_escape_string($mysqli, $_POST['producer_phone']) . '",
                    producer_website = "' . mysqli_real_escape_string($mysqli, $_POST['producer_website']) . '",
                    producer_email = "' . mysqli_real_escape_string($mysqli, $_POST['producer_email']) . '"');
                    $result = mysqli_query($mysqli, $insert_sql); // Вставляем в таблицу нового производителя
                }
                else{
                    $update_sql = ('UPDATE producer SET
                    producer_name = "'.mysqli_real_escape_string($mysqli, $_POST['producer_name']).'",
                    producer_address = "'.mysqli_real_escape_string($mysqli, $_POST['producer_address']).'",
                    producer_phone = "'.mysqli_real_escape_string($mysqli, $_POST['producer_phone']).'",
                    producer_website = "'.mysqli_real_escape_string($mysqli, $_POST['producer_website']).'",
                    producer_email = "'.mysqli_real_escape_string($mysqli, $_POST['producer_email']).'"
                    WHERE producer_id ='.$_POST['producer_id']);
                    $result = mysqli_query($mysqli, $update_sql);
                }
                error_log($_POST['producer_id']);
                break;
            case 2: // Литература
                if ($_POST['literature_id'] == 0) {
                    $insert_sql = ('INSERT INTO literature SET
                    literature_id = NULL,
                    literature_name = "' . mysqli_real_escape_string($mysqli, $_POST['literature_name']) . '",
                    literature_author = "' . mysqli_real_escape_string($mysqli, $_POST['literature_author']) . '",
                    literature_date = "' . mysqli_real_escape_string($mysqli, $_POST['literature_date']) . '",
                    literature_publisher = "' . mysqli_real_escape_string($mysqli, $_POST['literature_publisher']) . '",
                    literature_website = "' . mysqli_real_escape_string($mysqli, $_POST['literature_website']) . '"');
                    $result = mysqli_query($mysqli, $insert_sql);
                }
                else{
                    $update_sql = ('UPDATE literature SET
                    literature_name = "'.mysqli_real_escape_string($mysqli, $_POST['literature_name']).'",
                    literature_author = "'.mysqli_real_escape_string($mysqli, $_POST['literature_author']).'",
                    literature_date = "'.mysqli_real_escape_string($mysqli, $_POST['literature_date']).'",
                    literature_publisher = "'.mysqli_real_escape_string($mysqli, $_POST['literature_publisher']).'",
                    literature_website = "'.mysqli_real_escape_string($mysqli, $_POST['literature_website']).'"
                    WHERE literature_id ='.$_POST['literature_id']);
                    $result = mysqli_query($mysqli, $update_sql);
                }
                break;
            case 3: // Среда измерения
                if ($_POST['environment_id'] == 0) {
                    $insert_sql = ('INSERT INTO environment SET
                    environment_id = NULL,
                    environment_name = "' . mysqli_real_escape_string($mysqli, $_POST['environment_name']) . '",
                    environment_description = "' . mysqli_real_escape_string($mysqli, $_POST['environment_description']) . '"');
                    $result = mysqli_query($mysqli, $insert_sql);
                }
                else{
                    $update_sql = ('UPDATE environment SET
                    environment_name = "'.mysqli_real_escape_string($mysqli, $_POST['environment_name']).'",
                    environment_description = "'.mysqli_real_escape_string($mysqli, $_POST['environment_description']).'"
                    WHERE environment_id ='.$_POST['environment_id']);
                    $result = mysqli_query($mysqli, $update_sql);
                }
                break;
            case 4: // Область применения
                if ($_POST['application_sphere_id'] == 0) {
                    $insert_sql = ('INSERT INTO application_sphere SET
                    application_sphere_id = NULL,
                    application_sphere_name = "' . mysqli_real_escape_string($mysqli, $_POST['application_sphere_name']) . '"');
                    $result = mysqli_query($mysqli, $insert_sql);
                }
                else{
                    $update_sql = ('UPDATE application_sphere SET
                    application_sphere_name = "'.mysqli_real_escape_string($mysqli, $_POST['application_sphere_name']).'"
                    WHERE application_sphere_id ='.$_POST['application_sphere_id']);
                    $result = mysqli_query($mysqli, $update_sql);
                }
                break;
            case 5: // Технология изготовления
                if ($_POST['manufacturing_technology_id'] == 0) {
                    $insert_sql = ('INSERT INTO manufacturing_technology SET
                    manufacturing_technology_id = NULL,
                    manufacturing_technology_name = "'.mysqli_real_escape_string($mysqli, $_POST['manufacturing_technology_name']).'",
                    manufacturing_technology_description = "' . mysqli_real_escape_string($mysqli, $_POST['manufacturing_technology_description']) . '"');
                    $result = mysqli_query($mysqli, $insert_sql);
                }
                else{
                    $update_sql = ('UPDATE manufacturing_technology SET
                    manufacturing_technology_name = "'.mysqli_real_escape_string($mysqli, $_POST['manufacturing_technology_name']).'",
                    manufacturing_technology_description = "'.mysqli_real_escape_string($mysqli, $_POST['manufacturing_technology_description']).'"
                    WHERE manufacturing_technology_id ='.$_POST['manufacturing_technology_id']);
                    $result = mysqli_query($mysqli, $update_sql);
                }
                break;
            case 6: // Принцип действия
                if ($_POST['operation_principle_id'] == 0) {
                    $insert_sql = ('INSERT INTO operation_principle SET
                    operation_principle_id = NULL,
                    operation_principle_name = "'.mysqli_real_escape_string($mysqli, $_POST['operation_principle_name']).'",
                    operation_principle_description = "' . mysqli_real_escape_string($mysqli, $_POST['operation_principle_description']) . '"');
                    $result = mysqli_query($mysqli, $insert_sql);
                }
                else{
                    $update_sql = ('UPDATE operation_principle SET
                    operation_principle_name = "'.mysqli_real_escape_string($mysqli, $_POST['operation_principle_name']).'",
                    operation_principle_description = "'.mysqli_real_escape_string($mysqli, $_POST['operation_principle_description']).'"
                    WHERE operation_principle_id ='.$_POST['operation_principle_id']);
                    $result = mysqli_query($mysqli, $update_sql);
                }
                break;
            case 7: // Тип датчика и измеряемая величина
                if ($_POST['measurable_value_id'] == 0){
                    $insert_sql = ('INSERT INTO measurable_value SET
                    measurable_value_id = NULL,
                    measurable_value_name = "'.mysqli_real_escape_string($mysqli, $_POST['measurable_value_name']).'"');
                    $result = mysqli_query($mysqli, $insert_sql);
                    $id = mysqli_insert_id($mysqli); // Получаем вбитый ID
                    if($_POST['sensor_type_id'] == 0){
                        $insert_sql = ('INSERT INTO sensor_type SET
                        sensor_type_id = NULL,
                        sensor_type_name = "'.mysqli_real_escape_string($mysqli, $_POST['sensor_type_name']).'",
                        measurable_value_id = '.$id);
                        $result = mysqli_query($mysqli, $insert_sql);
                    }else{
                        $update_sql = ('UPDATE sensor_type SET
                        sensor_type_name = "'.mysqli_real_escape_string($mysqli, $_POST['sensor_type_name']).'",
                        measurable_value_id = '.$id.'
                        WHERE sensor_type_id = '.$_POST['sensor_type_id']);
                        $result = mysqli_query($mysqli, $update_sql);
                    }
                }else{
                    $update_sql = ('UPDATE measurable_value SET
                    measurable_value_name = "'.mysqli_real_escape_string($mysqli, $_POST['measurable_value_name']).'"
                    WHERE measurable_value_id = '.$_POST['measurable_value_id']);
                    $result = mysqli_query($mysqli, $update_sql);
                    if($_POST['sensor_type_id'] == 0){
                        $insert_sql = ('INSERT INTO sensor_type SET
                        sensor_type_id = NULL,
                        sensor_type_name = "'.mysqli_real_escape_string($mysqli, $_POST['sensor_type_name']).'",
                        measurable_value_id = "' . mysqli_real_escape_string($mysqli, $_POST['measurable_value_id']) . '"');
                        $result = mysqli_query($mysqli, $insert_sql);
                    }else{
                        $update_sql = ('UPDATE sensor_type SET
                        sensor_type_name = "'.mysqli_real_escape_string($mysqli, $_POST['sensor_type_name']).'",
                        measurable_value_id = "' . mysqli_real_escape_string($mysqli, $_POST['measurable_value_id']) . '"
                        WHERE sensor_type_id = '.$_POST['sensor_type_id']);
                        $result = mysqli_query($mysqli, $update_sql);
                    }
                }
                break;
            case 8: // Чувствительный элемент
                if ($_POST['sensitive_element_id'] == 0) {
                    $insert_sql = ('INSERT INTO sensitive_element SET
                    sensitive_element_id = NULL,
                    sensitive_element_name = "'.mysqli_real_escape_string($mysqli, $_POST['sensitive_element_name']).'",
                    sensitive_element_description = "' . mysqli_real_escape_string($mysqli, $_POST['sensitive_element_description']) . '"');
                    $result = mysqli_query($mysqli, $insert_sql);
                }
                else{
                    $update_sql = ('UPDATE sensitive_element SET
                    sensitive_element_name = "'.mysqli_real_escape_string($mysqli, $_POST['sensitive_element_name']).'",
                    sensitive_element_description = "'.mysqli_real_escape_string($mysqli, $_POST['sensitive_element_description']).'"
                    WHERE sensitive_element_id ='.$_POST['sensitive_element_id']);
                    $result = mysqli_query($mysqli, $update_sql);
                }
                break;
            case 9: // Характер выходного сигнала
                if ($_POST['output_signal_id'] == 0) {
                    $insert_sql = ('INSERT INTO output_signal SET
                    output_signal_id = NULL,
                    output_signal_name = "'.mysqli_real_escape_string($mysqli, $_POST['output_signal_name']).'",
                    output_signal_description = "' . mysqli_real_escape_string($mysqli, $_POST['output_signal_description']) . '"');
                    $result = mysqli_query($mysqli, $insert_sql);
                }
                else{
                    $update_sql = ('UPDATE sensitive_element SET
                    output_signal_name = "'.mysqli_real_escape_string($mysqli, $_POST['output_signal_name']).'",
                    output_signal_description = "'.mysqli_real_escape_string($mysqli, $_POST['output_signal_description']).'"
                    WHERE output_signal_id ='.$_POST['output_signal_id']);
                    $result = mysqli_query($mysqli, $update_sql);
                }
                break;
            case 10: // Характер преобразования сигнала
                if ($_POST['signal_conversation_id'] == 0) {
                    $insert_sql = ('INSERT INTO signal_conversation SET
                    signal_conversation_id = NULL,
                    signal_conversation_name = "'.mysqli_real_escape_string($mysqli, $_POST['signal_conversation_name']).'",
                    signal_conversation_description = "' . mysqli_real_escape_string($mysqli, $_POST['signal_conversation_description']) . '"');
                    $result = mysqli_query($mysqli, $insert_sql);
                }
                else{
                    $update_sql = ('UPDATE sensitive_element SET
                    signal_conversation_name = "'.mysqli_real_escape_string($mysqli, $_POST['signal_conversation_name']).'",
                    signal_conversation_description = "'.mysqli_real_escape_string($mysqli, $_POST['signal_conversation_description']).'"
                    WHERE signal_conversation_id ='.$_POST['signal_conversation_id']);
                    $result = mysqli_query($mysqli, $update_sql);
                }
                break;
            case 11: // Тип прибора
                if ($_POST['device_type_id'] == 0) {
                    $insert_sql = ('INSERT INTO device_type SET
                    device_type_id = NULL,
                    device_type_name = "' . mysqli_real_escape_string($mysqli, $_POST['device_type_name']) . '"');
                    $result = mysqli_query($mysqli, $insert_sql);
                }
                else{
                    $update_sql = ('UPDATE device_type SET
                    device_type_name = "'.mysqli_real_escape_string($mysqli, $_POST['device_type_name']).'"
                    WHERE device_type_id ='.$_POST['device_type_id']);
                    $result = mysqli_query($mysqli, $update_sql);
                }
                break;
            case 12: // Назначение прибора
                if ($_POST['device_purpose_id'] == 0) {
                    $insert_sql = ('INSERT INTO device_purpose SET
                    device_purpose_id = NULL,
                    device_purpose_name = "' . mysqli_real_escape_string($mysqli, $_POST['device_purpose_name']) . '"');
                    $result = mysqli_query($mysqli, $insert_sql);
                }
                else{
                    $update_sql = ('UPDATE device_purpose SET
                    device_purpose_name = "'.mysqli_real_escape_string($mysqli, $_POST['device_purpose_name']).'"
                    WHERE device_purpose_id ='.$_POST['device_purpose_id']);
                    $result = mysqli_query($mysqli, $update_sql);
                }
                break;
            case 13: // Способ управления
                if ($_POST['control_type_id'] == 0) {
                    $insert_sql = ('INSERT INTO device_control_type SET
                    control_type_id = NULL,
                    control_type_name = "' . mysqli_real_escape_string($mysqli, $_POST['control_type_name']) . '"');
                    $result = mysqli_query($mysqli, $insert_sql);
                }
                else{
                    $update_sql = ('UPDATE device_control_type SET
                    control_type_name = "'.mysqli_real_escape_string($mysqli, $_POST['control_type_name']).'"
                    WHERE control_type_id ='.$_POST['control_type_id']);
                    $result = mysqli_query($mysqli, $update_sql);
                }
                break;
            case 14: // Воспроизведение измеряемой величины
                if ($_POST['measure_show_type_id'] == 0) {
                    $insert_sql = ('INSERT INTO device_measure_show_type SET
                    measure_show_type_id = NULL,
                    measure_show_type_name = "' . mysqli_real_escape_string($mysqli, $_POST['measure_show_type_name']) . '"');
                    $result = mysqli_query($mysqli, $insert_sql);
                }
                else{
                    $update_sql = ('UPDATE device_measure_show_type SET
                    measure_show_type_name = "'.mysqli_real_escape_string($mysqli, $_POST['measure_show_type_name']).'"
                    WHERE measure_show_type_id ='.$_POST['measure_show_type_id']);
                    $result = mysqli_query($mysqli, $update_sql);
                }
                break;
            default:
                break;
        }
        break;
}

if(!empty($errors)){
    $data = array(
        "error" => $errors
    );
}
$json_data = array(
    "data" =>  $data
);
echo json_encode($data, JSON_UNESCAPED_UNICODE);