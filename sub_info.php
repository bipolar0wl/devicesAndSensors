<?php
require_once('header.php');
?>
    <script type="text/javascript" src="js/sub_info.js"></script>
<div class="container">
    <div class="row align-items-center h-100">
        <div class="col-6 mx-auto">
            <div>
                <fieldset>
<?php
switch($_GET['key']){
    case 1:
        ?>
        <legend>Производители</legend>
        <div class="form-group row">
            <div class="col-sm-12">
                <select type="text" class="form-control form-control-sm" id="edit_producer" placeholder="Наименование" onchange="sub_change(1, <?php echo $_SESSION['logged_user']['status'] ?>)"><option value="0">Новый производитель</option>
                    <?php select_option("producer", $row['producer_id'], "producer_id", "producer_name", $mysqli); ?>
                </select>
            </div>
            <label for="edit_producer_name" class="col-sm-4 col-form-label">Наименование</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="edit_producer_name" placeholder="Наименование" value="<?php echo $row['producer_name']?>">
            </div>
            <label for="edit_producer_address" class="col-sm-4 col-form-label">Адрес</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="edit_producer_address" placeholder="Адрес" value="<?php echo $row['producer_address']?>">
            </div>
            <label for="edit_producer_phone" class="col-sm-4 col-form-label">Телефон</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="edit_producer_phone" placeholder="Телефон" value="<?php echo $row['producer_phone']?>">
            </div>
            <label for="edit_producer_website" class="col-sm-4 col-form-label">Веб сайт</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="edit_producer_website" placeholder="Веб сайт" value="<?php echo $row['producer_website']?>">
            </div>
            <label for="edit_producer_email" class="col-sm-4 col-form-label">E-mail</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="edit_producer_email" placeholder="E-mail" value="<?php echo $row['producer_email']?>">
            </div>
        </div>
        <?php
        break;
    case 2:
        ?>
        <legend>Литература</legend>
        <div class="form-group row">
            <div class="col-sm-12">
                <select type="text" class="form-control form-control-sm" id="edit_literature" placeholder="Наименование" onchange="sub_change(2, <?php echo $_SESSION['logged_user']['status'] ?>)"><option value="0">Новая литература</option>
                    <?php select_option("literature", $row['literature_id'], "literature_id", "literature_name", $mysqli); ?>
                </select>
            </div>
            <label for="edit_literature_name" class="col-sm-4 col-form-label">Наименование</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="edit_literature_name" placeholder="Наименование" value="<?php echo $row['literature_name']?>">
            </div>
            <label for="edit_literature_author" class="col-sm-4 col-form-label">Автор</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="edit_literature_author" placeholder="Автор" value="<?php echo $row['literature_author']?>">
            </div>
            <label for="edit_literature_date" class="col-sm-4 col-form-label">Дата выпуска</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="edit_literature_date" placeholder="Дата выпуска" value="<?php echo $row['literature_date']?>">
            </div>
            <label for="edit_literature_website" class="col-sm-4 col-form-label">Веб сайт</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="edit_literature_website" placeholder="Веб сайт" value="<?php echo $row['literature_website']?>">
            </div>
            <label for="edit_literature_publisher" class="col-sm-4 col-form-label">Издатель</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="edit_literature_publisher" placeholder="Издатель" value="<?php echo $row['literature_publisher']?>">
            </div>
        </div>
        <?php
        break;
    case 3:
        ?>
        <legend>Среда измерения</legend>
        <div class="form-group row">
            <div class="col-sm-12">
                <select type="text" class="form-control form-control-sm" id="edit_environment" placeholder="Наименование" onchange="sub_change(3, <?php echo $_SESSION['logged_user']['status'] ?>)"><option value="0">Новая среда измерения</option>
                    <?php select_option("environment", $row['environment_id'], "environment_id", "environment_name", $mysqli); ?>
                </select>
            </div>
            <label for="edit_environment_name" class="col-sm-4 col-form-label">Наименование</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="edit_environment_name" placeholder="Наименование" value="<?php echo $row['environment_name']?>">
            </div>
            <label for="edit_environment_description" class="col-sm-4 col-form-label">Описание</label>
            <div class="col-sm-12">
                <textarea type="text" class="form-control form-control-sm" id="edit_environment_description" placeholder="Описание"><?php echo $row['environment']?></textarea>
            </div>
        </div>
        <?php
        break;
    case 4:
        ?>
        <legend>Область применения</legend>
        <div class="form-group row">
            <div class="col-sm-12">
                <select type="text" class="form-control form-control-sm" id="edit_application_sphere" placeholder="Наименование" onchange="sub_change(4, <?php echo $_SESSION['logged_user']['status'] ?>)"><option value="0">Новая область применения</option>
                    <?php select_option("application_sphere", $row['application_sphere_id'], "application_sphere_id", "application_sphere_name", $mysqli); ?>
                </select>
            </div>
            <label for="edit_application_sphere_name" class="col-sm-4 col-form-label">Наименование</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="edit_application_sphere_name" placeholder="Наименование" value="<?php echo $row['application_sphere_name']?>">
            </div>
        </div>
        <?php
        break;
    case 5:
        ?>
        <legend>Технология изготовления</legend>
        <div class="form-group row">
            <div class="col-sm-12">
                <select type="text" class="form-control form-control-sm" id="edit_manufacturing_technology" placeholder="Наименование" onchange="sub_change(5, <?php echo $_SESSION['logged_user']['status'] ?>)"><option value="0">Новая технология изготовления</option>
                    <?php select_option("manufacturing_technology", $row['manufacturing_technology_id'], "manufacturing_technology_id", "manufacturing_technology_name", $mysqli); ?>
                </select>
            </div>
            <label for="edit_manufacturing_technology_name" class="col-sm-4 col-form-label">Наименование</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="edit_manufacturing_technology_name" placeholder="Наименование" value="<?php echo $row['manufacturing_technology_name']?>">
            </div>
            <label for="edit_manufacturing_technology_description" class="col-sm-4 col-form-label">Описание</label>
            <div class="col-sm-12">
                <textarea type="text" class="form-control form-control-sm" id="edit_manufacturing_technology_description" placeholder="Описание"><?php echo $row['manufacturing_technology_description']?></textarea>
            </div>
        </div>
        <?php
        break;
    case 6:
        ?>
        <legend>Принцип действия</legend>
        <div class="form-group row">
            <div class="col-sm-12">
                <select type="text" class="form-control form-control-sm" id="edit_operation_principle" placeholder="Наименование" onchange="sub_change(6, <?php echo $_SESSION['logged_user']['status'] ?>)"><option value="0">Новый принцип действия</option>
                    <?php select_option("operation_principle", $row['operation_principle_id'], "operation_principle_id", "operation_principle_name", $mysqli); ?>
                </select>
            </div>
            <label for="edit_operation_principle_name" class="col-sm-4 col-form-label">Наименование</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="edit_operation_principle_name" placeholder="Наименование" value="<?php echo $row['operation_principle_name']?>">
            </div>
            <label for="edit_operation_principle_description" class="col-sm-4 col-form-label">Описание</label>
            <div class="col-sm-12">
                <textarea type="text" class="form-control form-control-sm" id="edit_operation_principle_description" placeholder="Описание"><?php echo $row['operation_principle_description']?></textarea>
            </div>
        </div>
        <?php
        break;
    case 7:
        ?>
        <legend>Тип датчика</legend>
        <div class="form-group row">
            <div class="col-sm-12">
                <select type="text" class="form-control form-control-sm" id="edit_sensor_type" placeholder="Наименование" onchange="sub_change(7, <?php echo $_SESSION['logged_user']['status'] ?>)"><option value="0">Новый тип датчика</option>
                    <?php select_option("sensor_type", $row['sensor_type_id'], "sensor_type_id", "sensor_type_name", $mysqli); ?>
                </select>
            </div>
            <label for="edit_sensor_type_name" class="col-sm-4 col-form-label">Наименование</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="edit_sensor_type_name" placeholder="Наименование" value="<?php echo $row['sensor_type_name']?>">
            </div>
            <label for="edit_sensor_type" class="col col-form-label"><h5>Измеряемая величина</h5></label>
            <div class="col-sm-12">
                <select type="text" class="form-control form-control-sm" id="edit_measurable_value" placeholder="Наименование"><option value="0">Новая измеряемая величина</option>
                    <?php select_option_two("sensor_type", "sensor_type_id", $row['sensor_type_id'], "measurable_value", "measurable_value_id", "measurable_value_name", $mysqli); ?>
                </select>
            </div>
            <label for="edit_measurable_value_name" class="col-sm-4 col-form-label">Наименование</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="edit_measurable_value_name" placeholder="Наименование" value="<?php echo $row['measurable_value_name']?>">
            </div>
        </div>
        <?php
        break;
    case 8:
        ?>
        <legend>Чувствительный элемент</legend>
        <div class="form-group row">
            <div class="col-sm-12">
                <select type="text" class="form-control form-control-sm" id="edit_sensitive_element" placeholder="Наименование" onchange="sub_change(8, <?php echo $_SESSION['logged_user']['status'] ?>)"><option value="0">Новый чувствительный элемент</option>
                    <?php select_option("sensitive_element", $row['sensitive_element_id'], "sensitive_element_id", "sensitive_element_name", $mysqli); ?>
                </select>
            </div>
            <label for="edit_sensitive_element_name" class="col-sm-4 col-form-label">Наименование</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="edit_sensitive_element_name" placeholder="Наименование" value="<?php echo $row['sensitive_element_name']?>">
            </div>
            <label for="edit_sensitive_element_description" class="col-sm-4 col-form-label">Описание</label>
            <div class="col-sm-12">
                <textarea type="text" class="form-control form-control-sm" id="edit_sensitive_element_description" placeholder="Описание"><?php echo $row['sensitive_element_description']?></textarea>
            </div>
        </div>
        <?php
        break;
    case 9:
        ?>
        <legend>Характер выходного сигнала</legend>
        <div class="form-group row">
            <div class="col-sm-12">
                <select type="text" class="form-control form-control-sm" id="edit_output_signal" placeholder="Наименование" onchange="sub_change(9, <?php echo $_SESSION['logged_user']['status'] ?>)"><option value="0">Новый характер выходного сигнала</option>
                    <?php select_option("output_signal", $row['output_signal_id'], "output_signal_id", "output_signal_name", $mysqli); ?>
                </select>
            </div>
            <label for="edit_output_signal_name" class="col-sm-4 col-form-label">Наименование</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="edit_output_signal_name" placeholder="Наименование" value="<?php echo $row['output_signal_name']?>">
            </div>
            <label for="edit_output_signal_description" class="col-sm-4 col-form-label">Описание</label>
            <div class="col-sm-12">
                <textarea type="text" class="form-control form-control-sm" id="edit_output_signal_description" placeholder="Описание"><?php echo $row['output_signal_description']?></textarea>
            </div>
        </div>
        <?php
        break;
    case 10:
        ?>
        <legend>Характер преобразования сигнала</legend>
        <div class="form-group row">
            <div class="col-sm-12">
                <select type="text" class="form-control form-control-sm" id="edit_signal_conversation" placeholder="Наименование" onchange="sub_change(10, <?php echo $_SESSION['logged_user']['status'] ?>)"><option value="0">Новый характер преобразования сигнала</option>
                    <?php select_option("signal_conversation", $row['signal_conversation_id'], "signal_conversation_id", "signal_conversation_name", $mysqli); ?>
                </select>
            </div>
            <label for="edit_signal_conversation_name" class="col-sm-4 col-form-label">Наименование</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="edit_signal_conversation_name" placeholder="Наименование" value="<?php echo $row['signal_conversation_name']?>">
            </div>
            <label for="edit_signal_conversation_description" class="col-sm-4 col-form-label">Описание</label>
            <div class="col-sm-12">
                <textarea type="text" class="form-control form-control-sm" id="edit_signal_conversation_description" placeholder="Описание"><?php echo $row['signal_conversation_description']?></textarea>
            </div>
        </div>
        <?php
        break;
    case 11:
        ?>
        <legend>Тип прибора</legend>
        <div class="form-group row">
            <div class="col-sm-12">
                <select type="text" class="form-control form-control-sm" id="edit_device_type" placeholder="Наименование" onchange="sub_change(11, <?php echo $_SESSION['logged_user']['status'] ?>)"><option value="0">Новый тип прибора</option>
                    <?php select_option("device_type", $row['device_type_id'], "device_type_id", "device_type_name", $mysqli); ?>
                </select>
            </div>
            <label for="edit_device_type_name" class="col-sm-4 col-form-label">Наименование</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="edit_device_type_name" placeholder="Наименование" value="<?php echo $row['device_type_name']?>">
            </div>
        </div>
        <?php
        break;
    case 12:
        ?>
        <legend>Назначение прибора</legend>
        <div class="form-group row">
            <div class="col-sm-12">
                <select type="text" class="form-control form-control-sm" id="edit_device_purpose" placeholder="Наименование" onchange="sub_change(12, <?php echo $_SESSION['logged_user']['status'] ?>)"><option value="0">Новое назначение прибора</option>
                    <?php select_option("device_purpose", $row['device_purpose_id'], "device_purpose_id", "device_purpose_name", $mysqli); ?>
                </select>
            </div>
            <label for="edit_device_purpose_name" class="col-sm-4 col-form-label">Наименование</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="edit_device_purpose_name" placeholder="Наименование" value="<?php echo $row['device_purpose_name']?>">
            </div>
        </div>
        <?php
        break;
    case 13:
        ?>
        <legend>Способ управления</legend>
        <div class="form-group row">
            <div class="col-sm-12">
                <select type="text" class="form-control form-control-sm" id="edit_device_control_type" placeholder="Наименование" onchange="sub_change(13, <?php echo $_SESSION['logged_user']['status'] ?>)"><option value="0">Новый способ управления</option>
                    <?php select_option("device_control_type", $row['control_type_id'], "control_type_id", "control_type_name", $mysqli); ?>
                </select>
            </div>
            <label for="edit_control_type_name" class="col-sm-4 col-form-label">Наименование</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="edit_control_type_name" placeholder="Наименование" value="<?php echo $row['control_type_name']?>">
            </div>
        </div>
        <?php
        break;
    case 14:
        ?>
        <legend>Воспроизведение измеряемой величины</legend>
        <div class="form-group row">
            <div class="col-sm-12">
                <select type="text" class="form-control form-control-sm" id="edit_device_measure_show_type" placeholder="Наименование" onchange="sub_change(14, <?php echo $_SESSION['logged_user']['status'] ?>)"><option value="0">Новый характер преобразования сигнала</option>
                    <?php select_option("device_measure_show_type", $row['measure_show_type_id'], "measure_show_type_id", "measure_show_type_name", $mysqli); ?>
                </select>
            </div>
            <label for="edit_measure_show_type_name" class="col-sm-4 col-form-label">Наименование</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="edit_measure_show_type_name" placeholder="Наименование" value="<?php echo $row['measure_show_type_name']?>">
            </div>
        </div>
        <?php
        break;
    default:
        break;
}
?>
                </fieldset>
                <?php
                if ($_SESSION['logged_user']['status'] > 1) { ?>
                    <div class="mx-auto row justify-content-end">
                        <button type="submit" id="edit_save_changes" class="btn btn-outline-primary center-block" onclick="save_changes(<?php echo $_GET['key'] ?>)">Добавить</button>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php
include_once("footer.php");
function select_option($table, $id, $sub_id, $sub_name, $mysqli){
    $select_sql_sub = ('SELECT * FROM '.$table);
    $result_sub = mysqli_query($mysqli, $select_sql_sub);
    while ($row_sub = mysqli_fetch_assoc($result_sub)){
        if($row_sub[$sub_id] == $id){
            echo '<option selected value="' . $row_sub[$sub_id] . '">' . $row_sub[$sub_name] . '</option>';
        }
        else {
            echo '<option value="' . $row_sub[$sub_id] . '">' . $row_sub[$sub_name] . '</option>';
        }
    }
}
function select_option_two($sup_table, $sup_id, $id, $sub_table, $sub_id, $sub_name, $mysqli){
    $select_sql_sup = ('SELECT '.$sub_id.' FROM '.$sup_table.' WHERE '.$sup_id .' = '.$id);
    $result_sup = mysqli_query($mysqli, $select_sql_sup);
    $row_sup = mysqli_fetch_assoc($result_sup);
    $select_sql_sub = ('SELECT * FROM '.$sub_table);
    $result_sub = mysqli_query($mysqli, $select_sql_sub);
    while ($row_sub = mysqli_fetch_assoc($result_sub)){
        if($row_sub[$sub_id] == $row_sup[$sub_id]){
            echo '<option selected value="' . $row_sub[$sub_id] . '">' . $row_sub[$sub_name] . '</option>';
        }
        else {
            echo '<option value="' . $row_sub[$sub_id] . '">' . $row_sub[$sub_name] . '</option>';
        }
    }
}
function select_multiple($sup_table, $sup_id, $id, $sub_table, $sub_id, $sub_name, $mysqli){
    $select_sql_sup = ('SELECT * FROM '.$sup_table.' WHERE '.$sup_id.' = '.$id);
    $result_sup = mysqli_query($mysqli, $select_sql_sup);
    $included = array();
    while ($row_sup = mysqli_fetch_assoc($result_sup)) {
        $included[] = $row_sup[$sub_id];
    }
    $select_sql_sub = ('SELECT * FROM '.$sub_table);
    $result_sub = mysqli_query($mysqli, $select_sql_sub);
    while ($row_sub = mysqli_fetch_assoc($result_sub)){
        if(in_array($row_sub[$sub_id], $included)){
            echo '<option selected value="' . $row_sub[$sub_id] . '">' . $row_sub[$sub_name] . '</option>';
        }
        else {
            echo '<option value="' . $row_sub[$sub_id] . '">' . $row_sub[$sub_name] . '</option>';
        }
    }
}