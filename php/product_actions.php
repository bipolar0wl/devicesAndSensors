<?php
require_once('../php/dbSelect.php');

$data = "";
$errors = array();
switch ($_POST['key']){
    case 1: // Обновление информации о производителе на странице
        if(is_numeric($_POST['producer_id'])) {
            $select_sql = ('SELECT * FROM producer WHERE producer_id = ' . $_POST['producer_id']);
            $result = mysqli_query($mysqli, $select_sql);
            $row = mysqli_fetch_assoc($result);
            $data = array(
                "producer_name" => $row['producer_name'],
                "producer_address" => $row['producer_address'],
                "producer_phone" => $row['producer_phone'],
                "producer_website" => $row['producer_website'],
                "producer_email" => $row['producer_email'],
            );
        }
        break;
    case 2: // Обновление информации по изделию
//        if($type_of_product == "sensor"){
//            $select_sql = ('SELECT name FROM sensors WHERE name = "'.$_POST['name'].'" AND sensor_id != '.$_POST['id']);
//        }
//        elseif($type_of_product == "device"){
//            $select_sql = ('SELECT name FROM devices WHERE name = "'.$_POST['name'].'" AND device_id != '.$_POST['id']);
//        }
//        $result = mysqli_query($mysqli, $select_sql);
//        $row = mysqli_fetch_assoc($result);
//        if ($row['name']){
//            if($_POST['type_of_product'] == "sensor"){
//                $errors[] = "Такой датчик уже существует";
//            }
//            elseif($_POST['type_of_product'] == "device"){
//                $errors[] = "Такой прибор уже существует";
//            }
//            break;
//        }
        if ($_POST['type_of_product'] == "sensor"){
            $update_sql = ('UPDATE sensors SET
			name = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['name']). /* Наименование */'",""),
            sensor_type_id = NULLIF("'.mysqli_real_escape_string($mysqli, insert_sensor_type($_POST['product_type'], $_POST['measurable_value'], $mysqli)). /* Тип датчика */'",""),
            sensitive_element_id = NULLIF("'.mysqli_real_escape_string($mysqli, val_insert("sensitive_element", "sensitive_element_id", "sensitive_element_name", $_POST['sensitive_element'], $mysqli)). /* Чувствительный элемент */'",""),
            operation_principle_id = NULLIF("'.mysqli_real_escape_string($mysqli, val_insert("operation_principle", "operation_principle_id", "operation_principle_name", $_POST['operation_principle'], $mysqli)). /* Принцип действия */'",""),
            output_signal_id = NULLIF("'.mysqli_real_escape_string($mysqli, val_insert("output_signal", "output_signal_id", "output_signal_name", $_POST['output_signal'], $mysqli)). /* Характер выходного сигнала */'",""),
            signal_conversation_id = NULLIF("'.mysqli_real_escape_string($mysqli, val_insert("signal_conversation", "signal_conversation_id", "signal_conversation_name", $_POST['signal_conversation'], $mysqli)). /* Характер преобразования сигнала */'",""),
            manufacturing_technology_id = NULLIF("'.mysqli_real_escape_string($mysqli, val_insert("manufacturing_technology", "manufacturing_technology_id", "manufacturing_technology_name", $_POST['manufacturing_technology'], $mysqli)). /* Технология изготовления */'",""),
            measurement_error = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['measurement_error']). /* Относительная погрешность */'",""),
            description = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['description']). /* Описание */'",""),
            measure_min = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['measure_min']). /* Нижняя граница измерений */'",""),
            measure_max = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['measure_max']). /* Верхняя граница измерений */'",""),
            unit_of_measuring = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['unit_of_measuring']). /* Единица измерения величины */'",""),
            lower_temperature_threshold = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['lower_temperature_threshold']). /* Минимальная температура */'",""),
            upper_temperature_threshold = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['upper_temperature_threshold']). /* Максимальная температура */'",""),
            temperature_unit = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['temperature_unit']). /* Единица измерения температуры */'",""),
            length = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['length']). /* Длина */'",""),
            width = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['width']). /* Ширина */'",""),
            height = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['height']). /* Высота */'",""),
            diameter = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['diameter']). /* Диаметр */'",""),
            unit_of_length = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['unit_of_length']). /* Единица измерения длины */'",""),
            weight = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['weight']). /* Масса */'",""),
            unit_of_weight = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['unit_of_weight']). /* Единица измерения массы */'",""),
            power = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['power']). /* Питание(Вольт) */'",""),
            protection_class = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['protection_class']). /* Класс защиты */'",""),
            resource = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['resource']). /* Ресурс работы(Часы) */'",""),
            measuring_channels = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['measuring_channels']). /* Количество измерительных каналов */'",""),
            dynamic_shift_factor = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_shift_factor']). /* Коэффициент смещения */'",""),
            dynamic_static_sensitivity = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_static_sensitivity']). /* Коэффициент стат. чувств. */'",""),
            dynamic_damping_factor = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_damping_factor']). /* Коэффициент демпфирования */'",""),
            dynamic_time_constant = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_time_constant']). /* Постоянная времени (сек) */'",""),
            dynamic_warm_up_time = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_warm_up_time']). /* Время разогрева */'",""),
            dynamic_cutoff_frequency_min = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_cutoff_frequency_min']). /* Минимальная частота среза (Герц) */'",""),
            dynamic_cutoff_frequency_max = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_cutoff_frequency_max']). /* Максимальная частота среза (Герц) */'",""),
            dynamic_resonant_frequency = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_resonant_frequency']). /* Резонансная частота (Герц) */'",""),
            dynamic_error = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_error']). /* Динамическая погрешность (%) */'",""),
            dynamic_description = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_description']). /* Дополнительные сведения */'",""),
            producer_id = NULLIF("'.mysqli_real_escape_string($mysqli, edit_producer($_POST['producer_id'], $_POST['producer_address'], $_POST['producer_phone'], $_POST['producer_website'], $_POST['producer_email'], $mysqli)). /* ID производителя */'","")
            WHERE sensor_id = '.$_POST['id']);
            multiple_val_insert('literature', 'literature_id', 'literature_name', 'sensor_literature', 'sensor_id', $_POST['id'], $_POST['literature'], $mysqli);
            multiple_val_insert('environment', 'environment_id', 'environment_name', 'sensor_environment', 'sensor_id', $_POST['id'], $_POST['environment'], $mysqli);
            multiple_val_insert('application_sphere', 'application_sphere_id', 'application_sphere_name', 'sensor_application_sphere', 'sensor_id', $_POST['id'], $_POST['application_sphere'], $mysqli);
            change_save($mysqli, 0, $_POST['id']);
        }
        elseif ($_POST['type_of_product'] == "device"){
            $update_sql = ('UPDATE devices SET
            name = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['name']). /* Наименование */'",""),
            device_type_id = NULLIF("'.mysqli_real_escape_string($mysqli, val_insert("device_type", "device_type_id", "device_type_name", $_POST['product_type'], $mysqli)). /* Тип прибора */'",""),
            device_purpose_id = NULLIF("'.mysqli_real_escape_string($mysqli, val_insert("device_purpose", "device_purpose_id", "device_purpose_name", $_POST['device_purpose'], $mysqli)). /* Назначение */'",""),
            operation_principle_id = NULLIF("'.mysqli_real_escape_string($mysqli, val_insert("operation_principle", "operation_principle_id", "operation_principle_name", $_POST['operation_principle'], $mysqli)). /* Принцип действия */'",""),
            control_type_id = NULLIF("'.mysqli_real_escape_string($mysqli, val_insert("device_control_type", "control_type_id", "control_type_name", $_POST['device_control_type'], $mysqli)). /* Способ управления */'",""),
            measure_show_type_id = NULLIF("'.mysqli_real_escape_string($mysqli, val_insert("device_measure_show_type", "measure_show_type_id", "measure_show_type_name", $_POST['device_measure_show_type'], $mysqli)). /* Способ воспр. изм. вел. */'",""),
            manufacturing_technology_id = NULLIF("'.mysqli_real_escape_string($mysqli, val_insert("manufacturing_technology", "manufacturing_technology_id", "manufacturing_technology_name", $_POST['manufacturing_technology'], $mysqli)). /* Технология изготовления */'",""),
            measurement_error = NULLIF("'.$_POST['measurement_error']. /* Относительная погрешность */'",""),
            description = NULLIF("'.($_POST['description'] != "" ? mysqli_real_escape_string($mysqli, $_POST['description']) : 'NULL'). /* Описание */'",""),
            measure_min = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['measure_min']). /* Нижняя граница измерений */'",""),
            measure_max = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['measure_max']). /* Верхняя граница измерений */'",""),
            unit_of_measuring = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['unit_of_measuring']). /* Единица измерения величины */'",""),
            lower_temperature_threshold = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['lower_temperature_threshold']). /* Минимальная температура */'",""),
            upper_temperature_threshold = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['upper_temperature_threshold']). /* Максимальная температура */'",""),
            temperature_unit = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['temperature_unit']). /* Единица измерения температуры */'",""),
            length = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['length']). /* Длина */'",""),
            width = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['width']). /* Ширина */'",""),
            height = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['height']). /* Высота */'",""),
            diameter = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['diameter']). /* Диаметр */'",""),
            unit_of_length = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['unit_of_length']). /* Единица измерения длины */'",""),
            weight = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['weight']). /* Масса */'",""),
            unit_of_weight = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['unit_of_weight']). /* Единица измерения массы */'",""),
            power = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['power']). /* Питание(Вольт) */'",""),
            protection_class = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['protection_class']). /* Класс защиты */'",""),
            resource = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['resource']). /* Наработка (Часов) */'",""),
            output_voltage = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['output_voltage']). /* Выходное напряжение */'",""),
            in_resistance = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['in_resistance']). /* Входное сопротивление */'",""),
            out_resistance = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['out_resistance']). /* Выходное сопротивление */'",""),
            dynamic_shift_factor = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_shift_factor']). /* Коэффициент смещения */'",""),
            dynamic_static_sensitivity = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_static_sensitivity']). /* Коэффициент стат. чувств. */'",""),
            dynamic_damping_factor = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_damping_factor']). /* Коэффициент демпфирования */'",""),
            dynamic_time_constant = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_time_constant']). /* Постоянная времени (сек) */'",""),
            dynamic_warm_up_time = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_warm_up_time']). /* Время разогрева */'",""),
            dynamic_cutoff_frequency_min = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_cutoff_frequency_min']). /* Минимальная частота среза (Герц) */'",""),
            dynamic_cutoff_frequency_max = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_cutoff_frequency_max']). /* Максимальная частота среза (Герц) */'",""),
            dynamic_resonant_frequency = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_resonant_frequency']). /* Резонансная частота (Герц) */'",""),
            dynamic_error = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_error']). /* Динамическая погрешность (%) */'",""),
            dynamic_description = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_description']). /* Дополнительные сведения */'",""),
            producer_id = NULLIF("'.mysqli_real_escape_string($mysqli, edit_producer($_POST['producer_id'], $_POST['producer_address'], $_POST['producer_phone'], $_POST['producer_website'], $_POST['producer_email'], $mysqli)). /* ID производителя */'","")
            WHERE device_id = '.$_POST['id']);
            multiple_val_insert('literature', 'literature_id', 'literature_name', 'device_literature', 'device_id', $_POST['id'], $_POST['literature'], $mysqli);
            multiple_val_insert('environment', 'environment_id', 'environment_name', 'device_environment', 'device_id', $_POST['id'], $_POST['environment'], $mysqli);
            multiple_val_insert('application_sphere', 'application_sphere_id', 'application_sphere_name', 'device_application_sphere', 'device_id', $_POST['id'], $_POST['application_sphere'], $mysqli);
            multiple_val_insert('sensors', 'sensor_id', 'Doesn`t matter', 'sensors_in_devices', 'device_id', $_POST['id'], $_POST['sensors_in_devices'], $mysqli);
            multiple_val_insert('measurable_value', 'measurable_value_id', 'measurable_value_name', 'device_measurable_value', 'device_id', $_POST['id'], $_POST['device_measurable_value'], $mysqli);
            change_save($mysqli, 1, $_POST['id']);
        }
        $result = mysqli_query($mysqli, $update_sql);
        $data = array(
            "id" => $_POST['id']
        );
        break;
    case 3: // Сохранение нового прибора
        if($_POST['type_of_product'] == "sensor"){
            $select_sql = ('SELECT name FROM sensors WHERE name = "'.$_POST['name'].'"');
        }
        elseif($_POST['type_of_product'] == "device"){
            $select_sql = ('SELECT name FROM devices WHERE name = "'.$_POST['name'].'"');
        }
        $result = mysqli_query($mysqli, $select_sql);
        $row = mysqli_fetch_assoc($result);
        if ($row['name']){
            if($_POST['type_of_product'] == "sensor"){
                $errors[] = "Такой датчик уже существует";
            }
            elseif($_POST['type_of_product'] == "device"){
                $errors[] = "Такой прибор уже существует";
            }
            break;
        }
        $result = "";
        if ($_POST['type_of_product'] == "sensor"){
            $insert_sql = ('INSERT INTO sensors SET
            sensor_id = NULL,
            name = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['name']). /* Наименование */'",""),
            sensor_type_id = NULLIF("'.mysqli_real_escape_string($mysqli, insert_sensor_type($_POST['product_type'], $_POST['measurable_value'], $mysqli)). /* Тип датчика */'",""),
            sensitive_element_id = NULLIF("'.mysqli_real_escape_string($mysqli, val_insert("sensitive_element", "sensitive_element_id", "sensitive_element_name", $_POST['sensitive_element'], $mysqli)). /* Чувствительный элемент */'",""),
            operation_principle_id = NULLIF("'.mysqli_real_escape_string($mysqli, val_insert("operation_principle", "operation_principle_id", "operation_principle_name", $_POST['operation_principle'], $mysqli)). /* Принцип действия */'",""),
            output_signal_id = NULLIF("'.mysqli_real_escape_string($mysqli, val_insert("output_signal", "output_signal_id", "output_signal_name", $_POST['output_signal'], $mysqli)). /* Характер выходного сигнала */'",""),
            signal_conversation_id = NULLIF("'.mysqli_real_escape_string($mysqli, val_insert("signal_conversation", "signal_conversation_id", "signal_conversation_name", $_POST['signal_conversation'], $mysqli)). /* Характер преобразования сигнала */'",""),
            manufacturing_technology_id = NULLIF("'.mysqli_real_escape_string($mysqli, val_insert("manufacturing_technology", "manufacturing_technology_id", "manufacturing_technology_name", $_POST['manufacturing_technology'], $mysqli)). /* Технология изготовления */'",""),
            measurement_error = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['measurement_error']). /* Относительная погрешность */'",""),
            description = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['description']). /* Описание */'",""),
            measure_min = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['measure_min']). /* Нижняя граница измерений */'",""),
            measure_max = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['measure_max']). /* Верхняя граница измерений */'",""),
            unit_of_measuring = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['unit_of_measuring']). /* Единица измерения величины */'",""),
            lower_temperature_threshold = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['lower_temperature_threshold']). /* Минимальная температура */'",""),
            upper_temperature_threshold = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['upper_temperature_threshold']). /* Максимальная температура */'",""),
            temperature_unit = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['temperature_unit']). /* Единица измерения температуры */'",""),
            length = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['length']). /* Длина */'",""),
            width = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['width']). /* Ширина */'",""),
            height = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['height']). /* Высота */'",""),
            diameter = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['diameter']). /* Диаметр */'",""),
            unit_of_length = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['unit_of_length']). /* Единица измерения длины */'",""),
            weight = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['weight']). /* Масса */'",""),
            unit_of_weight = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['unit_of_weight']). /* Единица измерения массы */'",""),
            power = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['power']). /* Питание(Вольт) */'",""),
            protection_class = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['protection_class']). /* Класс защиты */'",""),
            resource = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['resource']). /* Ресурс работы(Часы) */'",""),
            measuring_channels = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['measuring_channels']). /* Количество измерительных каналов */'",""),
            dynamic_shift_factor = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_shift_factor']). /* Коэффициент смещения */'",""),
            dynamic_static_sensitivity = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_static_sensitivity']). /* Коэффициент стат. чувств. */'",""),
            dynamic_damping_factor = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_damping_factor']). /* Коэффициент демпфирования */'",""),
            dynamic_time_constant = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_time_constant']). /* Постоянная времени (сек) */'",""),
            dynamic_warm_up_time = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_warm_up_time']). /* Время разогрева */'",""),
            dynamic_cutoff_frequency_min = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_cutoff_frequency_min']). /* Минимальная частота среза (Герц) */'",""),
            dynamic_cutoff_frequency_max = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_cutoff_frequency_max']). /* Максимальная частота среза (Герц) */'",""),
            dynamic_resonant_frequency = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_resonant_frequency']). /* Резонансная частота (Герц) */'",""),
            dynamic_error = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_error']). /* Динамическая погрешность (%) */'",""),
            dynamic_description = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_description']). /* Дополнительные сведения */'",""),
            producer_id = NULLIF("'.mysqli_real_escape_string($mysqli, edit_producer($_POST['producer_id'], $_POST['producer_address'], $_POST['producer_phone'], $_POST['producer_website'], $_POST['producer_email'], $mysqli)). /* ID производителя */'",""),
            user_id = NULLIF("'.mysqli_real_escape_string($mysqli, $_SESSION['logged_user']['user_id']). /* ID создателя */'",""),
            deleted = 0'. /* Ключ удаления */'
            ');
        }
        elseif ($_POST['type_of_product'] == "device"){
            $insert_sql = ('INSERT INTO devices SET
            device_id = NULL,
            name = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['name']). /* Наименование */'",""),
            device_type_id = NULLIF("'.mysqli_real_escape_string($mysqli, val_insert("device_type", "device_type_id", "device_type_name", $_POST['product_type'], $mysqli)). /* Тип прибора */'",""),
            device_purpose_id = NULLIF("'.mysqli_real_escape_string($mysqli, val_insert("device_purpose", "device_purpose_id", "device_purpose_name", $_POST['device_purpose'], $mysqli)). /* Назначение */'",""),
            operation_principle_id = NULLIF("'.mysqli_real_escape_string($mysqli, val_insert("operation_principle", "operation_principle_id", "operation_principle_name", $_POST['operation_principle'], $mysqli)). /* Принцип действия */'",""),
            control_type_id = NULLIF("'.mysqli_real_escape_string($mysqli, val_insert("device_control_type", "control_type_id", "control_type_name", $_POST['device_control_type'], $mysqli)). /* Способ управления */'",""),
            measure_show_type_id = NULLIF("'.mysqli_real_escape_string($mysqli, val_insert("device_measure_show_type", "measure_show_type_id", "measure_show_type_name", $_POST['device_measure_show_type'], $mysqli)). /* Способ воспр. изм. вел. */'",""),
            manufacturing_technology_id = NULLIF("'.mysqli_real_escape_string($mysqli, val_insert("manufacturing_technology", "manufacturing_technology_id", "manufacturing_technology_name", $_POST['manufacturing_technology'], $mysqli)). /* Технология изготовления */'",""),
            measurement_error = NULLIF("'.$_POST['measurement_error']. /* Относительная погрешность */'",""),
            description = NULLIF("'.($_POST['description'] != "" ? mysqli_real_escape_string($mysqli, $_POST['description']) : 'NULL'). /* Описание */'",""),
            measure_min = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['measure_min']). /* Нижняя граница измерений */'",""),
            measure_max = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['measure_max']). /* Верхняя граница измерений */'",""),
            unit_of_measuring = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['unit_of_measuring']). /* Единица измерения величины */'",""),
            lower_temperature_threshold = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['lower_temperature_threshold']). /* Минимальная температура */'",""),
            upper_temperature_threshold = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['upper_temperature_threshold']). /* Максимальная температура */'",""),
            temperature_unit = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['temperature_unit']). /* Единица измерения температуры */'",""),
            length = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['length']). /* Длина */'",""),
            width = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['width']). /* Ширина */'",""),
            height = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['height']). /* Высота */'",""),
            diameter = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['diameter']). /* Диаметр */'",""),
            unit_of_length = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['unit_of_length']). /* Единица измерения длины */'",""),
            weight = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['weight']). /* Масса */'",""),
            unit_of_weight = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['unit_of_weight']). /* Единица измерения массы */'",""),
            power = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['power']). /* Питание(Вольт) */'",""),
            protection_class = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['protection_class']). /* Класс защиты */'",""),
            resource = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['resource']). /* Наработка (Часов) */'",""),
            output_voltage = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['output_voltage']). /* Выходное напряжение */'",""),
            in_resistance = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['in_resistance']). /* Входное сопротивление */'",""),
            out_resistance = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['out_resistance']). /* Выходное сопротивление */'",""),
            dynamic_shift_factor = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_shift_factor']). /* Коэффициент смещения */'",""),
            dynamic_static_sensitivity = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_static_sensitivity']). /* Коэффициент стат. чувств. */'",""),
            dynamic_damping_factor = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_damping_factor']). /* Коэффициент демпфирования */'",""),
            dynamic_time_constant = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_time_constant']). /* Постоянная времени (сек) */'",""),
            dynamic_warm_up_time = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_warm_up_time']). /* Время разогрева */'",""),
            dynamic_cutoff_frequency_min = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_cutoff_frequency_min']). /* Минимальная частота среза (Герц) */'",""),
            dynamic_cutoff_frequency_max = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_cutoff_frequency_max']). /* Максимальная частота среза (Герц) */'",""),
            dynamic_resonant_frequency = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_resonant_frequency']). /* Резонансная частота (Герц) */'",""),
            dynamic_error = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_error']). /* Динамическая погрешность (%) */'",""),
            dynamic_description = NULLIF("'.mysqli_real_escape_string($mysqli, $_POST['dynamic_description']). /* Дополнительные сведения */'",""),
            producer_id = NULLIF("'.mysqli_real_escape_string($mysqli, edit_producer($_POST['producer_id'], $_POST['producer_address'], $_POST['producer_phone'], $_POST['producer_website'], $_POST['producer_email'], $mysqli)). /* ID производителя */'",""),
            user_id = NULLIF("'.mysqli_real_escape_string($mysqli, $_SESSION['logged_user']['user_id']). /* ID создателя */'",""),
            deleted = 0'./* Ключ удаления */'
            ');
        }
        mysqli_query($mysqli, $insert_sql); // Выполняем запрос
        $id = mysqli_insert_id($mysqli); // Получаем вбитый ID
        if($_POST['type_of_product'] == "sensor"){ // Только при добавлении новых изделий
            multiple_val_insert('literature', 'literature_id', 'literature_name', 'sensor_literature', 'sensor_id', $id, $_POST['literature'], $mysqli);
            multiple_val_insert('environment', 'environment_id', 'environment_name', 'sensor_environment', 'sensor_id', $id, $_POST['environment'], $mysqli);
            multiple_val_insert('application_sphere', 'application_sphere_id', 'application_sphere_name', 'sensor_application_sphere', 'sensor_id', $id, $_POST['application_sphere'], $mysqli);
        }elseif ($_POST['type_of_product'] == "device") {
            multiple_val_insert('literature', 'literature_id', 'literature_name', 'device_literature', 'device_id', $id, $_POST['literature'], $mysqli);
            multiple_val_insert('environment', 'environment_id', 'environment_name', 'device_environment', 'device_id', $id, $_POST['environment'], $mysqli);
            multiple_val_insert('application_sphere', 'application_sphere_id', 'application_sphere_name', 'device_application_sphere', 'device_id', $id, $_POST['application_sphere'], $mysqli);
            multiple_val_insert('sensors', 'sensor_id', 'Doesn`t matter', 'sensors_in_devices', 'device_id', $id, $_POST['sensors_in_devices'], $mysqli);
            multiple_val_insert('measurable_value', 'measurable_value_id', 'measurable_value_name', 'device_measurable_value', 'device_id', $id, $_POST['device_measurable_value'], $mysqli);
        }
        $data = array(
            "id" => $id
        );
        break;
    case 4: // При изменении типа датчика
        if(is_numeric($_POST['sensor_type_id'])){
            $select_sql = ('SELECT * FROM sensor_type WHERE sensor_type_id ='.$_POST['sensor_type_id']);
            $result = mysqli_query($mysqli, $select_sql);
            $row = mysqli_fetch_assoc($result);
            if($row) {
                $data = array(
                    "measurable_value_id" => $row['measurable_value_id'],
                );
            }else{
                $data = array(
                    "measurable_value_id" => 0,
                );
            }
        }else{
            $data = array(
                "measurable_value_id" => 0,
            );
        }
        break;
    case 5: // Загрузка и обновление изображений
        if ($_POST['type_of_product'] == "sensor") {
            $update_sql = ('UPDATE sensors SET
            scheme = IF("'.$_FILES['scheme'].'" != "","' . mysqli_real_escape_string($mysqli, image_processing($_POST['id'], "scheme", $_FILES['scheme'], $mysqli)) . /* Схема */ '",`scheme`),
            blueprint = IF("'.$_FILES['blueprint'].'" != "","' . mysqli_real_escape_string($mysqli, image_processing($_POST['id'], "blueprint", $_FILES['blueprint'], $mysqli)) . /* Чертеж */ '",`blueprint`),
            picture = IF("'.$_FILES['picture'].'" != "","' . mysqli_real_escape_string($mysqli, image_processing($_POST['id'], "picture", $_FILES['picture'], $mysqli)) . /* Изображение */ '",`picture`),
            dynamic_frequency_response = IF("'.$_FILES['dynamic_frequency_response'].'" != "","' . mysqli_real_escape_string($mysqli, image_processing($_POST['id'], "frequency", $_FILES['dynamic_frequency_response'], $mysqli)) . /* Частотная характеристика (изображение) */ '",`dynamic_frequency_response`)
            WHERE sensor_id = ' . $_POST['id']);
        } elseif ($_POST['type_of_product'] == "device") {
            $update_sql = ('UPDATE devices SET
            scheme = IF("'.$_FILES['scheme'].'" != "","' . mysqli_real_escape_string($mysqli, image_processing($_POST['id'], "scheme", $_FILES['scheme'], $mysqli)) . /* Схема */ '",`scheme`),
            blueprint = IF("'.$_FILES['blueprint'].'" != "","' . mysqli_real_escape_string($mysqli, image_processing($_POST['id'], "blueprint", $_FILES['blueprint'], $mysqli)) . /* Чертеж */ '",`blueprint`),
            picture = IF("'.$_FILES['picture'].'" != "","' . mysqli_real_escape_string($mysqli, image_processing($_POST['id'], "picture", $_FILES['picture'], $mysqli)) . /* Изображение */ '",`picture`),
            dynamic_frequency_response = IF("'.$_FILES['dynamic_frequency_response'].'" != "","' . mysqli_real_escape_string($mysqli, image_processing($_POST['id'], "frequency", $_FILES['dynamic_frequency_response'], $mysqli)) . /* Частотная характеристика (изображение) */ '",`dynamic_frequency_response`)
            WHERE device_id = ' . $_POST['id']);
        }
        mysqli_query($mysqli, $update_sql);
        break;
    case 6: // Удаление - просто ставит флажок, что устройство "удалено" и не показывает его в таблице
        if($_POST['product_type'] == "sensor"){
            $update_sql = ('UPDATE sensors SET deleted = 1 WHERE sensor_id = '.$_POST['id']);
            change_save($mysqli, 0, $_POST['id']);
        }elseif ($_POST['product_type'] == "device"){
            $update_sql = ('UPDATE devices SET deleted = 1 WHERE device_id = '.$_POST['id']);
            change_save($mysqli, 1, $_POST['id']);
        }
        mysqli_query($mysqli, $update_sql);
        break;
    default:
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

function edit_producer($producer_id, $producer_address, $producer_phone, $producer_website, $producer_email, $mysqli){
    $id = 0; // Возваращаемый ID производителя
    if(is_numeric($producer_id)) { // Если передали число (ID производителя)
        $select_sql = ('SELECT producer_id FROM producer WHERE producer_id = '.$producer_id);
        $result = mysqli_query($mysqli, $select_sql);
        $row = mysqli_fetch_assoc($result);
        if($row){
            $update_sql = ('UPDATE producer SET
            producer_address = "'.mysqli_real_escape_string($mysqli, $producer_address).'",
            producer_phone = "'.mysqli_real_escape_string($mysqli, $producer_phone).'",
            producer_website = "'.mysqli_real_escape_string($mysqli, $producer_website).'",
            producer_email = "'.mysqli_real_escape_string($mysqli, $producer_email).'",
            WHERE producer_id ='.$producer_id);
            $result = mysqli_query($mysqli, $update_sql);
            $id = $row['producer_id'];
        }
    }
    else{ // Если передали не число (название производителя)
        $insert_sql = ('INSERT INTO producer SET
            producer_id = NULL,
            producer_name = "' . mysqli_real_escape_string($mysqli, $producer_id) . '",
            producer_address = "' . mysqli_real_escape_string($mysqli, $producer_address) . '",
            producer_phone = "' . mysqli_real_escape_string($mysqli, $producer_phone) . '",
            producer_website = "' . mysqli_real_escape_string($mysqli, $producer_website) . '",
            producer_email = "' . mysqli_real_escape_string($mysqli, $producer_email) . '"');
        $result = mysqli_query($mysqli, $insert_sql); // Вставляем в таблицу нового производителя
        $id = mysqli_insert_id($mysqli); // Получаем вбитый ID
    }
    return $id;
};
function insert_sensor_type($id_type, $id_value, $mysqli){
    if(!is_numeric($id_value)){
        $insert_sql = ('INSERT INTO measurable_value SET
        measurable_value_id = NULL,
        measurable_value_name = "'.mysqli_real_escape_string($mysqli, $id_value).'"');
        mysqli_query($mysqli, $insert_sql);
        $id_value = mysqli_insert_id($mysqli); // Получаем вбитый ID
    }
    if(is_numeric($id_type)){
        $id = $id_type;
    }else{
        $insert_sql = ('INSERT INTO sensor_type SET
        sensor_type_id = NULL,
        measurable_value_id = "'.mysqli_real_escape_string($mysqli, $id_value).'",
        sensor_type_name = "'.mysqli_real_escape_string($mysqli, $id_type).'"');
        mysqli_query($mysqli, $insert_sql);
        $id = mysqli_insert_id($mysqli); // Получаем вбитый ID
    }
    return $id;
}
function val_insert($table, $column_id, $column_name, $id_value, $mysqli){
    $id = 0; // Возваращаемый ID
    if(is_numeric($id_value)) { // Если передали число (ID)
        $select_sql = ('SELECT '.$column_id.' FROM '.$table.' WHERE '.$column_id.' = '.$id_value);
        $result = mysqli_query($mysqli, $select_sql);
        $row = mysqli_fetch_assoc($result);
        if($row){
            $id = $row[$column_id];
        }
    }
    else{ // Если передали не число (название)
        $insert_sql = ('INSERT INTO '.$table.' SET
        '.$column_id.' = NULL,
        '.$column_name.' = "'.mysqli_real_escape_string($mysqli, $id_value).'"');
        mysqli_query($mysqli, $insert_sql);
        $id = mysqli_insert_id($mysqli); // Получаем вбитый ID
    }
    return $id;
}
function multiple_val_insert($sup_table, $sup_id, $sup_name, $sub_table, $sub_id, $product_id, $values, $mysqli){
    $id = 0;
    $delete_sql = ('DELETE FROM '.$sub_table.' WHERE '.$sub_id.' = '.$product_id);
    mysqli_query($mysqli, $delete_sql);
    if ($values != "") {
        foreach ($values AS $value) {
            if (is_numeric($value)) { // Если передали число (ID)
                $select_sql = ('SELECT ' . $sup_id . ' FROM ' . $sup_table . ' WHERE ' . $sup_id . ' = ' . $value);
                $result = mysqli_query($mysqli, $select_sql);
                $row = mysqli_fetch_assoc($result);
                if ($row) {
                    $id = $row[$sup_id];
                }
            } else { // Если передали не число (название)
                $insert_sql = ('INSERT INTO ' . $sup_table . ' SET
                ' . $sup_id . ' = NULL,
                ' . $sup_name . ' = "'.mysqli_real_escape_string($mysqli, $value).'"');
                mysqli_query($mysqli, $insert_sql);
                $id = mysqli_insert_id($mysqli); // Получаем вбитый ID
            }
            $insert_sql = ('INSERT INTO ' . $sub_table . ' SET
            ' . $sub_id . ' = "'.mysqli_real_escape_string($mysqli, $product_id).'",
            ' . $sup_id . ' = "'.mysqli_real_escape_string($mysqli, $id).'"');
            mysqli_query($mysqli, $insert_sql);
        }
    }
}
//dynamic_frequency_response = NULLIF("'.mysqli_real_escape_string($mysqli, image_processing($id, "frequency", $_FILES['dynamic_frequency_response'], $mysqli)). /* Частотная характеристика (изображение) */'","")
function image_processing($id, $type, $file, $mysqli){
    $file_name = $file['name'];
    $file_size = $file['size'];
    $file_tmp = $file['tmp_name'];
    $file_type = $file['type'];
    $file_ext = ".".strtolower(end(explode('.', $file['name'])));
    date_default_timezone_set("Europe/Moscow");
    $uploadDir = '';
    $uploadDir = '../upload/'.$type.'/';
    if ($file_name != "") {
        $file_name = "ID-" . $id . "_" . date("Y-m-d\_H-i-s") . $file_ext;
        move_uploaded_file($file_tmp, $uploadDir . $file_name);
        if ($_POST['type_of_product'] == "sensor") {
            return mysqli_real_escape_string($mysqli, "upload/" . $type . "/" . $file_name);
        } else {
            return mysqli_real_escape_string($mysqli, "upload/" . $type . "/" . $file_name);
        }
    }
    else{
        return null;
    }
//    $_POST['type_of_product'] == "sensor" ?
//        return mysqli_real_escape_string($mysqli, "upload/".$type."/".$file_name) :
//        return mysqli_real_escape_string($mysqli, "upload/".$type."/".$file_name);
}
function change_save($mysqli, $type, $id){
    $insert_sql = ('INSERT INTO changes_info SET
            change_id = NULL,
            user_id = "' . mysqli_real_escape_string($mysqli, $_SESSION['logged_user']['user_id']) . '",
            type = "' . mysqli_real_escape_string($mysqli, $type) . '",
            id = "' . mysqli_real_escape_string($mysqli, $id) . '",
            date = "' . mysqli_real_escape_string($mysqli, date("Y-m-d H:i:s")) . '"');
    mysqli_query($mysqli, $insert_sql); // Вставляем в таблицу
}