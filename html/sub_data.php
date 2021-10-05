<?php
require_once('../php/dbSelect.php');
?>
<fieldset class="sub_data">
    <?php
switch ($_POST['key']){
    // Общие параметры
    case 1: // Производители
        ?>
    <legend>Производители</legend>
    <select>
        <?php select_options("producer", "producer_id", "producer_name", $mysqli); ?>
    </select><br>
    <label>Адрес</label><input type="text" id="edit_producer_address" placeholder="Адрес"><br>
    <label>Телефон</label><input type="text" id="edit_producer_phone" placeholder="Телефон"><br>
    <label>Веб сайт</label><input type="text" id="edit_producer_website" placeholder="Веб сайт"><br>
    <label>E-mail</label><input type="text" id="edit_producer_email" placeholder="E-mail"><br>
    <?php
        break;
    case 2: // Литература
        ?>
        <legend>Литература</legend>
        <select>
            <?php select_options("literature", "literature_id", "literature_name", $mysqli); ?>
        </select><br>
        <label>Автор</label><input type="text" id="edit_literature_author" placeholder="Автор"><br>
        <label>Издатель</label><input type="text" id="edit_literature_publisher" placeholder="Издатель"><br>
        <label>Год издания</label><input type="text" id="edit_literature_date" placeholder="Год издания"><br>
        <label>Сайт</label><input type="text" id="edit_literature_website" placeholder="Сайт"><br>
        <?php
        break;
    case 3: // Среды измерения
        ?>
        <legend>Среды измерения</legend>
        <select>
            <?php select_options("environment", "environment_id", "environment_name", $mysqli); ?>
        </select><br>
        <label>Описание</label><textarea id="edit_environment_description" placeholder="Описание"></textarea><br>
        <?php
        break;
    case 4: // Области применения
        break;
    case 5: // Технологии изготовления
        break;
    case 6: // Принципы действия
        break;
    // Параметры датчиков
    case 7: // Типы датчиков
        break;
    case 8: // Чувствительные элементы
        break;
    case 9: // Типы выходных сигналов
        break;
    case 10: // Типы преобразования сигналов
        break;
    // Параметры приборов
    case 11: // Типы приборов
        break;
    case 12: // Назначения
        break;
    case 13: // Способы управления
        break;
    case 14: // Воспроизведение измеряемой величины
        break;
    default:
        break;
}
?>
    <button onclick="edit_sub_data(<?php echo $_POST['key'] ?>)">Подвтердить изменения</button></fieldset>
<?php

//$json_data = array(
//    "data" => $data
//);

//echo json_encode($json_data, JSON_UNESCAPED_UNICODE);

function select_options($table, $id, $name, $mysqli){
    $select_sql = ('SELECT * FROM '.$table);
    $result = mysqli_query($mysqli, $select_sql);
    echo '<option value="0">Не выбрано</option>';
    while ($row = mysqli_fetch_assoc($result)){
        echo '<option value="' . $row[$id] . '">' . $row[$name] . '</option>';
    }
}