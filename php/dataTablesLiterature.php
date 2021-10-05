<?php
require_once('dbSelect.php');
$data = array();

if ($_POST['product_type'] == "sensor") {
    $select_sql = ('SELECT * FROM literature LEFT JOIN sensor_literature ON literature.literature_id = sensor_literature.literature_id ');
}
else{
    $select_sql = ('SELECT * FROM literature LEFT JOIN device_literature ON literature.literature_id = device_literature.literature_id ');
}
$result = mysqli_query($mysqli, $select_sql);
$subdata = array();
$subdata[] = '<input type="text" id="new_literature_name" placeholder="Наименование" style="width: 570px">'; // Наименование
$subdata[] = '<input type="text" id="new_literature_author" placeholder="Автор" style="width: 200px">'; // Автор
//$subdata[] = '<input type="text" id="new_literature_publisher" placeholder="Издатель">'; // Издатель
$subdata[] = '<input type="text" id="new_literature_date" placeholder="Дата" style="width: 70px">'; // Год издания
//$subdata[] = '<input type="text" id="new_literature_website" placeholder="Сайт">'; // Сайт
$subdata[] = '<input type="button" id="new_literature_add" value="Добавить">'; // Включено
$data[] = $subdata;
while ($row = mysqli_fetch_assoc($result)) {
    $subdata = array();
    $subdata[] = $row['literature_name']; // Наименование
    $subdata[] = $row['literature_author']; // Автор
//    $subdata[] = $row['literature_publisher']; // Издатель
    $subdata[] = $row['literature_date']; // Год издания
//    $subdata[] = $row['literature_website']; // Сайт
    $subdata[] = '<input type="checkbox">'; // Включено
    $data[] = $subdata;
}
$json_data = array(
    "data" =>  $data
);
echo json_encode($json_data, JSON_UNESCAPED_UNICODE);