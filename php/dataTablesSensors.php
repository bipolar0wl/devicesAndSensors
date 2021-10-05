<?php
require_once('dbSelect.php');
$data = array();

$select_sql = "";
//($_POST['countSensor'])
//    ? $select_sql .= ('SELECT (sensor_id) AS id, name, sensor_type.sensor_type_name AS type, measurement_error, measure_min, measure_max, unit_of_measuring, resource, weight, unit_of_weight, length, width, height, unit_of_length FROM sensors LEFT JOIN sensor_type ON sensors.sensor_type_id = sensor_type.sensor_type_id')
//    : "";
//($_POST['countSensor'] && $_POST['countDevice']) ? $select_sql .= (' UNION ALL ') : "";
//($_POST['countDevice'])
//    ? $select_sql .= ('SELECT -(device_id), name, device_type.device_type_name AS type, measurement_error, measure_min, measure_max, unit_of_measuring, resource, weight, unit_of_weight, length, width, height, unit_of_length FROM devices LEFT JOIN device_type ON devices.device_type_id = device_type.device_type_id')
//    : "";
if(($_POST['filter_sensitive_element'] != 0) OR ($_POST['filter_output_signal'] != 0) OR ($_POST['filter_signal_conversation']  != 0) OR (strlen(trim($_POST['filter_measuring_channels'])))){
    $select_sql .= ('SELECT * FROM (SELECT (sensor_id) AS id, name, sensor_type.sensor_type_id AS type_id, sensor_type.sensor_type_name AS type, measurement_error, measure_min, measure_max, unit_of_measuring, resource, weight, unit_of_weight, length, width, height, unit_of_length, deleted, sensitive_element_id, output_signal_id, signal_conversation_id, operation_principle_id, manufacturing_technology_id, upper_temperature_threshold, lower_temperature_threshold, temperature_unit, power, protection_class, measuring_channels, user_id FROM sensors LEFT JOIN sensor_type ON sensors.sensor_type_id = sensor_type.sensor_type_id) AS t ');
}
elseif(($_POST['filter_device_purpose'] != 0) OR ($_POST['filter_control_type'] != 0) OR ($_POST['filter_measure_show_type']  != 0) OR (strlen(trim($_POST['filter_output_voltage']))) OR (strlen(trim($_POST['filter_in_resistance']))) OR (strlen(trim($_POST['filter_out_resistance'])))){
    $select_sql .= ('SELECT * FROM (SELECT -(device_id) AS id, name, -(device_type.device_type_id) AS type_id, device_type.device_type_name AS type, measurement_error, measure_min, measure_max, unit_of_measuring, resource, weight, unit_of_weight, length, width, height, unit_of_length, deleted, device_purpose_id, control_type_id, measure_show_type_id, operation_principle_id, manufacturing_technology_id, upper_temperature_threshold, lower_temperature_threshold, temperature_unit, power, protection_class, output_voltage, in_resistance, out_resistance, user_id FROM devices LEFT JOIN device_type ON devices.device_type_id = device_type.device_type_id) AS t ');
}
else{
    $select_sql .= ('SELECT * FROM (
 SELECT (sensor_id) AS id, name, sensor_type.sensor_type_id AS type_id, sensor_type.sensor_type_name AS type, measurement_error, measure_min, measure_max, unit_of_measuring, resource, weight, unit_of_weight, length, width, height, unit_of_length, operation_principle_id, manufacturing_technology_id, upper_temperature_threshold, lower_temperature_threshold, temperature_unit, power, protection_class, user_id, deleted FROM sensors LEFT JOIN sensor_type ON sensors.sensor_type_id = sensor_type.sensor_type_id
 UNION ALL
 SELECT -(device_id), name, -(device_type.device_type_id), device_type.device_type_name, measurement_error, measure_min, measure_max, unit_of_measuring, resource, weight, unit_of_weight, length, width, height, unit_of_length, operation_principle_id, manufacturing_technology_id, upper_temperature_threshold, lower_temperature_threshold, temperature_unit, power, protection_class, user_id, deleted FROM devices LEFT JOIN device_type ON devices.device_type_id = device_type.device_type_id
 ) AS t ');
}
/* При объединении с помощью UNION результаты второго запроса получают структуру первого, то есть, если первый параметр первого
запроса (ID), а первый параметр второго (newID), в итоге они объединятся под значением (ID), поэтому чтобы как-то различать где датчик,
а где прибор, у последнего просто будет отрицательный ID, похожий прием будет использован при добавлении нового изделия,
впрочем это уже совсем другая история. */

$select_sql .= (' WHERE ');
($_POST['productTypeSelect'] != 0)? $select_sql .= (' type_id = '.$_POST['productTypeSelect'].' AND ') : "";
// Датчики
($_POST['filter_sensitive_element'] != 0)? $select_sql .= (' sensitive_element_id = '.$_POST['filter_sensitive_element'].' AND ') : "";
($_POST['filter_output_signal'] != 0)? $select_sql .= (' output_signal_id = '.$_POST['filter_output_signal'].' AND ') : "";
($_POST['filter_signal_conversation'] != 0)? $select_sql .= (' signal_conversation_id = '.$_POST['filter_signal_conversation'].' AND ') : "";
// Приборы
($_POST['filter_device_purpose'] != 0)? $select_sql .= (' device_purpose_id = '.$_POST['filter_device_purpose'].' AND ') : "";
($_POST['filter_control_type'] != 0)? $select_sql .= (' control_type_id = '.$_POST['filter_control_type'].' AND ') : "";
($_POST['filter_measure_show_type'] != 0)? $select_sql .= (' measure_show_type_id = '.$_POST['filter_measure_show_type'].' AND ') : "";
// Общие
($_POST['filter_operation_principle'] != 0)? $select_sql .= (' operation_principle_id = '.$_POST['filter_operation_principle'].' AND ') : ""; // Принцип действия
($_POST['filter_manufacturing_technology'] != 0)? $select_sql .= (' manufacturing_technology_id = '.$_POST['filter_manufacturing_technology'].' AND ') : "";  // Технология изготовления
//isset($_POST['filter_max_measurement_error'])? $select_sql .= (' measurement_error <= '.$_POST['filter_max_measurement_error'].' OR measurement_error IS NULL AND ') : "";
is_numeric($_POST['filter_max_measurement_error'])? $select_sql .= (' measurement_error <= '.$_POST['filter_max_measurement_error'].' AND ') : ""; // Максимальная погрешность
// Диапазон измерений
is_numeric($_POST['filter_max_measurement'])? $select_sql .= (' measure_max <= '.$_POST['filter_max_measurement'].' AND ') : ""; // Максимальное значение измерения
is_numeric($_POST['filter_min_measurement'])? $select_sql .= (' measure_min >= '.$_POST['filter_min_measurement'].' AND ') : ""; // Минимальное значение измерения
strlen(trim($_POST['filter_unit_of_measuring']))? $select_sql .= (' unit_of_measuring LIKE "%'.trim($_POST['filter_unit_of_measuring']).'%" AND ') : ""; // Единица измерения величины
// Диапазон температур
is_numeric($_POST['filter_max_temperature'])? $select_sql .= (' upper_temperature_threshold <= '.$_POST['filter_max_temperature'].' AND ') : ""; // Максимальная температура
is_numeric($_POST['filter_min_temperature'])? $select_sql .= (' lower_temperature_threshold >= '.$_POST['filter_min_temperature'].' AND ') : "";// Минимальная температура
strlen(trim($_POST['filter_temperature_unit']))? $select_sql .= (' temperature_unit LIKE "%'.trim($_POST['filter_temperature_unit']).'%" AND ') : "";// Единица измерения температуры
// Габаритные размеры и масса
is_numeric($_POST['filter_max_length'])? $select_sql .= (' length <= '.$_POST['filter_max_length'].' AND ') : ""; // Максимальная длина
is_numeric($_POST['filter_max_width'])? $select_sql .= (' width <= '.$_POST['filter_max_width'].' AND ') : ""; // Максимальная ширина
is_numeric($_POST['filter_max_height'])? $select_sql .= (' height <= '.$_POST['filter_max_height'].' AND ') : ""; // Максимальная высота
strlen(trim($_POST['filter_unit_of_length']))? $select_sql .= (' unit_of_length LIKE "%'.trim($_POST['filter_unit_of_length']).'%" AND ') : ""; // Единица измерения длины
is_numeric($_POST['filter_max_weight'])? $select_sql .= (' weight <= '.$_POST['filter_max_weight'].' AND ') : ""; // Максимальная масса
strlen(trim($_POST['filter_unit_of_weight']))? $select_sql .= (' unit_of_weight LIKE "%'.trim($_POST['filter_unit_of_weight']).'%" AND ') : ""; // Единица измерения массы
// Дополнительно
strlen(trim($_POST['filter_power']))? $select_sql .= (' power LIKE "%'.trim($_POST['filter_power']).'%" AND ') : ""; // Питание (Вольт)
strlen(trim($_POST['filter_protection_class']))? $select_sql .= (' protection_class LIKE "%'.trim($_POST['filter_protection_class']).'%" AND ') : ""; // Класс защиты
is_numeric($_POST['filter_resource'])? $select_sql .= (' resource >= '.$_POST['filter_resource'].' AND ') : "";
// Датчики
strlen(trim($_POST['filter_measuring_channels']))? $select_sql .= (' measuring_channels LIKE "%'.trim($_POST['filter_measuring_channels']).'%" AND ') : ""; // Количество измерительных каналов
// Приборы
strlen(trim($_POST['filter_output_voltage']))? $select_sql .= (' output_voltage LIKE "%'.trim($_POST['filter_output_voltage']).'%" AND ') : ""; // Выходное напряжение
strlen(trim($_POST['filter_in_resistance']))? $select_sql .= (' in_resistance LIKE "%'.trim($_POST['filter_in_resistance']).'%" AND ') : ""; // Входное сопротивление
strlen(trim($_POST['filter_out_resistance']))? $select_sql .= (' out_resistance LIKE "%'.trim($_POST['filter_out_resistance']).'%" AND ') : ""; // Выходное сопротивление

($_POST['countSensor'] && $_POST['countDevice']) ? $select_sql .= " 1 AND " : ( // 1 1
($_POST['countSensor'] && !$_POST['countDevice']) ? $select_sql .= " id > 0 AND " : (// 1 0
(!$_POST['countSensor'] && $_POST['countDevice']) ? $select_sql .= " id < 0 AND " : // 0 1
    $select_sql .= " id = 0 AND "));
$select_sql .= (' deleted != 1 ORDER BY name ASC');
if( // Если есть параметры поиск уникальные для датчиков или приборов, исключаем из поиска все
    (($_POST['filter_sensitive_element'] != 0) OR ($_POST['filter_output_signal'] != 0) OR ($_POST['filter_signal_conversation']  != 0) OR (strlen(trim($_POST['filter_measuring_channels'])))) AND
    (($_POST['filter_device_purpose'] != 0) OR ($_POST['filter_control_type'] != 0) OR ($_POST['filter_measure_show_type'] != 0) OR (strlen(trim($_POST['filter_output_voltage']))) OR (strlen(trim($_POST['filter_in_resistance']))) OR (strlen(trim($_POST['filter_out_resistance']))))
){
    $data = "";
}
else{
    $result = mysqli_query($mysqli, $select_sql);
    if ($result);
    while ($row = mysqli_fetch_assoc($result)) {
        $subdata = array();
        $subdata[] = $row['name']; // Название
        ($row['id']>0) ? $subdata[] = "Датчик" : $subdata[] = "Прибор"; // Изделие
        ($row['type']) ? $subdata[] = $row['type'] : $subdata[] = ""; // Тип изделия
        isset($row['measurement_error']) ? $subdata[] = $row['measurement_error'].' %': $subdata[] = ""; // Погрешность
        if (isset($row['measure_min']) AND isset($row['measure_max'])){ // 1 1
            $subdata[] = $row['measure_min']. ' — ' . $row['measure_max'] . ' ' .$row['unit_of_measuring']; // Диапазон иземерений
        }
        elseif (isset($row['measure_min']) AND !isset($row['measure_max'])){ // 1 0
            $subdata[] = '> '.$row['measure_min']. ' ' .$row['unit_of_measuring']; // Диапазон иземерений
        }
        elseif (!isset($row['measure_min']) AND isset($row['measure_max'])){ // 0 1
            $subdata[] = '< ' . $row['measure_max'] . ' ' .$row['unit_of_measuring']; // Диапазон иземерений
        }
        else{ // 0 0
            $subdata[] = ""; // Диапазон иземерений
        }
        ($row['resource']) ? $subdata[] = $row['resource']." ч" : $subdata[] = ""; // Ресурс
        ($row['weight']) ? $subdata[] = $row['weight']. ' ' . $row['unit_of_weight'] : $subdata[] = ""; // Вес
        if ($row['length'] AND $row['width'] AND $row['height']){ // 1 1 1
            $subdata[] = $row['length'].'<i>L</i> &#10005 '.$row['width'].'<i>W</i> &#10005 '.$row['height']. '<i>H</i> ' . $row['unit_of_length']; // Габариты
        }
        elseif ($row['length'] AND $row['width'] AND !$row['height']){ // 1 1 0
            $subdata[] = $row['length'].'<i>L</i> &#10005 '.$row['width'].'<i>W</i> ' . $row['unit_of_length']; // Габариты
        }
        elseif ($row['length'] AND !$row['width'] AND $row['height']){ // 1 0 1
            $subdata[] = $row['length'].'<i>L</i> &#10005 '.$row['height']. '<i>H</i> ' . $row['unit_of_length']; // Габариты
        }
        elseif ($row['length'] AND !$row['width'] AND !$row['height']){ // 1 0 0
            $subdata[] = $row['length'].'<i>L</i> ' . $row['unit_of_length']; // Габариты
        }
        elseif (!$row['length'] AND $row['width'] AND $row['height']){ // 0 1 1
            $subdata[] = $row['width'].'<i>W</i> &#10005 '.$row['height'].'<i>H</i> ' . $row['unit_of_length']; // Габариты
        }
        elseif (!$row['length'] AND $row['width'] AND !$row['height']){ // 0 1 0
            $subdata[] = $row['width'].'<i>W</i> ' . $row['unit_of_length']; // Габариты
        }
        elseif (!$row['length'] AND !$row['width'] AND $row['height']){ // 0 0 1
            $subdata[] = $row['height'].'<i>H</i> ' . $row['unit_of_length']; // Габариты
        }
        else{ // 0 0 0
            $subdata[] = ""; // Габариты
        }
        if ($row['id'] > 0){
            $product_type = "sensor";
        }
        else{
            $product_type = "device";
        }
        $row['id'] = abs($row['id']);
        if ($_SESSION['logged_user']['status'] > 2 OR ($_SESSION['logged_user']['status'] >1 AND $_SESSION['logged_user']['user_id'] == $row['user_id'])) {
            $subdata[] = '<b style="white-space: nowrap">
        <a href="../product.php?id=' . $row['id'] . '&product_type=' . $product_type . '" class="btn btn-primary btn-sm"  title="Подробная информация">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-box-arrow-in-down-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M9.636 2.5a.5.5 0 0 0-.5-.5H2.5A1.5 1.5 0 0 0 1 3.5v10A1.5 1.5 0 0 0 2.5 15h10a1.5 1.5 0 0 0 1.5-1.5V6.864a.5.5 0 0 0-1 0V13.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
            <path fill-rule="evenodd" d="M5 10.5a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 0-1H6.707l8.147-8.146a.5.5 0 0 0-.708-.708L6 9.293V5.5a.5.5 0 0 0-1 0v5z"/>
            </svg>
        </a>
        <a href="../php/phpWord.php?id=' . $row['id'] . '&product_type=' . $product_type . '" class="btn btn-primary btn-sm"  title="Скачать документ">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-word" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M5.485 6.879a.5.5 0 1 0-.97.242l1.5 6a.5.5 0 0 0 .967.01L8 9.402l1.018 3.73a.5.5 0 0 0 .967-.01l1.5-6a.5.5 0 0 0-.97-.242l-1.036 4.144-.997-3.655a.5.5 0 0 0-.964 0l-.997 3.655L5.485 6.88z"/>
              <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
            </svg>
        </a>
        <a id="getDelete" data-toggle="modal" data-target="#myModal" data-id="' . $row['id'] . '" data-product_type="' . $product_type . '" class="btn btn-danger btn-sm" title="Удалить изделие">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
        </a>
        </b>';
        }else{
            $subdata[] = '<b style="white-space: nowrap">
        <a href="../php/phpWord.php?id=' . $row['id'] . '&product_type=' . $product_type . '" class="btn btn-primary btn-sm"  title="Скачать документ">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-word" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M5.485 6.879a.5.5 0 1 0-.97.242l1.5 6a.5.5 0 0 0 .967.01L8 9.402l1.018 3.73a.5.5 0 0 0 .967-.01l1.5-6a.5.5 0 0 0-.97-.242l-1.036 4.144-.997-3.655a.5.5 0 0 0-.964 0l-.997 3.655L5.485 6.88z"/>
              <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
            </svg>
        </a>
        <a href="../product.php?id=' . $row['id'] . '&product_type=' . $product_type . '" class="btn btn-primary btn-sm"  title="Подробная информация">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-box-arrow-in-down-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M9.636 2.5a.5.5 0 0 0-.5-.5H2.5A1.5 1.5 0 0 0 1 3.5v10A1.5 1.5 0 0 0 2.5 15h10a1.5 1.5 0 0 0 1.5-1.5V6.864a.5.5 0 0 0-1 0V13.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
            <path fill-rule="evenodd" d="M5 10.5a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 0-1H6.707l8.147-8.146a.5.5 0 0 0-.708-.708L6 9.293V5.5a.5.5 0 0 0-1 0v5z"/>
            </svg>
        </a>
        </b>';
        }
        $data[] = $subdata;
    }
}

$json_data = array(
    "data" => $data
);
echo json_encode($json_data, JSON_UNESCAPED_UNICODE);