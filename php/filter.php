<?php
require_once('dbSelect.php');

$productTypeSelect; // Тип датчика или прибора
// Основные параметры
// Датчики
$sensitive_element; // Чувствительный элемент
$output_signal; // Характер выходного сигнала
$signal_conversation; // Характер преобразования сигнала
// Приборы
$device_purpose; // Назначение
$control_type; // Способ управления
$measure_show_type; // Способ воспроизведения измеряемой величины
// Общие
$operation_principle; // Принцип действия
$manufacturing_technology; // Технология изготовления
$max_measurement_error;; // Максимальная погрешность
// Диапазон измерений
$max_measurement; // Максимальное значение измерения
$min_measurement; // Минимальное значение измерения
$unit_of_measuring; // Единица измерения величины
// Диапазон температур
$max_temperature; // Максимальная температура
$min_temperature; // Минимальная температура
$temperature_unit; // Единица измерения температуры
// Габаритные размеры и масса
$max_length; // Максимальная длина
$max_width; // Максимальная ширина
$max_height; // Максимальная высота
$unit_of_length; // Единица измерения длины
$max_weight; // Максимальная масса
$unit_of_weight; // Единица измерения массы
// Дополнительно
$power; // Питание (Вольт)
$protection_class; // Класс защиты
$min_resource; // Минимальный ресурс (в часах)
// Датчики
$measuring_channels; // Количество измерительных каналов
// Приборы
$output_voltage; // Выходное напряжение
$in_resistance; // Входное сопротивление
$out_resistance; // Выходное сопротивление

$select_sql = ('SELECT sensor_type_id AS type_id, sensor_type_name AS type_name FROM sensor_type
 UNION ALL SELECT -(device_type_id), device_type_name FROM device_type ORDER BY type_name ASC');
$result = mysqli_query($mysqli, $select_sql);
while ($row = mysqli_fetch_assoc($result)) {
    $productTypeSelect[$row['type_id']] .= $row['type_name'];
}

// Датчики

$select_sql = ('SELECT * FROM sensitive_element ORDER BY sensitive_element_name');
$result = mysqli_query($mysqli, $select_sql);
$sensitive_element = '<label>Чувствительный элемент</label><br>
<select class="table_filter_select" id="filter_sensitive_element"><option value="0">Не выбрано</option>';
while ($row = mysqli_fetch_assoc($result)) {
    $sensitive_element .= '<option value="'.$row['sensitive_element_id'].'">'.$row['sensitive_element_name'].'</option>';
}
$sensitive_element .= '</select>';

$select_sql = ('SELECT * FROM output_signal ORDER BY output_signal_name');
$result = mysqli_query($mysqli, $select_sql);
$output_signal = '<label>Характер выходного сигнала</label><br>
<select class="table_filter_select" id="filter_output_signal"><option value="0">Не выбрано</option>';
while ($row = mysqli_fetch_assoc($result)) {
    $output_signal .= '<option value="'.$row['output_signal_id'].'">'.$row['output_signal_name'].'</option>';
}
$output_signal .= '</select>';

$select_sql = ('SELECT * FROM signal_conversation ORDER BY signal_conversation_name');
$result = mysqli_query($mysqli, $select_sql);
$signal_conversation = '<label>Характер преобразования сигнала</label><br>
<select class="table_filter_select" id="filter_signal_conversation"><option value="0">Не выбрано</option>';
while ($row = mysqli_fetch_assoc($result)) {
    $signal_conversation .= '<option value="'.$row['signal_conversation_id'].'">'.$row['signal_conversation_name'].'</option>';
}
$signal_conversation .= '</select>';

// Приборы

$select_sql = ('SELECT * FROM device_purpose ORDER BY device_purpose_name');
$result = mysqli_query($mysqli, $select_sql);
$device_purpose = '<label>Назначение прибора</label><br>
<select class="table_filter_select" id="filter_device_purpose"><option value="0">Не выбрано</option>';
while ($row = mysqli_fetch_assoc($result)) {
    $device_purpose .= '<option value="'.$row['device_purpose_id'].'">'.$row['device_purpose_name'].'</option>';
}
$device_purpose .= '</select>';

$select_sql = ('SELECT * FROM device_control_type ORDER BY control_type_name');
$result = mysqli_query($mysqli, $select_sql);
$control_type = '<label>Способ управления</label><br>
<select class="table_filter_select" id="filter_control_type"><option value="0">Не выбрано</option>';
while ($row = mysqli_fetch_assoc($result)) {
    $control_type .= '<option value="'.$row['control_type_id'].'">'.$row['control_type_name'].'</option>';
}
$control_type .= '</select>';

$select_sql = ('SELECT * FROM device_measure_show_type ORDER BY measure_show_type_name');
$result = mysqli_query($mysqli, $select_sql);
$measure_show_type = '<label>Способ воспроизведения измеряемой величины</label><br>
<select class="table_filter_select" id="filter_measure_show_type"><option value="0">Не выбрано</option>';
while ($row = mysqli_fetch_assoc($result)) {
    $measure_show_type .= '<option value="'.$row['measure_show_type_id'].'">'.$row['measure_show_type_name'].'</option>';
}
$measure_show_type .= '</select>';

// Общие

$select_sql = ('SELECT * FROM operation_principle ORDER BY operation_principle_name');
$result = mysqli_query($mysqli, $select_sql);
$operation_principle = '<label>Принцип действия</label><br>
<select class="table_filter_select" id="filter_operation_principle"><option value="0">Не выбрано</option>';
while ($row = mysqli_fetch_assoc($result)) {
    $operation_principle .= '<option value="'.$row['operation_principle_id'].'">'.$row['operation_principle_name'].'</option>';
}
$operation_principle .= '</select>';

$select_sql = ('SELECT * FROM manufacturing_technology ORDER BY manufacturing_technology_name');
$result = mysqli_query($mysqli, $select_sql);
$manufacturing_technology = '<label>Технология изготовления</label><br>
<select class="table_filter_select" id="filter_manufacturing_technology"><option value="0">Не выбрано</option>';
while ($row = mysqli_fetch_assoc($result)) {
    $manufacturing_technology .= '<option value="'.$row['manufacturing_technology_id'].'">'.$row['manufacturing_technology_name'].'</option>';
}
$manufacturing_technology .= '</select>';

$select_sql = ('SELECT MAX(measurement_error) FROM (SELECT MAX(measurement_error) AS measurement_error FROM sensors WHERE measurement_error > 0 AND deleted = 0 UNION ALL SELECT MAX(measurement_error) FROM devices WHERE measurement_error > 0 AND deleted = 0) AS t');
$result = mysqli_query($mysqli, $select_sql);
$row = mysqli_fetch_assoc($result);
$max_measurement_error = $row['MAX(measurement_error)'];

// Диапазон измерений
$select_sql = ('SELECT MAX(measure_max) FROM (SELECT MAX(measure_max) AS measure_max FROM sensors WHERE deleted = 0 UNION ALL SELECT MAX(measure_max) FROM devices WHERE deleted = 0) AS t');
$result = mysqli_query($mysqli, $select_sql);
$row = mysqli_fetch_assoc($result);
$max_measurement = $row['MAX(measure_max)']; // Максимальное значение измерения
$select_sql = ('SELECT MIN(measure_min) FROM (SELECT MIN(measure_min) AS measure_min FROM sensors WHERE deleted = 0 UNION ALL SELECT MIN(measure_min) FROM devices WHERE deleted = 0) AS t');
$result = mysqli_query($mysqli, $select_sql);
$row = mysqli_fetch_assoc($result);
$min_measurement = $row['MIN(measure_min)']; // Минимальное значение измерения
$unit_of_measuring; // Единица измерения величины
// Диапазон температур
$select_sql = ('SELECT MAX(upper_temperature_threshold) FROM (SELECT MAX(upper_temperature_threshold) AS upper_temperature_threshold FROM sensors WHERE deleted = 0 UNION ALL SELECT MAX(upper_temperature_threshold) FROM devices WHERE deleted = 0) AS t');
$result = mysqli_query($mysqli, $select_sql);
$row = mysqli_fetch_assoc($result);
$max_temperature = $row['MAX(upper_temperature_threshold)']; // Максимальная температура
$select_sql = ('SELECT MIN(lower_temperature_threshold) FROM (SELECT MIN(lower_temperature_threshold) AS lower_temperature_threshold FROM sensors WHERE deleted = 0 UNION ALL SELECT MIN(lower_temperature_threshold) FROM devices WHERE deleted = 0) AS t');
$result = mysqli_query($mysqli, $select_sql);
$row = mysqli_fetch_assoc($result);
$min_temperature = $row['MIN(lower_temperature_threshold)']; // Минимальная температура
$temperature_unit; // Единица измерения температуры
// Габаритные размеры и масса
$select_sql = ('SELECT MAX(length) FROM (SELECT MAX(length) AS length FROM sensors WHERE deleted = 0 UNION ALL SELECT MAX(length) FROM devices WHERE deleted = 0) AS t');
$result = mysqli_query($mysqli, $select_sql);
$row = mysqli_fetch_assoc($result);
$max_length = $row['MAX(length)']; // Максимальная длина
$select_sql = ('SELECT MAX(width) FROM (SELECT MAX(width) AS width FROM sensors WHERE deleted = 0 UNION ALL SELECT MAX(width) FROM devices WHERE deleted = 0) AS t');
$result = mysqli_query($mysqli, $select_sql);
$row = mysqli_fetch_assoc($result);
$max_width = $row['MAX(width)']; // Максимальная ширина
$select_sql = ('SELECT MAX(height) FROM (SELECT MAX(height) AS height FROM sensors WHERE deleted = 0 UNION ALL SELECT MAX(height) FROM devices WHERE deleted = 0) AS t');
$result = mysqli_query($mysqli, $select_sql);
$row = mysqli_fetch_assoc($result);
$max_height = $row['MAX(height)']; // Максимальная высота
$unit_of_length; // Единица измерения длины
$select_sql = ('SELECT MAX(weight) FROM (SELECT MAX(weight) AS weight FROM sensors WHERE deleted = 0 UNION ALL SELECT MAX(weight) FROM devices WHERE deleted = 0) AS t');
$result = mysqli_query($mysqli, $select_sql);
$row = mysqli_fetch_assoc($result);
$max_weight = $row['MAX(weight)']; // Максимальная масса
$unit_of_weight; // Единица измерения массы
// Дополнительно
$power; // Питание (Вольт)
$protection_class; // Класс защиты
// Минимальный ресурс (в часах)
$select_sql = ('SELECT MAX(resource) FROM (SELECT MAX(resource) AS resource FROM sensors WHERE resource > 0 AND deleted = 0 UNION ALL SELECT MAX(resource) FROM devices WHERE resource > 0 AND deleted = 0) AS t');
$result = mysqli_query($mysqli, $select_sql);
$row = mysqli_fetch_assoc($result);
$max_resource = $row['MAX(resource)'];
// Датчики
$measuring_channels; // Количество измерительных каналов
// Приборы
$output_voltage; // Выходное напряжение
$in_resistance; // Входное сопротивление
$out_resistance; // Выходное сопротивление


$data = array(
    // Основные параметры
    'productTypeSelect' => $productTypeSelect, // Тип датчика или прибора
    // Датчики
    'sensitive_element' => $sensitive_element, // Чувствительный элемент
    'output_signal' => $output_signal, // Характер выходного сигнала
    'signal_conversation' => $signal_conversation, // Характер преобразования сигнала
    // Приборы
    'device_purpose' => $device_purpose, // Назначение
    'control_type' => $control_type, // Способ управления
    'measure_show_type' => $measure_show_type, // Способ воспроизведения измеряемой величины
    // Общие
    'operation_principle' => $operation_principle, // Принцип действия
    'manufacturing_technology' => $manufacturing_technology, // Технология изготовления
    'max_measurement_error' => $max_measurement_error, // Максимальная погрешность
    // Диапазон измерений
    'max_measurement' => $max_measurement, // Максимальное значение измерения
    'min_measurement' => $min_measurement, // Минимальное значение измерения
    'unit_of_measuring' => $unit_of_measuring, // Единица измерения величины
    // Диапазон температур
    'max_temperature' => $max_temperature, // Максимальная температура
    'min_temperature' => $min_temperature, // Минимальная температура
    'temperature_unit' => $temperature_unit, // Единица измерения температуры
    // Габаритные размеры и масса
    'max_length' => $max_length, // Максимальная длина
    'max_width' => $max_width, // Максимальная ширина
    'max_height' => $max_height, // Максимальная высота
    'unit_of_length' => $unit_of_length, // Единица измерения длины
    'max_weight' => $max_weight, // Максимальная масса
    'unit_of_weight' => $unit_of_weight, // Единица измерения массы
    // Дополнительно
    'power' => $power, // Питание (Вольт)
    'protection_class' => $protection_class, // Класс защиты
    'resource' => $max_resource, // Минимальный ресурс (в часах)
    // Датчики
    'measuring_channels' => $measuring_channels, // Количество измерительных каналов
    // Приборы
    'output_voltage' => $output_voltage, // Выходное напряжение
    'in_resistance' => $in_resistance, // Входное сопротивление
    'out_resistance' => $out_resistance, // Выходное сопротивление
);
echo json_encode($data, JSON_UNESCAPED_UNICODE);