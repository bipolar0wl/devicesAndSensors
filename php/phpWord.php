<?php
require_once('../php/dbSelect.php');

$id = $_GET['id'];
$product_type = $_GET['product_type'];
if ($product_type == "sensor") {
    $select_sql = ('SELECT * FROM sensors ');
}else{
    $select_sql = ('SELECT * FROM devices ');
}
if ($id != 0) {
    if ($product_type == "sensor") {
        $select_sql .= (' LEFT JOIN producer ON sensors.producer_id = producer.producer_id 
        LEFT JOIN sensor_type ON sensors.sensor_type_id = sensor_type.sensor_type_id 
        LEFT JOIN measurable_value ON sensor_type.measurable_value_id = measurable_value.measurable_value_id 
        LEFT JOIN sensitive_element ON sensors.sensitive_element_id = sensitive_element.sensitive_element_id 
        LEFT JOIN operation_principle ON sensors.operation_principle_id = operation_principle.operation_principle_id 
        LEFT JOIN output_signal ON sensors.output_signal_id = output_signal.output_signal_id 
        LEFT JOIN signal_conversation ON sensors.signal_conversation_id = signal_conversation.signal_conversation_id');
    }
    else{
        $select_sql .= (' LEFT JOIN producer ON devices.producer_id = producer.producer_id
        LEFT JOIN device_type ON devices.device_type_id = device_type.device_type_id 
        LEFT JOIN device_purpose ON devices.device_purpose_id = device_purpose.device_purpose_id 
        LEFT JOIN operation_principle ON devices.operation_principle_id = operation_principle.operation_principle_id 
        LEFT JOIN device_control_type ON devices.control_type_id = device_control_type.control_type_id 
        LEFT JOIN device_measure_show_type ON devices.measure_show_type_id = device_measure_show_type.measure_show_type_id');
    }
}
if ($product_type == "sensor") {
    $select_sql .= (' WHERE sensor_id = ' . $id);
} else {
    $select_sql .= (' WHERE device_id = ' . $id);
}
$result = mysqli_query($mysqli, $select_sql);
$row = mysqli_fetch_assoc($result);

require '..\vendor\autoload.php';
$phpWord = new  \PhpOffice\PhpWord\PhpWord();

$phpWord->setDefaultFontName('Times New Roman');
$phpWord->setDefaultFontSize(12);

//$section = $phpWord->addSection();
//$footer = $section->addFooter();
//$textRun = $footer->addTextRun(array('alignment' => Jc::CENTER));
//$textRun->addField('PAGE', array('format' => 'ROMAN'));
//$textRun->addText(' of ');
//$textRun->addField('NUMPAGES', array('format' => 'ROMAN'));

$section = $phpWord->addSection();
if ($product_type == "sensor") {
    $section->addText('Датчик - '.$row['name'], array('name' => 'Times New Roman', 'size' => 14, 'bold' => true));
}
else{
    $section->addText('Прибор - '.$row['name'], array('name' => 'Times New Roman', 'size' => 14, 'bold' => true));
}

$footer = $section->addFooter();
$textRun = $footer->addTextRun(['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::END]);
$textRun->addField('PAGE');
$textRun->addText(' из ');
$textRun->addField('NUMPAGES');

$table = $section->addTable(['borderColor' => '000000', 'borderSize'  => 6, 'cellMargin'  => 50, 'name' => 'Times New Roman', 'size' => 12]);
$table->addRow();
$cell = $table->addCell(null, ['gridSpan' => 2])->addText('Основные параметры', ['bold' => true]);
if ($product_type == "sensor") {
    $table->addRow();
    $cell = $table->addCell()->addText('Тип датчика');
    $cell = $table->addCell()->addText($row['sensor_type_name']);
    $table->addRow();
    $cell = $table->addCell()->addText('Измеряемая величина');
    $cell = $table->addCell()->addText($row['measurable_value_name']);
    $table->addRow();
    $cell = $table->addCell()->addText('Чувствительный элемент');
    $cell = $table->addCell()->addText($row['sensitive_element_name']);
    $table->addRow();
    $cell = $table->addCell()->addText('Принцип действия');
    $cell = $table->addCell()->addText($row['operation_principle_name']);
    $table->addRow();
    $cell = $table->addCell()->addText('Характер выходного сигнала');
    $cell = $table->addCell()->addText($row['output_signal_name']);
    $table->addRow();
    $cell = $table->addCell()->addText('Характер преобразования сигнала');
    $cell = $table->addCell()->addText($row['signal_conversation_name']);
}else{
    $table->addRow();
    $cell = $table->addCell()->addText('Тип прибора');
    $cell = $table->addCell()->addText($row['device_type_name']);
    $table->addRow();
    $cell = $table->addCell()->addText('Назначение');
    $cell = $table->addCell()->addText($row['device_purpose_name']);
    $table->addRow();
    $cell = $table->addCell()->addText('Принцип действия');
    $cell = $table->addCell()->addText($row['operation_principle_name']);
    $table->addRow();
    $cell = $table->addCell()->addText('Способ управления');
    $cell = $table->addCell()->addText($row['control_type_name']);
    $table->addRow();
    $cell = $table->addCell()->addText('Способ воспроизведения измеряемой величины');
    $cell = $table->addCell()->addText($row['measure_show_type_name']);
}
$table->addRow();
$cell = $table->addCell()->addText('Технология изготовления');
$cell = $table->addCell()->addText($row['name']);
$table->addRow();
$cell = $table->addCell()->addText('Погрешность измерения, %');
$cell = $table->addCell()->addText($row['measurement_error']);
$table->addRow();
$cell = $table->addCell(null, ['gridSpan' => 2])->addText('Описание', ['bold' => true]);
$table->addRow();
$cell = $table->addCell(null, ['gridSpan' => 2])->addText($row['description']);

$table->addRow();
$cell = $table->addCell(null, ['gridSpan' => 2])->addText('Диапазон измерений', ['bold' => true]);
$table->addRow();
$cell = $table->addCell()->addText('Нижняя граница измерений');
$cell = $table->addCell()->addText($row['measure_min']);
$table->addRow();
$cell = $table->addCell()->addText('Верхняя граница измерений');
$cell = $table->addCell()->addText($row['measure_max']);
$table->addRow();
$cell = $table->addCell()->addText('Единица измерения величины');
$cell = $table->addCell()->addText($row['unit_of_measuring']);

$table->addRow();
$cell = $table->addCell(null, ['gridSpan' => 2])->addText('Диапазон температур окружающей среды', ['bold' => true]);
$table->addRow();
$cell = $table->addCell()->addText('Минимальная температура');
$cell = $table->addCell()->addText($row['lower_temperature_threshold']);
$table->addRow();
$cell = $table->addCell()->addText('Максимальная температура');
$cell = $table->addCell()->addText($row['upper_temperature_threshold']);
$table->addRow();
$cell = $table->addCell()->addText('Единица измерения температуры');
$cell = $table->addCell()->addText($row['temperature_unit']);

$section->addPageBreak();
$table = $section->addTable(['borderColor' => '000000', 'borderSize'  => 6, 'cellMargin'  => 50, 'name' => 'Times New Roman', 'size' => 12]);
$table->addRow();
$cell = $table->addCell(null, ['gridSpan' => 2])->addText('Габаритные размеры и вес', ['bold' => true]);
$table->addRow();
$cell = $table->addCell()->addText('Длина');
$cell = $table->addCell()->addText($row['length']);
$table->addRow();
$cell = $table->addCell()->addText('Ширина');
$cell = $table->addCell()->addText($row['width']);
$table->addRow();
$cell = $table->addCell()->addText('Высота');
$cell = $table->addCell()->addText($row['height']);
$table->addRow();
$cell = $table->addCell()->addText('Диаметр');
$cell = $table->addCell()->addText($row['diameter']);
$table->addRow();
$cell = $table->addCell()->addText('Единица измерения длины');
$cell = $table->addCell()->addText($row['unit_of_length']);
$table->addRow();
$cell = $table->addCell()->addText('Вес');
$cell = $table->addCell()->addText($row['weight']);
$table->addRow();
$cell = $table->addCell()->addText('Единица измерения веса');
$cell = $table->addCell()->addText($row['unit_of_weight']);

$table->addRow();
$cell = $table->addCell(null, ['gridSpan' => 2])->addText('Дополнительно', ['bold' => true]);
$table->addRow();
$cell = $table->addCell()->addText('Питание(Вольт)');
$cell = $table->addCell()->addText($row['power']);
$table->addRow();
$cell = $table->addCell()->addText('Класс защиты');
$cell = $table->addCell()->addText($row['protection_class']);
if ($product_type == "sensor") {
    $table->addRow();
    $cell = $table->addCell()->addText('Ресурс работы(Часы)');
    $cell = $table->addCell()->addText($row['resource']);
    $table->addRow();
    $cell = $table->addCell()->addText('Количество измерительных каналов');
    $cell = $table->addCell()->addText($row['measuring_channels']);
}else{
    $table->addRow();
    $cell = $table->addCell()->addText('Наработка (Часов)');
    $cell = $table->addCell()->addText($row['resource']);
    $table->addRow();
    $cell = $table->addCell()->addText('Выходное напряжение');
    $cell = $table->addCell()->addText($row['output_voltage']);
    $table->addRow();
    $cell = $table->addCell()->addText('Входное сопротивление');
    $cell = $table->addCell()->addText($row['in_resistance']);
    $table->addRow();
    $cell = $table->addCell()->addText('Выходное сопротивление');
    $cell = $table->addCell()->addText($row['out_resistance']);
}
// Динамические характеристики
$section->addPageBreak();
$table = $section->addTable(['borderColor' => '000000', 'borderSize'  => 6, 'cellMargin'  => 50, 'name' => 'Times New Roman', 'size' => 12]);
$table->addRow();
$cell = $table->addCell(null, ['gridSpan' => 2])->addText('Динамические характеристики', ['bold' => true]);
$table->addRow();
$cell = $table->addCell()->addText('Коэффициент смещения');
$cell = $table->addCell()->addText($row['dynamic_shift_factor']);
$table->addRow();
$cell = $table->addCell()->addText('Коэффициент демпфирования');
$cell = $table->addCell()->addText($row['dynamic_damping_factor']);
$table->addRow();
$cell = $table->addCell()->addText('Постоянная времени (сек)');
$cell = $table->addCell()->addText($row['dynamic_time_constant']);
$table->addRow();
$cell = $table->addCell()->addText('Время разогрева');
$cell = $table->addCell()->addText($row['dynamic_warm_up_time']);
$table->addRow();
$cell = $table->addCell()->addText('Минимальная частота среза (Герц)');
$cell = $table->addCell()->addText($row['dynamic_cutoff_frequency_min']);
$table->addRow();
$cell = $table->addCell()->addText('Максимальная частота среза (Герц)');
$cell = $table->addCell()->addText($row['dynamic_cutoff_frequency_max']);
$table->addRow();
$cell = $table->addCell()->addText('Резонансная частота (Герц)');
$cell = $table->addCell()->addText($row['dynamic_resonant_frequency']);
$table->addRow();
$cell = $table->addCell()->addText('Динамическая погрешность (%)');
$cell = $table->addCell()->addText($row['dynamic_error']);
$table->addRow();
$cell = $table->addCell()->addText('Дополнительные сведения');
$cell = $table->addCell()->addText($row['dynamic_description']);
if ($row['dynamic_frequency_response']) {
    $table->addRow();
    $cell = $table->addCell(null, ['gridSpan' => 2])->addText('Динамические характеристики', ['bold' => true]);
    $table->addRow();
    $cell = $table->addCell(null, ['gridSpan' => 2])->addImage('../' . $row['dynamic_frequency_response'], ['width' => 400, 'height' => 400]);
}
// Производитель
$section->addPageBreak();
$table = $section->addTable(['borderColor' => '000000', 'borderSize'  => 6, 'cellMargin'  => 50, 'name' => 'Times New Roman', 'size' => 12]);
$table->addRow();
$cell = $table->addCell(null, ['gridSpan' => 2])->addText('Производитель', ['bold' => true]);
$table->addRow();
$cell = $table->addCell()->addText('Наименование');
$cell = $table->addCell()->addText($row['producer_name']);
$table->addRow();
$cell = $table->addCell()->addText('Адрес');
$cell = $table->addCell()->addText($row['producer_address']);
$table->addRow();
$cell = $table->addCell()->addText('Телефон');
$cell = $table->addCell()->addText($row['producer_phone']);
$table->addRow();
$cell = $table->addCell()->addText('Веб сайт');
$cell = $table->addCell()->addText($row['producer_website']);
$table->addRow();
$cell = $table->addCell()->addText('E-mail');
$cell = $table->addCell()->addText($row['producer_email']);
// Литература
if ($product_type == "sensor") {
    $select_sql_sub = ('SELECT * FROM `sensor_literature` LEFT JOIN `literature` ON sensor_literature.literature_id = literature.literature_id WHERE sensor_id = '.$id);
}else{
    $select_sql_sub = ('SELECT * FROM `device_literature` LEFT JOIN `literature` ON device_literature.literature_id = literature.literature_id WHERE device_id = '.$id);
}
$result_sub = mysqli_query($mysqli, $select_sql_sub);
$i = 1;
while ($row_sub = mysqli_fetch_assoc($result_sub)){
    $section->addTextBreak();
    $table = $section->addTable(['borderColor' => '000000', 'borderSize'  => 6, 'cellMargin'  => 50, 'name' => 'Times New Roman', 'size' => 12]);
    $table->addRow();
    $cell = $table->addCell(null, ['gridSpan' => 2])->addText('Литература №'.$i, ['bold' => true]);
    $table->addRow();
    $cell = $table->addCell()->addText('Наименование');
    $cell = $table->addCell()->addText($row_sub['literature_name']);
    $table->addRow();
    $cell = $table->addCell()->addText('Автор');
    $cell = $table->addCell()->addText($row_sub['literature_author']);
    $table->addRow();
    $cell = $table->addCell()->addText('Дата');
    $cell = $table->addCell()->addText($row_sub['literature_date']);
    $table->addRow();
    $cell = $table->addCell()->addText('Издательство');
    $cell = $table->addCell()->addText($row_sub['literature_publisher']);
    $i++;
}
// Среда измерения
if ($product_type == "sensor") {
    $select_sql_sub = ('SELECT * FROM `sensor_environment` LEFT JOIN `environment` ON sensor_environment.environment_id = environment.environment_id WHERE sensor_id = '.$id);
}else{
    $select_sql_sub = ('SELECT * FROM `device_environment` LEFT JOIN `environment` ON device_environment.environment_id = environment.environment_id WHERE device_id = '.$id);
}
$result_sub = mysqli_query($mysqli, $select_sql_sub);
$i = 1;
while ($row_sub = mysqli_fetch_assoc($result_sub)){
    $section->addTextBreak();
    $table = $section->addTable(['borderColor' => '000000', 'borderSize'  => 6, 'cellMargin'  => 50, 'name' => 'Times New Roman', 'size' => 12]);
    $table->addRow();
    $cell = $table->addCell(null, ['gridSpan' => 2])->addText('Среда измерения №'.$i, ['bold' => true]);
    $table->addRow();
    $cell = $table->addCell()->addText('Наименование');
    $cell = $table->addCell()->addText($row_sub['environment_name']);
    $i++;
}
// Область применения
if ($product_type == "sensor") {
    $select_sql_sub = ('SELECT * FROM `sensor_application_sphere` LEFT JOIN `application_sphere` ON sensor_application_sphere.application_sphere_id = application_sphere.application_sphere_id WHERE sensor_id = '.$id);
}else{
    $select_sql_sub = ('SELECT * FROM `device_application_sphere` LEFT JOIN `application_sphere` ON device_application_sphere.application_sphere_id = application_sphere.application_sphere_id WHERE device_id = '.$id);
}
$result_sub = mysqli_query($mysqli, $select_sql_sub);
$i = 1;
while ($row_sub = mysqli_fetch_assoc($result_sub)){
    $section->addTextBreak();
    $table = $section->addTable(['borderColor' => '000000', 'borderSize'  => 6, 'cellMargin'  => 50, 'name' => 'Times New Roman', 'size' => 12]);
    $table->addRow();
    $cell = $table->addCell(null, ['gridSpan' => 2])->addText('Область применения №'.$i, ['bold' => true]);
    $table->addRow();
    $cell = $table->addCell()->addText('Наименование');
    $cell = $table->addCell()->addText($row_sub['application_sphere_name']);
    $i++;
}
// Датчики и измеряемые величины (Для приборов)
if ($product_type != "sensor") {
    $select_sql_sub = ('SELECT * FROM sensors LEFT JOIN sensors_in_devices ON sensors.sensor_id = sensors_in_devices.sensor_id WHERE device_id ='.$id);
    $result_sub = mysqli_query($mysqli, $select_sql_sub);
    $i = 1;
    while ($row_sub = mysqli_fetch_assoc($result_sub)){
        $section->addTextBreak();
        $table = $section->addTable(['borderColor' => '000000', 'borderSize'  => 6, 'cellMargin'  => 50, 'name' => 'Times New Roman', 'size' => 12]);
        $table->addRow();
        $cell = $table->addCell(null, ['gridSpan' => 2])->addText('Датчик №'.$i, ['bold' => true]);
        $table->addRow();
        $cell = $table->addCell()->addText('Наименование');
        $cell = $table->addCell()->addText($row_sub['name']);
        $i++;
    }
    $select_sql_sub = ('SELECT * FROM measurable_value LEFT JOIN device_measurable_value ON measurable_value.measurable_value_id = device_measurable_value.measurable_value_id WHERE device_id ='.$id);
    $result_sub = mysqli_query($mysqli, $select_sql_sub);
    $i = 1;
    while ($row_sub = mysqli_fetch_assoc($result_sub)){
        $section->addTextBreak();
        $table = $section->addTable(['borderColor' => '000000', 'borderSize'  => 6, 'cellMargin'  => 50, 'name' => 'Times New Roman', 'size' => 12]);
        $table->addRow();
        $cell = $table->addCell(null, ['gridSpan' => 2])->addText('Измеряемая величина №'.$i, ['bold' => true]);
        $table->addRow();
        $cell = $table->addCell()->addText('Наименование');
        $cell = $table->addCell()->addText($row_sub['measurable_value_name']);
        $i++;
    }
}
// Изображения
if ($row['picture'] OR $row['blueprint'] OR $row['scheme']) {
    $section->addPageBreak();
    $table = $section->addTable(['borderColor' => '000000', 'borderSize' => 6, 'cellMargin' => 50, 'name' => 'Times New Roman', 'size' => 12]);
    if ($row['picture']) {
        $table->addRow();
        $cell = $table->addCell(null, ['gridSpan' => 2])->addText('Изображение', ['bold' => true]);
        $table->addRow();
        $cell = $table->addCell(null, ['gridSpan' => 2])->addImage('../' . $row['picture'], ['height' => 180]);
    }
    if ($row['blueprint']) {
        $table->addRow();
        $cell = $table->addCell(null, ['gridSpan' => 2])->addText('Чертеж', ['bold' => true]);
        $table->addRow();
        $cell = $table->addCell(null, ['gridSpan' => 2])->addImage('../' . $row['blueprint'], ['height' => 180]);
    }
    if ($row['scheme']) {
        $table->addRow();
        $cell = $table->addCell(null, ['gridSpan' => 2])->addText('Схема', ['bold' => true]);
        $table->addRow();
        $cell = $table->addCell(null, ['gridSpan' => 2])->addImage('../' . $row['scheme'], ['height' => 180]);
    }
}

header("Content-Description: File Transfer");
if ($product_type == "sensor") {
    header('Content-Disposition: attachment; filename="Датчик - ' . $row['name'] . '.docx"');
}else{
    header('Content-Disposition: attachment; filename="Прибор - '.$row['name']. '.docx"');
}
//header('Content-Disposition: attachment; filename="' . $product_type .'-'.$id. '.docx"');
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');

$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save("php://output");
//$objWriter->save('doc.docx');