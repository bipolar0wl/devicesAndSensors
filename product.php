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
//// Проверка, есть ли уровень доступа или создал ли пользователь это изделие
//if($_SESSION['logged_user']['status'] < 3 AND $_SESSION['logged_user']['user_id'] != $row['user_id']) {
//    ?>
<!--    <p>hello</p>-->
<!--    <script>-->
<!--        $('#name').val("gay")-->
<!--        $('#product-form input[type!="radio"], #product-form select, #product-form textarea').attr('disabled', true)-->
<!--    </script>-->
<!--    --><?php
//}
?>
    <script>
        $(document).ready(function() {
            $('select').select2({ // Применяем плагин select2 ко всем select
                tags: true, // Нужно, чтобы добавлять на лету новые значения
            });
        })
    </script>
<div class="container">
    <div style="margin: 5px 30px">
        <div id="product-form" class="row align-items-center">
            <div class="form-group row font-weight-bold" style="margin: 0 0 3px 10px">
                <?php
                if ($product_type == "sensor"){
                    echo '<label for="name" class="col-form-label">Датчик</label>';
                }else{
                    echo '<label for="name" class="col-form-label">Прибор</label>';
                }
                ?>
                <div class="col">
                    <input type="text" id="id" hidden value="<?php echo $id ?>">
                    <input type="text" id="type_of_product" hidden value="<?php echo $product_type ?>">
                    <input type="text" id="name" class="col form-control" placeholder="Наименование" style="font-size: 16px; width: 700px" value="<?php echo $row['name'] ?>">
                </div>
            </div>
            <ul class="nav nav-tabs" id="product-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="main-tab" data-toggle="tab" href="#main" role="tab" aria-controls="home" aria-selected="true">Основные параметры</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="dynamic-tab" data-toggle="tab" href="#dynamic" role="tab" aria-controls="profile" aria-selected="false">Динамические характеристики</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="producer_literature-tab" data-toggle="tab" href="#producer_literature" role="tab" aria-controls="contact" aria-selected="false">Производитель и литература</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="environment_application-tab" data-toggle="tab" href="#environment_application" role="tab" aria-controls="contact" aria-selected="false">Среда измерения и область применения</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="images_additional-tab" data-toggle="tab" href="#images_additional" role="tab" aria-controls="contact" aria-selected="false">Изображения</a>
                </li>
                <?php if ($product_type == "device"){ ?>
                <li class="nav-item">
                    <a class="nav-link" id="sensors_measurable-tab" data-toggle="tab" href="#sensors_measurable" role="tab" aria-controls="contact" aria-selected="false">Датчики и измеряемые величины</a>
                </li>
                <?php } ?>
            </ul>
            <div class="tab-content w-100" id="tabContent">
                <div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="main-tab">
                    <div class="form-group row">
                        <div class="col-6">
                            <fieldset>
                                <legend>Основные параметры</legend>
                                <div class="form-group row">
                                    <?php if ($product_type == "sensor"){ ?>
                                        <label for="product_type" class="col-sm-6 col-form-label">Тип датчика</label>
                                        <div class="col-sm-6">
                                            <select type="text" class="form-control form-control-sm" id="product_type" onchange="select_sensor_type()"><option value="0">Не выбрано</option>
                                                <?php select_option("sensor_type", $row['sensor_type_id'], "sensor_type_id", "sensor_type_name", $mysqli); ?>
                                            </select>
                                        </div>
                                        <label for="measurable_value" class="col-sm-6 col-form-label">Измеряемая величина</label>
                                        <div class="col-sm-6">
                                            <select type="text" class="form-control form-control-sm" id="measurable_value" disabled><option value="0">Не выбрано</option>
                                                <?php select_option_two("sensor_type", "sensor_type_id", $row['sensor_type_id'], "measurable_value", "measurable_value_id", "measurable_value_name", $mysqli); ?>
                                            </select>
                                        </div>
                                        <label for="sensitive_element" class="col-sm-6 col-form-label">Чувствительный элемент</label>
                                        <div class="col-sm-6">
                                            <select type="text" class="form-control form-control-sm" id="sensitive_element"><option value="0">Не выбрано</option>
                                                <?php select_option("sensitive_element", $row['sensitive_element_id'], "sensitive_element_id", "sensitive_element_name", $mysqli); ?>
                                            </select>
                                        </div>
                                        <label for="operation_principle" class="col-sm-6 col-form-label">Принцип действия</label>
                                        <div class="col-sm-6">
                                            <select type="text" class="form-control form-control-sm" id="operation_principle"><option value="0">Не выбрано</option>
                                                <?php select_option("operation_principle", $row['operation_principle_id'], "operation_principle_id", "operation_principle_name", $mysqli); ?>
                                            </select>
                                        </div>
                                        <label for="output_signal" class="col-sm-6 col-form-label">Характер выходного сигнала</label>
                                        <div class="col-sm-6">
                                            <select type="text" class="form-control form-control-sm" id="output_signal"><option value="0">Не выбрано</option>
                                                <?php select_option("output_signal", $row['output_signal_id'], "output_signal_id", "output_signal_name", $mysqli); ?>
                                            </select>
                                        </div>
                                        <label for="signal_conversation" class="col-sm-6 col-form-label">Характер преобразования сигнала</label>
                                        <div class="col-sm-6">
                                            <select type="text" class="form-control form-control-sm" id="signal_conversation"><option value="0">Не выбрано</option>
                                                <?php select_option("signal_conversation", $row['signal_conversation_id'], "signal_conversation_id", "signal_conversation_name", $mysqli); ?>
                                            </select>
                                        </div>
                                        <label for="manufacturing_technology" class="col-sm-6 col-form-label">Технология изготовления</label>
                                        <div class="col-sm-6">
                                            <select type="text" class="form-control form-control-sm" id="manufacturing_technology"><option value="0">Не выбрано</option>
                                                <?php select_option("manufacturing_technology", $row['manufacturing_technology_id'], "manufacturing_technology_id", "manufacturing_technology_name", $mysqli); ?>
                                            </select>
                                        </div>
                                    <?php }else{ ?>
                                        <label for="product_type" class="col-sm-6 col-form-label">Тип прибора</label>
                                        <div class="col-sm-6">
                                            <select type="text" class="form-control form-control-sm" id="product_type"><option value="0">Не выбрано</option>
                                                <?php select_option("device_type", $row['device_type_id'], "device_type_id", "device_type_name", $mysqli); ?>
                                            </select>
                                        </div>
                                        <label for="device_purpose" class="col-sm-6 col-form-label">Назначение</label>
                                        <div class="col-sm-6">
                                            <select type="text" class="form-control form-control-sm" id="device_purpose"><option value="0">Не выбрано</option>
                                                <?php select_option("device_purpose", $row['device_purpose_id'], "device_purpose_id", "device_purpose_name", $mysqli); ?>
                                            </select>
                                        </div>
                                        <label for="operation_principle" class="col-sm-6 col-form-label">Принцип действия</label>
                                        <div class="col-sm-6">
                                            <select type="text" class="form-control form-control-sm" id="operation_principle"><option value="0">Не выбрано</option>
                                                <?php select_option("operation_principle", $row['operation_principle_id'], "operation_principle_id", "operation_principle_name", $mysqli); ?>
                                            </select>
                                        </div>
                                        <label for="device_control_type" class="col-sm-6 col-form-label">Способ управления</label>
                                        <div class="col-sm-6">
                                            <select type="text" class="form-control form-control-sm" id="device_control_type"><option value="0">Не выбрано</option>
                                                <?php select_option("device_control_type", $row['control_type_id'], "control_type_id", "control_type_name", $mysqli); ?>
                                            </select>
                                        </div>
                                        <label for="device_measure_show_type" class="col-sm-6 col-form-label">Способ воспроизведения измеряемой величины</label>
                                        <div class="col-sm-6">
                                            <select type="text" class="form-control form-control-sm" id="device_measure_show_type"><option value="0">Не выбрано</option>
                                                <?php select_option("device_measure_show_type", $row['measure_show_type_id'], "measure_show_type_id", "measure_show_type_name", $mysqli); ?>
                                            </select>
                                        </div>
                                        <label for="manufacturing_technology" class="col-sm-6 col-form-label">Технология изготовления</label>
                                        <div class="col-sm-6">
                                            <select type="text" class="form-control form-control-sm" id="manufacturing_technology"><option value="0">Не выбрано</option>
                                                <?php select_option("manufacturing_technology", $row['manufacturing_technology_id'], "manufacturing_technology_id", "manufacturing_technology_name", $mysqli); ?>
                                            </select>
                                        </div>
                                    <?php } ?>
                                    <label for="measurement_error" class="col-sm-6 col-form-label">Погрешность измерения, %</label>
                                    <div class="col-sm-6">
                                        <input type="number" min="0" max="100" step="0.1" class="form-control form-control-sm" id="measurement_error" placeholder="Погрешность измерения, %" value="<?php echo $row['measurement_error']?>">
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-6">
                            <fieldset>
                                <legend>Описание</legend>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <textarea type="text" class="form-control form-control-sm" id="description" rows="11"><?php echo $row['description']?></textarea>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-6">
                            <fieldset>
                                <legend>Диапазон измерений</legend>
                                <div class="form-group row">
                                    <label for="measure_min" class="col-sm-6 col-form-label">Нижняя граница измерений</label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control form-control-sm" id="measure_min" placeholder="Нижняя граница" value="<?php echo $row['measure_min']?>">
                                    </div>
                                    <label for="measure_max" class="col-sm-6 col-form-label">Верхняя граница измерений</label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control form-control-sm" id="measure_max" placeholder="Верхняя граница" value="<?php echo $row['measure_max']?>">
                                    </div>
                                    <label for="unit_of_measuring" class="col-sm-6 col-form-label">Единица измерения величины</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm" id="unit_of_measuring" placeholder="Единица измерения величины"  value="<?php echo $row['unit_of_measuring']?>">
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-6">
                            <fieldset>
                                <legend>Диапазон температур окружающей среды</legend>
                                <div class="form-group row">
                                    <label for="lower_temperature_threshold" class="col-sm-6 col-form-label">Минимальная температура</label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control form-control-sm" id="lower_temperature_threshold" placeholder="Минимальная температура" value="<?php echo $row['lower_temperature_threshold']?>">
                                    </div>
                                    <label for="upper_temperature_threshold" class="col-sm-6 col-form-label">Максимальная температура</label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control form-control-sm" id="upper_temperature_threshold" placeholder="Максимальная температура" value="<?php echo $row['upper_temperature_threshold']?>">
                                    </div>
                                    <label for="temperature_unit" class="col-sm-6 col-form-label">Единица измерения температуры</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm" id="temperature_unit" placeholder="Единица измерения температуры" value="<?php echo $row['temperature_unit']?>">
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-6">
                            <fieldset>
                                <legend>Габаритные размеры и вес</legend>
                                <div class="form-group row">
                                    <label for="length" class="col-sm-6 col-form-label">Длина</label>
                                    <div class="col-sm-6">
                                        <input type="number" min="0" class="form-control form-control-sm" id="length" placeholder="Длина" value="<?php echo $row['length']?>">
                                    </div>
                                    <label for="width" class="col-sm-6 col-form-label">Ширина</label>
                                    <div class="col-sm-6">
                                        <input type="number" min="0" class="form-control form-control-sm" id="width" placeholder="Ширина" value="<?php echo $row['width']?>">
                                    </div>
                                    <label for="height" class="col-sm-6 col-form-label">Высота</label>
                                    <div class="col-sm-6">
                                        <input type="number" min="0" class="form-control form-control-sm" id="height" placeholder="Высота" value="<?php echo $row['height']?>">
                                    </div>
                                    <label for="diameter" class="col-sm-6 col-form-label">Диаметр</label>
                                    <div class="col-sm-6">
                                        <input type="number" min="0" class="form-control form-control-sm" id="diameter" placeholder="Диаметр" value="<?php echo $row['diameter']?>">
                                    </div>
                                    <label for="unit_of_length" class="col-sm-6 col-form-label">Единица измерения длины</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm" id="unit_of_length" placeholder="Единица измерения длины" value="<?php echo $row['unit_of_length']?>">
                                    </div>
                                    <label for="weight" class="col-sm-6 col-form-label">Вес</label>
                                    <div class="col-sm-6">
                                        <input type="number" min="0" class="form-control form-control-sm" id="weight" placeholder="Вес" value="<?php echo $row['weight']?>">
                                    </div>
                                    <label for="unit_of_weight" class="col-sm-6 col-form-label">Единица измерения веса</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm" id="unit_of_weight" placeholder="Единица измерения веса" value="<?php echo $row['unit_of_weight']?>">
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-6">
                            <fieldset>
                                <legend>Дополнительно</legend>
                                <div class="form-group row">
                                    <label for="power" class="col-sm-6 col-form-label">Питание(Вольт)</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm" id="power" placeholder="Питание(Вольт)" value="<?php echo $row['power']?>">
                                    </div>
                                    <label for="protection_class" class="col-sm-6 col-form-label">Класс защиты</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm" id="protection_class" placeholder="Класс защиты" value="<?php echo $row['protection_class']?>">
                                    </div>
                                    <?php if($product_type == "sensor"){ ?>
                                        <label for="resource" class="col-sm-6 col-form-label">Ресурс работы(Часы)</label>
                                        <div class="col-sm-6">
                                            <input type="number" min="0" class="form-control form-control-sm" id="resource" placeholder="Ресурс работы(Часы)" value="<?php echo $row['resource']?>">
                                        </div>
                                        <label for="measuring_channels" class="col-sm-6 col-form-label">Количество измерительных каналов</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm" id="measuring_channels" placeholder="Количество измерительных каналов" value="<?php echo $row['measuring_channels']?>">
                                        </div>
                                    <?php }else{ ?>
                                        <label for="resource" class="col-sm-6 col-form-label">Наработка (Часов)</label>
                                        <div class="col-sm-6">
                                            <input type="number" min="0" class="form-control form-control-sm" id="resource" placeholder="Наработка (Часов)" value="<?php echo $row['resource']?>">
                                        </div>
                                        <label for="output_voltage" class="col-sm-6 col-form-label">Выходное напряжение</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm" id="output_voltage" placeholder="Выходное напряжение" value="<?php echo $row['output_voltage']?>">
                                        </div>
                                        <label for="in_resistance" class="col-sm-6 col-form-label">Входное сопротивление</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm" id="in_resistance" placeholder="Входное сопротивление" value="<?php echo $row['in_resistance']?>">
                                        </div>
                                        <label for="out_resistance" class="col-sm-6 col-form-label">Выходное сопротивление</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm" id="out_resistance" placeholder="Выходное сопротивление" value="<?php echo $row['out_resistance']?>">
                                        </div>
                                    <?php } ?>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="dynamic" role="tabpanel" aria-labelledby="dynamic-tab">
                    <div class="row">
                        <div class="col">
                            <fieldset>
                                <legend>Динамические характеристики</legend>
                                <div class="form-group row">
                                    <label for="dynamic_shift_factor" class="col-sm-6 col-form-label">Коэффициент смещения</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm" id="dynamic_shift_factor" placeholder="Коэффициент смещения" value="<?php echo $row['dynamic_shift_factor']?>">
                                    </div>
                                    <label for="dynamic_static_sensitivity" class="col-sm-6 col-form-label">Коэффициент статической чувствительности</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm" id="dynamic_static_sensitivity" placeholder="Коэффициент стат. чувств." value="<?php echo $row['dynamic_static_sensitivity']?>">
                                    </div>
                                    <label for="dynamic_damping_factor" class="col-sm-6 col-form-label">Коэффициент демпфирования</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm" id="dynamic_damping_factor" placeholder="Коэффициент демпфирования" value="<?php echo $row['dynamic_damping_factor']?>">
                                    </div>
                                    <label for="dynamic_time_constant" class="col-sm-6 col-form-label">Постоянная времени (сек)</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm" id="dynamic_time_constant" placeholder="Постоянная времени (сек)" value="<?php echo $row['dynamic_time_constant']?>">
                                    </div>
                                    <label for="dynamic_warm_up_time" class="col-sm-6 col-form-label">Время разогрева</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm" id="dynamic_warm_up_time" placeholder="Время разогрева" value="<?php echo $row['dynamic_warm_up_time']?>">
                                    </div>
                                    <label for="dynamic_cutoff_frequency_min" class="col-sm-6 col-form-label">Минимальная частота среза (Герц)</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm" id="dynamic_cutoff_frequency_min" placeholder="Минимальная частота среза (Герц)" value="<?php echo $row['dynamic_cutoff_frequency_min']?>">
                                    </div>
                                    <label for="dynamic_cutoff_frequency_max" class="col-sm-6 col-form-label">Максимальная частота среза (Герц)</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm" id="dynamic_cutoff_frequency_max" placeholder="Максимальная частота среза (Герц)" value="<?php echo $row['dynamic_cutoff_frequency_max']?>">
                                    </div>
                                    <label for="dynamic_resonant_frequency" class="col-sm-6 col-form-label">Резонансная частота (Герц)</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm" id="dynamic_resonant_frequency" placeholder="Резонансная частота (Герц)" value="<?php echo $row['dynamic_resonant_frequency']?>">
                                    </div>
                                    <label for="dynamic_error" class="col-sm-6 col-form-label">Динамическая погрешность (%)</label>
                                    <div class="col-sm-6">
                                        <input type="number" min="0" max="100" class="form-control form-control-sm" id="dynamic_error" placeholder="Динамическая погрешность (%)" value="<?php echo $row['dynamic_error']?>">
                                    </div>
                                    <label for="dynamic_description" class="col-sm-6 col-form-label">Дополнительные сведения</label>
                                    <div class="col-sm-12">
                                        <textarea type="text" class="form-control form-control-sm" id="dynamic_description" rows="8" placeholder="Дополнительные сведения"><?php echo $row['dynamic_description']?></textarea>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col">
                            <fieldset>
                                <legend>Частотная характеристика</legend>
                                <div class="form-group mx-auto row justify-content-end">
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="dynamic_frequency_response_file" lang="ru" type="file" accept="image/*" onchange="upload_image(1, this)">
                                            <label class="custom-file-label" for="dynamic_frequency_response_file">Выберите файл</label>
                                        </div>
<!--                                        <div class="input-group-append">-->
<!--                                            <span class="input-group-text" id="">Загрузить</span>-->
<!--                                        </div>-->
                                    </div>
                                    <div class="col-sm-12">
                                        <img id="dynamic_frequency_response" alt="" class="img-rounded img-fluid m-x-auto d-block" src="<?php echo $row['dynamic_frequency_response'] ?>">
                                    </div>
<!--                                    <input class="sensorVal sensor-btn form-control form-control-sm" id="dynamic_frequency_response_file" type="file" accept="image/*" onchange="upload_image(1, this)">-->
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="producer_literature" role="tabpanel" aria-labelledby="producer_literature-tab">
                    <div class="row">
                        <div class="col-6">
                            <fieldset>
                                <legend>Производитель</legend>
                                <div class="form-group row">
                                    <label for="producer" class="col-sm-6 col-form-label">Наименование</label>
                                    <div class="col-sm-6">
                                        <select style="width: 100%" type="text" class="form-control form-control-sm" id="producer" placeholder="Наименование" onchange="select_producer()"><option value="0" >Не выбрано</option>
                                            <?php select_option("producer", $row['producer_id'], "producer_id", "producer_name", $mysqli); ?>
                                        </select>
                                    </div>
                                    <label for="producer_address" class="col-sm-6 col-form-label">Адрес</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm" id="producer_address" placeholder="Адрес" value="<?php echo $row['producer_address']?>">
                                    </div>
                                    <label for="producer_phone" class="col-sm-6 col-form-label">Телефон</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm" id="producer_phone" placeholder="Телефон" value="<?php echo $row['producer_phone']?>">
                                    </div>
                                    <label for="producer_website" class="col-sm-6 col-form-label">Веб сайт</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm" id="producer_website" placeholder="Веб сайт" value="<?php echo $row['producer_website']?>">
                                    </div>
                                    <label for="producer_email" class="col-sm-6 col-form-label">E-mail</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm" id="producer_email" placeholder="E-mail" value="<?php echo $row['producer_email']?>">
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-6">
                            <fieldset>
                                <legend>Литература</legend>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <select style="width: 100%" type="text" class="form-control form-control-sm" id="literature" multiple>
                                            <?php
                                            if ($product_type == "sensor") {
                                                select_multiple("sensor_literature", "sensor_id", $id, "literature", "literature_id", "literature_name", $mysqli);
                                            }
                                            else{
                                                select_multiple("device_literature", "device_id", $id, "literature", "literature_id", "literature_name", $mysqli);
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="environment_application" role="tabpanel" aria-labelledby="environment_application-tab">
                    <div class="row">
                        <div class="col-6">
                            <fieldset>
                                <legend>Среда измерения</legend>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <select id="environment" class="product_select" placeholder="Наименование" multiple style="width: 528px;">
                                            <?php
                                            if ($product_type == "sensor") {
                                                select_multiple("sensor_environment", "sensor_id", $id, "environment", "environment_id", "environment_name", $mysqli);
                                            }
                                            else{
                                                select_multiple("device_environment", "device_id", $id, "environment", "environment_id", "environment_name", $mysqli);
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-6">
                            <fieldset>
                                <legend>Область применения</legend>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <select id="application_sphere" class="product_select" placeholder="Наименование" multiple style="width: 528px;">
                                            <?php
                                            if ($product_type == "sensor") {
                                                select_multiple("sensor_application_sphere", "sensor_id", $id, "application_sphere", "application_sphere_id", "application_sphere_name", $mysqli);
                                            }
                                            else{
                                                select_multiple("device_application_sphere", "device_id", $id, "application_sphere", "application_sphere_id", "application_sphere_name", $mysqli);
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="images_additional" role="tabpanel" aria-labelledby="images_additional-tab">
                    <div class="row">
                        <div class="col-4">
                            <fieldset>
                                <legend>Изображение</legend>
                                <div class="form-group mx-auto row justify-content-end">
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="picture_file" lang="ru" type="file" accept="image/*" onchange="upload_image(2, this)">
                                            <label class="custom-file-label" for="picture_file">Выберите файл</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <a href="<?php echo $row['picture'] ?>"><img id="picture" alt="" class="img-rounded img-fluid m-x-auto d-block" src="<?php echo $row['picture'] ?>"></a>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-4">
                            <fieldset>
                                <legend>Чертеж</legend>
                                <div class="form-group mx-auto row justify-content-end">
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="blueprint_file" lang="ru" type="file" accept="image/*" onchange="upload_image(3, this)">
                                            <label class="custom-file-label" for="blueprint_file">Выберите файл</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <a href="<?php echo $row['blueprint'] ?>"><img id="blueprint" alt="" class="img-rounded img-fluid m-x-auto d-block" src="<?php echo $row['blueprint'] ?>"></a>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-4">
                            <fieldset>
                                <legend>Схема</legend>
                                <div class="form-group mx-auto row justify-content-end">
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="scheme_file" lang="ru" type="file" accept="image/*" onchange="upload_image(4, this)">
                                            <label class="custom-file-label" for="scheme_file">Выберите файл</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <a href="<?php echo $row['scheme'] ?>"><img id="scheme" alt="" class="img-rounded img-fluid m-x-auto d-block" src="<?php echo $row['scheme'] ?>"></a>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="sensors_measurable" role="tabpanel" aria-labelledby="sensors_measurable-tab">
                    <div class="row">
                        <div class="col-6">
                            <fieldset>
                                <legend>Список датчиков</legend>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <select id="sensors_in_devices" class="product_select" placeholder="Наименование" multiple style="width: 528px;">
                                            <?php
                                            select_multiple("sensors_in_devices", "device_id", $id, "sensors", "sensor_id", "name", $mysqli);
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-6">
                            <fieldset>
                                <legend>Список измеряемых величин</legend>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <select id="device_measurable_value" class="product_select" placeholder="Наименование" multiple style="width: 528px;">
                                            <?php
                                            select_multiple("device_measurable_value", "device_id", $id, "measurable_value", "measurable_value_id", "measurable_value_name", $mysqli);
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-end">
            <div>
                <button class="btn btn-outline-primary" onclick="download_doc(<?php echo $_GET['id'] ?>, '<?php echo $product_type ?>')">Скачать документ</button>
                <?php
                if ($_SESSION['logged_user']['status'] > 1) {
                    if ($id < 0) {
                        ?>
                        <button class="btn btn-outline-primary" onclick="edit_product(3)">Добавить изделие</button>
                        <?php
                    } else {
                        ?>
                        <button class="btn btn-outline-primary" onclick="edit_product(2)">Сохранить изменения</button>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
require_once ("footer.php");
// Проверка, есть ли уровень доступа или создал ли пользователь это изделие
if($_SESSION['logged_user']['status'] < 3 AND $_SESSION['logged_user']['user_id'] != $row['user_id']) {
    ?>
    <script>
        $('#product-form input[type!="radio"], #product-form select, #product-form textarea').attr('disabled', true)
    </script>
    <?php
}
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