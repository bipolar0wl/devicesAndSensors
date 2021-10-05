<?php
require_once('header.php');

$id = $_GET['id'];
if ($id == 0){
    $id = -$_SESSION['logged_user']['user_id'];
}
$product_type = $_GET['product_type'];

if ($product_type == "sensor") {
    $select_sql = ('SELECT * FROM sensors ');
}
else{
    $select_sql = ('SELECT * FROM devices ');
}
if ($id != 0) {
    if ($product_type == "sensor") {
        $select_sql .= (' LEFT JOIN producer ON sensors.producer_id = producer.producer_id');
    }
    else{
        $select_sql .= (' LEFT JOIN producer ON devices.producer_id = producer.producer_id');
    }
}
if ($product_type == "sensor") {
    $select_sql .= (' WHERE sensor_id = ' . $id);
} else {
    $select_sql .= (' WHERE device_id = ' . $id);
}
$result = mysqli_query($mysqli, $select_sql);
$row = mysqli_fetch_assoc($result);
// Проверка, есть ли уровень доступа или создал ли пользователь это изделие
if($_SESSION['logged_user']['status'] < 3 AND $_SESSION['logged_user']['user_id'] != $row['user_id']) {
    ?>
    <script>
        $('#product-form input[type!="radio"], #product-form select, #product-form textarea').attr('disabled', true)
    </script>
    <?php
}
?>
<!--<div style="display: grid; width: 100%; height: 100%">-->
<div style="display: grid; left: 0px">
    <form id="product-form">
    <div id="heading" ><b style="font-size: 16px">
        <?php
        if ($product_type == "sensor"){
            echo '<label>Датчик </label>';
        }
        else{
            echo '<label>Прибор </label>';
        }
        ?>
        <input type="text" id="id" hidden value="<?php echo $id ?>">
        <input type="text" id="type_of_product" hidden value="<?php echo $product_type ?>">
        <input type="text" id="name" placeholder="Наименование" style="font-size: 16px" value="<?php echo $row['name'] ?>"></b>
    </div>
        <div class="tabs">
            <input type="radio" class="tab-header" name="tab-btn" id="tab-btn-1" checked><label for="tab-btn-1" style="width: 80px">Основные параметры</label>
<!--            <input type="radio" class="tab-header" name="tab-btn" id="tab-btn-1" checked><label for="tab-btn-6" style="width: 100px">Изображения и схемы</label>-->
            <input type="radio" class="tab-header" name="tab-btn" id="tab-btn-2"><label for="tab-btn-2" style="width: 120px">Динамические характеристики</label>
            <input type="radio" class="tab-header" name="tab-btn" id="tab-btn-3"><label for="tab-btn-3" style="width: 120px">Производитель и литература</label>
            <input type="radio" class="tab-header" name="tab-btn" id="tab-btn-4"><label for="tab-btn-4">Среда измерения и область применения</label>
            <input type="radio" class="tab-header" name="tab-btn" id="tab-btn-5"><label for="tab-btn-5" style="width: 150px">Изображения и доп. характеристики</label>
            <?php if ($product_type == "device"){ ?>
            <input type="radio" class="tab-header" name="tab-btn" id="tab-btn-6"><label for="tab-btn-6" style="max-width: 172px; width: 172px">Датчики и измеряемые величины</label>
            <?php } ?>
            <div id="content-1" class="tab-content">
                <fieldset>
                    <legend>Основные параметры</legend>
                    <?php
                    if ($product_type == "sensor"){
                        ?>
                        <label>Тип датчика</label><select id="product_type" class="product_select" onchange="select_sensor_type()" placeholder="Тип датчика"><option value="0">Не выбрано</option>
                            <?php select_option("sensor_type", $row['sensor_type_id'], "sensor_type_id", "sensor_type_name", $mysqli); ?>
                        </select><br>
                        <label>Измеряемая величина</label><select id="measurable_value" placeholder="Измеряемая величина""><option value="0">Не выбрано</option>
                            <?php select_option_two("sensor_type", "sensor_type_id", $row['sensor_type_id'], "measurable_value", "measurable_value_id", "measurable_value_name", $mysqli); ?>
                        </select><br>
                        <label>Чувствительный элемент</label><select id="sensitive_element" placeholder="Чувствительный элемент"><option value="0">Не выбрано</option>
                            <?php select_option("sensitive_element", $row['sensitive_element_id'], "sensitive_element_id", "sensitive_element_name", $mysqli); ?>
                        </select><br>
                        <label>Принцип действия</label><select id="operation_principle" placeholder="Принцип действия"><option value="0">Не выбрано</option>
                            <?php select_option("operation_principle", $row['operation_principle_id'], "operation_principle_id", "operation_principle_name", $mysqli); ?>
                        </select><br>
                        <label>Характер выходного сигнала</label><select id="output_signal" placeholder="Характер выходного сигнала"><option value="0">Не выбрано</option>
                            <?php select_option("output_signal", $row['output_signal_id'], "output_signal_id", "output_signal_name", $mysqli); ?>
                        </select><br>
                        <label>Характер преобразования сигнала</label><select id="signal_conversation" placeholder="Характер преобразования сигнала"><option value="0">Не выбрано</option>
                            <?php select_option("signal_conversation", $row['signal_conversation_id'], "signal_conversation_id", "signal_conversation_name", $mysqli); ?>
                        </select><br>
                        <label>Технология изготовления</label><select id="manufacturing_technology" placeholder="Технология изготовления"><option value="0">Не выбрано</option>
                            <?php select_option("manufacturing_technology", $row['manufacturing_technology_id'], "manufacturing_technology_id", "manufacturing_technology_name", $mysqli); ?>
                        </select><br>
                        <?php
                    }
                    else{
                        ?>
                        <label>Тип прибора</label><select id="product_type" class="product_select" placeholder="Тип прибора"><option value="0">Не выбрано</option>
                            <?php select_option("device_type", $row['device_type_id'], "device_type_id", "device_type_name", $mysqli); ?>
                        </select><br>
                        <label>Принцип действия</label><select id="operation_principle" placeholder="Принцип действия"><option value="0">Не выбрано</option>
                            <?php select_option("operation_principle", $row['operation_principle_id'], "operation_principle_id", "operation_principle_name", $mysqli); ?>
                        </select><br>
                        <label>Способ управления</label><select id="device_control_type" placeholder="Способ управления"><option value="0">Не выбрано</option>
                            <?php select_option("device_control_type", $row['control_type_id'], "control_type_id", "control_type_name", $mysqli); ?>
                        </select><br>
                        <label>Способ воспр. изм. вел.</label><select id="device_measure_show_type" placeholder="Способ воспр. изм. вел."><option value="0">Не выбрано</option>
                            <?php select_option("device_measure_show_type", $row['measure_show_type_id'], "measure_show_type_id", "measure_show_type_name", $mysqli); ?>
                        </select><br>
                        <label>Технология изготовления</label><select id="manufacturing_technology" placeholder="Технология изготовления"><option value="0">Не выбрано</option>
                            <?php select_option("manufacturing_technology", $row['manufacturing_technology_id'], "manufacturing_technology_id", "manufacturing_technology_name", $mysqli); ?>
                        </select><br>
                        <?php
                    }
                    ?>
                    <label>Относительная погрешность</label><input type="text" id="measurement_error" placeholder="Погрешность" value="<?php echo $row['measurement_error'] ?>"<br>
                </fieldset>
                <fieldset style="width: 100em; min-height: 16em">
                    <legend>Описание</legend>
                    <textarea style="height: 226px" id="description" placeholder="Описание"><?php echo $row['description'] ?></textarea><br>
                </fieldset>
                <fieldset style="display: inline-block">
                    <legend>Диапазон измерений</legend>
                    <label>Нижняя граница</label><input type="text" id="measure_min" placeholder="Нижняя граница" value="<?php echo $row['measure_min'] ?>"><br>
                    <label>Верхняя граница</label><input type="text" id="measure_max" placeholder="Верхняя граница" value="<?php echo $row['measure_max'] ?>"><br>
                    <label>Единица измерения</label><input type="text" id="unit_of_measuring" placeholder="Единица измерения" value="<?php echo $row['unit_of_measuring'] ?>"><br>
                </fieldset>
                <fieldset style="display: inline-block">
                    <legend>Диапазон температур окружающей среды</legend>
                    <label>Минимальная</label><input type="text" id="lower_temperature_threshold" placeholder="Минимальная" value="<?php echo $row['lower_temperature_threshold'] ?>"><br>
                    <label>Максимальная</label><input type="text" id="upper_temperature_threshold" placeholder="Максимальная" value="<?php echo $row['upper_temperature_threshold'] ?>"><br>
                    <label>Единица измерения</label><input type="text" id="temperature_unit" placeholder="Единица измерения" value="<?php echo $row['temperature_unit'] ?>"><br>
                </fieldset><br>
                <fieldset>
                    <legend>Габаритные размеры и масса</legend>
                    <label>Длина</label><input type="text" id="length" placeholder="Длина" value="<?php echo $row['length'] ?>"><br>
                    <label>Ширина</label><input type="text" id="width" placeholder="Ширина" value="<?php echo $row['width'] ?>"><br>
                    <label>Высота</label><input type="text" id="height" placeholder="Высота" value="<?php echo $row['height'] ?>"><br>
                    <label>Диаметр</label><input type="text" id="diameter" placeholder="Диаметр" value="<?php echo $row['diameter'] ?>"><br>
                    <label>Единица измерения</label><input type="text" id="unit_of_length" placeholder="Единица измерения" value="<?php echo $row['unit_of_length'] ?>"><br>
                    <label>Масса</label><input type="text" id="weight" placeholder="Масса" value="<?php echo $row['weight'] ?>"><br>
                    <label>Единица измерения</label><input type="text" id="unit_of_weight" placeholder="Единица измерения" value="<?php echo $row['unit_of_weight'] ?>"><br>
                </fieldset>
                <fieldset >
                    <legend>Дополнительно</legend>
                    <label>Питание(Вольт)</label><input type="text" id="power" placeholder="Питание(Вольт)" value="<?php echo $row['power'] ?>"><br>
                    <label>Класс защиты</label><input type="text" id="protection_class" placeholder="Класс защиты" value="<?php echo $row['protection_class'] ?>"><br>
                    <?php if($product_type == "sensor"){ ?>
                        <label>Ресурс работы(Часы)</label><input type="text" id="resource" placeholder="Ресурс работы(Часы)" value="<?php echo $row['resource'] ?>"><br>
                        <label>Количество измерительных каналов</label><input type="text" id="measuring_channels" placeholder="Количество каналов" value="<?php echo $row['measuring_channels'] ?>"><br>
                    <?php }else{ ?>
                        <label>Наработка (Часов)</label><input type="text" id="resource" placeholder="Наработка (Часов)" value="<?php echo $row['resource'] ?>"><br>
                        <label>Выходное напряжение</label><input type="text" id="output_voltage" placeholder="Выходное напряжение" value="<?php echo $row['output_voltage'] ?>"><br>
                        <label>Входное сопротивление</label><input type="text" id="in_resistance" placeholder="Входное сопротивление" value="<?php echo $row['in_resistance'] ?>"><br>
                        <label>Выходное сопротивление</label><input type="text" id="out_resistance" placeholder="Выходное сопротивление" value="<?php echo $row['out_resistance'] ?>"><br>
                    <?php } ?>
<!--                    <label>Описание</label><textarea id="description"></textarea>-->
                    <!--                        <label>Что-нибудь</label><input type="text"><br>-->
                    <!--                        <label>И еще что-нибудь</label><input type="text"><br>-->
                </fieldset>
            </div>
            <div id="content-2" class="tab-content">
                <fieldset>
                    <legend>Динамические характеристики</legend>
                    <label>Коэффициент смещения</label><input type="text" id="dynamic_shift_factor" placeholder="Коэффициент смещения" value="<?php echo $row['dynamic_shift_factor'] ?>"><br>
                    <label>Коэффициент стат. чувств.</label><input type="text" id="dynamic_static_sensitivity" placeholder="Коэффициент стат. чувств." value="<?php echo $row['dynamic_static_sensitivity'] ?>"><br>
                    <label>Коэффициент демпфирования</label><input type="text" id="dynamic_damping_factor" placeholder="Коэффициент демпфирования" value="<?php echo $row['dynamic_damping_factor'] ?>"><br>
                    <label>Постоянная времени (сек)</label><input type="text" id="dynamic_time_constant" placeholder="Постоянная времени (сек)" value="<?php echo $row['dynamic_time_constant'] ?>"><br>
                    <label>Время разогрева</label><input type="text" id="dynamic_warm_up_time" placeholder="Время разогрева" value="<?php echo $row['dynamic_warm_up_time'] ?>"><br>
                    <label>Минимальная частота среза (Герц)</label><input type="text" id="dynamic_cutoff_frequency_min" placeholder="Минимальная частота среза (Герц)" value="<?php echo $row['dynamic_cutoff_frequency_min'] ?>"><br>
                    <label>Максимальная частота среза (Герц)</label><input type="text" id="dynamic_cutoff_frequency_max" placeholder="Максимальная частота среза (Герц)" value="<?php echo $row['dynamic_cutoff_frequency_max'] ?>"><br>
                    <label>Резонансная частота (Герц)</label><input type="text" id="dynamic_resonant_frequency" placeholder="Резонансная частота (Герц)" value="<?php echo $row['dynamic_resonant_frequency'] ?>"><br>
                    <label>Динамическая погрешность (%)</label><input type="text" id="dynamic_error" placeholder="Динамическая погрешность (%)" value="<?php echo $row['dynamic_error'] ?>"><br>
                    <label>Дополнительные сведения</label><textarea style="height: 300px" id="dynamic_description" placeholder="Дополнительные сведения"><?php echo $row['dynamic_description'] ?></textarea><br>
                </fieldset>
                <fieldset style="width: 100em; height:  625px">
                    <legend>Частотная характеристика</legend>
<!--                    <img id="dynamic_frequency_response" style="max-width: 528px; max-height: 569px" src="../source/mai.gif"><br>-->
                    <div style="width: 528px; height: 574px">
                        <img id="dynamic_frequency_response" style="max-width: 528px; max-height: 574px" src="<?php echo $row['dynamic_frequency_response'] ?>"><br>
                    </div>
                    <input class="sensorVal sensor-btn" id="dynamic_frequency_response_file" type="file" accept="image/*" onchange="upload_image(1, this)">
                </fieldset>
            </div>
            <div id="content-3" class="tab-content">
<!--                <fieldset style="max-width: 1092px; width: 1092px" class="fieldset_wide">-->
                <fieldset style="width: 100em" class="fieldset_short">
                    <legend>Производитель</legend>
                    <label>Наименование</label><select id="producer" class="product_select" placeholder="Наименование" onchange="select_producer()"><option value="0" >Не выбрано</option>
                        <?php select_option("producer", $row['producer_id'], "producer_id", "producer_name", $mysqli); ?>
                    </select><br>
<!--                    <label>Наименование</label><input type="text" id="producer_name" placeholder="Наименование" value="--><?php //echo $row['producer_name'] ?><!--"><br>-->
                    <label>Адрес</label><input type="text" id="producer_address" placeholder="Адрес" value="<?php echo $row['producer_address'] ?>"><br>
                    <label>Телефон</label><input type="text" id="producer_phone" placeholder="Телефон" value="<?php echo $row['producer_phone'] ?>"><br>
                    <label>Веб сайт</label><input type="text" id="producer_website" placeholder="Веб сайт" value="<?php echo $row['producer_website'] ?>"><br>
                    <label>E-mail</label><input type="text" id="producer_email" placeholder="E-mail" value="<?php echo $row['producer_email'] ?>"><br>
                </fieldset>
                <fieldset style="width: 100em" class="fieldset_short">
                    <legend>Литература</legend>
<!--                    <label>Наименование</label><input type="text" id="literature_name" placeholder="Наименование" value="--><?php //echo $row['literature_name'] ?><!--"><br>-->
                    <select id="literature" class="literature_select" placeholder="Наименование" multiple style="width: 528px;">
                        <?php
                        if ($product_type == "sensor") {
                            select_multiple("sensor_literature", "sensor_id", $id, "literature", "literature_id", "literature_name", $mysqli);
                        }
                        else{
                            select_multiple("device_literature", "device_id", $id, "literature", "literature_id", "literature_name", $mysqli);
                        } ?>
                    </select><br>
<!--                    <label>Наименование</label><select id="literature" class="literature_select" placeholder="Наименование" onchange="select_literature()"><option value="0" >Не выбрано</option>-->
<!--                        --><?php //select_option("producer", $row['producer_id'], "producer_id", "producer_name", $mysqli); ?>
<!--                    </select><br>-->
<!--                    <label>Автор</label><input type="text" id="literature_author" placeholder="Автор" value="--><?php //echo $row['literature_author'] ?><!--"><br>-->
<!--                    <label>Издательство</label><input type="text" id="literature_publisher" placeholder="Издательство" value="--><?php //echo $row['literature_publisher'] ?><!--"><br>-->
<!--                    <label>Веб сайт</label><input type="text" id="literature_website" placeholder="Веб сайт" value="--><?php //echo $row['literature_website'] ?><!--"><br>-->
<!--                    <label>Год</label><input type="text" id="literature_date" placeholder="Год" value="--><?php //echo $row['literature_date'] ?><!--"><br>-->
                </fieldset>
<!--                <fieldset style="max-width: 1092px; width: 69em">-->
<!--                    <legend>Литература</legend>-->
<!--                    <div id="literature_list"></div>-->
<!--                </fieldset>-->
<!--                <fieldset style="max-width: 1092px; width: 69em">-->
<!--                    <legend>Литература</legend>-->
<!--                    <table class="literatureDataTable">-->
<!--                        <thead>-->
<!--                        <tr>-->
<!--                            <th>Наименование</th>-->
<!--                            <th>Автор</th>-->
<!--                            <th>Издатель</th>-->
<!--                            <th>Год издания</th>-->
<!--                            <th>Сайт</th>-->
<!--                            <th>Включен</th>-->
<!--                        </tr>-->
<!--                        </thead>-->
<!--                        <tbody>-->
<!--                        </tbody>-->
<!--                        <tfoot>-->
<!--                        </tfoot>-->
<!--                    </table>-->
<!--                </fieldset>-->
            </div>
            <div id="content-4" class="tab-content">
                <fieldset style="width: 100em">
                    <legend>Среда измерения</legend>
                    <select id="environment" class="product_select" placeholder="Наименование" multiple style="width: 528px;">
                        <?php
                        if ($product_type == "sensor") {
                            select_multiple("sensor_environment", "sensor_id", $id, "environment", "environment_id", "environment_name", $mysqli);
                        }
                        else{
                            select_multiple("device_environment", "device_id", $id, "environment", "environment_id", "environment_name", $mysqli);
                        } ?>
                    </select><br>
                </fieldset>
                <fieldset style="width: 100em">
                    <legend>Область применения</legend>
                    <select id="application_sphere" class="product_select" placeholder="Наименование" multiple style="width: 528px;">
                        <?php
                        if ($product_type == "sensor") {
                            select_multiple("sensor_application_sphere", "sensor_id", $id, "application_sphere", "application_sphere_id", "application_sphere_name", $mysqli);
                        }
                        else{
                            select_multiple("device_application_sphere", "device_id", $id, "application_sphere", "application_sphere_id", "application_sphere_name", $mysqli);
                        } ?>
                    </select><br>
                </fieldset>
            </div>
            <div id="content-5" class="tab-content">
<!--                <fieldset style="max-width: 1092px; height: 500px">-->
<!--                    <legend>Изображения</legend>-->
<!--                    <input class="sensorVal sensor-btn" id="scheme-inp" type="file" accept="image/*" onchange="upload_image(1, this)">-->
<!--                    <input class="sensorVal sensor-btn" id="blueprint-inp" type="file" accept="image/*" onchange="upload_image(2, this)">-->
<!--                    <input class="sensorVal sensor-btn" id="picture-inp" type="file" accept="image/*" onchange="upload_image(3, this)">-->
<!--                </fieldset><br>-->
                <fieldset>
                    <legend>Изображение</legend>
                    <div style="width: 340px; height: 340px">
                        <img id="picture" style="max-width: 340px; max-height: 340px" src="<?php echo $row['picture'] ?>"><br>
                    </div>
                    <input class="sensorVal sensor-btn" id="picture_file" type="file" accept="image/*" onchange="upload_image(2, this)">
                </fieldset>
                <fieldset>
                    <legend>Чертеж</legend>
                    <div style="width: 340px; height: 340px">
                        <img id="blueprint" style="max-width: 340px; max-height: 340px" src="<?php echo $row['blueprint'] ?>"><br>
                    </div>
                    <input class="sensorVal sensor-btn" id="blueprint_file" type="file" accept="image/*" onchange="upload_image(3, this)">
                </fieldset>
                <fieldset>
                    <legend>Схема</legend>
                    <div style="width: 340px; height: 340px">
                        <img id="scheme" style="max-width: 340px; max-height: 340px" src="<?php echo $row['scheme'] ?>"><br>
                    </div>
                    <input class="sensorVal sensor-btn" id="scheme_file" type="file" accept="image/*" onchange="upload_image(4, this)">
                </fieldset><br>
                <fieldset style="width: 100em; height: 200px">
                    <legend>Доп характеристики</legend>
                </fieldset>
                <fieldset style="width: 100em">
                    <legend>Доп характеристики</legend>
                </fieldset>
            </div>
            <div id="content-6" class="tab-content">
                <fieldset style="width: 100em">
                    <legend>Список датчиков</legend>
                    <select id="sensors_in_devices" class="product_select" placeholder="Наименование" multiple style="width: 528px;">
                    <?php
                    select_multiple("sensors_in_devices", "device_id", $id, "sensors", "sensor_id", "name", $mysqli);
                    ?>
                    </select>
                </fieldset>
                <fieldset style="width: 100em">
                    <legend>Список измеряемых величин</legend>
                    <select id="device_measurable_value" class="product_select" placeholder="Наименование" multiple style="width: 528px;">
                        <?php
                        select_multiple("device_measurable_value", "device_id", $id, "measurable_value", "measurable_value_id", "measurable_value_name", $mysqli);
                        ?>
                    </select>
                </fieldset>
            </div>
        </div>
    </form>
    <?php
    if ($_SESSION['logged_user']['status'] > 1) {
        if ($id < 0) {
            ?>
            <button class="save-btn" onclick="edit_product(3)">Добавить изделие</button>
            <?php
        } else {
            ?>
            <button class="save-btn" onclick="edit_product(2)">Сохранить изменения</button>
            <?php
        }
    }
    ?>
</div>
<?php
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