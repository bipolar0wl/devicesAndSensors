function select_producer(){
    $.ajax({
        url:'php/product_actions.php',
        type:'POST',
        data:{
            key: 1,
            producer_id: $("#producer").val(),
            producer_name: $("#producer_name").val(),
            producer_address: $("#producer_address").val(),
            producer_phone: $("#producer_phone").val(),
            producer_website: $("#producer_website").val(),
            producer_email: $("#producer_email").val()
        },
        dataType:'json'
    }).done(function(data) {
        $("#producer_name").val(data.producer_name)
        $("#producer_address").val(data.producer_address)
        $("#producer_phone").val(data.producer_phone)
        $("#producer_website").val(data.producer_website)
        $("#producer_email").val(data.producer_email)
    }).fail(function(data){
        alert("Ошибка отправки данных")
    });
}
//function select_literature(){
//    let list = "<table style='border: 1px solid'>"
//    $.each(literature_list, function(index, value){
//        list += "<tr><td>"+value+"</td></tr>"
//    })
//    list += "</table>"
//    $("#literature_list").html(list);
//}
function select_sensor_type(){ // Обновляет измерямую величину у датчика
    $.ajax({
        url:'php/product_actions.php',
        type:'POST',
        data:{
            key: 4,
            sensor_type_id: $("#product_type").val(),
        },
        dataType:'json'
    }).done(function(data) {
        $("#measurable_value option[value="+data.measurable_value_id+"]").prop("selected", "true")
        $("#measurable_value").trigger('change.select2')
        if($("#product_type").val() == 0 || isNaN($("#product_type").val())){
            $("#measurable_value").prop("disabled", false)
        }else{
            $("#measurable_value").prop("disabled", true)
        }
        //$("#product_type").trigger('change.select2')
    }).fail(function(data){
        alert("Ошибка отправки данных")
    });
}
function edit_product(swithKey){
    if ($("#name").val() == ""){
        notification("Введите название")
        return;
    }
    $.ajax({
        url:'php/product_actions.php',
        type:'POST',
        data:{
            key: swithKey,
            id: $("#id").val(),
            type_of_product: $("#type_of_product").val(), // Датчик или прибор
            // Основные параметры
            name: $("#name").val(), // Наименование
            product_type: $("#product_type").val(), // Тип изделия
            measurable_value: $("#measurable_value").val(), // Измеряемая величина (Датчики)
            sensitive_element: $("#sensitive_element").val(), // Чувствительный элемент (Датчики)
            operation_principle: $("#operation_principle").val(), // Принцип действия
            output_signal: $("#output_signal").val(), // Характер выходного сигнала (Датчики)
            signal_conversation: $("#signal_conversation").val(), // Характер преобразования сигнала (Датчики)
            device_control_type: $("#device_control_type").val(), // Способ управления (Приборы)
            device_purpose: $("#device_purpose").val(), // Назначения (Приборы)
            device_measure_show_type: $("#device_measure_show_type").val(), // Способ воспр. изм. вел. (Приборы)
            manufacturing_technology: $("#manufacturing_technology").val(), // Технология изготовления
            measurement_error: $("#measurement_error").val(), // Относительная погрешность
            description: $("#description").val(), // Относительная погрешность
            measure_min: $("#measure_min").val(), // Нижняя граница измерений
            measure_max: $("#measure_max").val(), // Верхняя граница измерений
            unit_of_measuring: $("#unit_of_measuring").val(), // Единица измерения величины
            lower_temperature_threshold: $("#lower_temperature_threshold").val(), // Минимальная температура
            upper_temperature_threshold: $("#upper_temperature_threshold").val(), // Максимальная температура
            temperature_unit: $("#temperature_unit").val(), // Единица измерения температуры
            length: $("#length").val(), // Длина
            width: $("#width").val(), // Ширина
            height: $("#height").val(), // Высота
            diameter: $("#diameter").val(), // Диаметр
            unit_of_length: $("#unit_of_length").val(), // Единица измерения длины
            weight: $("#weight").val(), // Масса
            unit_of_weight: $("#unit_of_weight").val(), // Единица измерения массы
            power: $("#power").val(), // Питание
            protection_class: $("#protection_class").val(), // Класс защиты
            resource: $("#resource").val(), // Ресурс работы/наработка
            measuring_channels: $("#measuring_channels").val(), // Количество измерительных каналов (Датчики)
            output_voltage: $("#output_voltage").val(), // Выходное напряжение (Приборы)
            in_resistance: $("#in_resistance").val(), // Входное сопротивление (Приборы)
            out_resistance: $("#out_resistance").val(), // Выходное сопротивление (Приборы)
            // Динамические параметры
            dynamic_shift_factor: $("#dynamic_shift_factor").val(), // Коэффициент смещения
            dynamic_static_sensitivity: $("#dynamic_static_sensitivity").val(), // Коэффициент стат. чувств.
            dynamic_damping_factor: $("#dynamic_damping_factor").val(), // Коэффициент демпфирования
            dynamic_time_constant: $("#dynamic_time_constant").val(), // Постоянная времени (сек)
            dynamic_warm_up_time: $("#dynamic_warm_up_time").val(), // Время разогрева
            dynamic_cutoff_frequency_min: $("#dynamic_cutoff_frequency_min").val(), // Минимальная частота среза (Герц)
            dynamic_cutoff_frequency_max: $("#dynamic_cutoff_frequency_max").val(), // Максимальная частота среза (Герц)
            dynamic_resonant_frequency: $("#dynamic_resonant_frequency").val(), // Резонансная частота (Герц)
            dynamic_error: $("#dynamic_error").val(), // Динамическая погрешность (%)
            dynamic_description: $("#dynamic_description").val(), // Дополнительные сведения
            // Дополнительные
            producer_id: $("#producer").val(), // Производитель id или наименование
            producer_address: $("#producer_address").val(), // Адрес
            producer_phone: $("#producer_phone").val(), // Телефон
            producer_website: $("#producer_website").val(), // Веб сайт
            producer_email: $("#producer_email").val(), // E-mail
            literature: $("#literature").val(), // Среда измерения
            environment: $("#environment").val(), // Среда измерения
            application_sphere: $("#application_sphere").val(), // Область применения
            sensors_in_devices: $("#sensors_in_devices").val(), // Список датчиков (Приборы)
            device_measurable_value: $("#device_measurable_value").val(), // Список измеряемых величин (Приборы)
            // Изображения
            //scheme: $("#scheme_file")[0].files[0],
            //blueprint: $("#blueprint_file")[0].files[0],
            //picture: $("#picture_file")[0].files[0],
            //dynamic_frequency_response: $("#dynamic_frequency_response_file")[0].files[0]
        },
        //processData: false, // Не обрабатываем файлы (Don't process the files)
        //contentType: false, // Так jQuery скажет серверу что это строковой запрос
        dataType:'json'
    }).done(function(data) {
        if(!!data.error){
            notification(data.error)
            return;
        }
        else{
            if (swithKey == 2){
                image_processing(data.id)
                notification("Устройство обновлено")
            }
            else if (swithKey == 3) {
                notification("Устройство добавлено")
                image_processing(data.id)
                //document.location.hash = ($("#type_of_product").val() + "-" + data.id)
                window.location.href = ("product.php?id=" + data.id + "&product_type=" + $("#type_of_product").val())
            }
        }
    }).fail(function(data){
        alert("Ошибка отправки данных")
    });
}
function image_processing(product_id){
    var form_data = new FormData();
    form_data.append('key', 5);
    form_data.append('id', product_id);
    form_data.append('type_of_product', $('#type_of_product').val());
    //console.log($("#scheme_file")[0].files[0])
    form_data.append('scheme', $("#scheme_file")[0].files[0]);
    form_data.append('blueprint', $("#blueprint_file")[0].files[0]);
    form_data.append('picture', $("#picture_file")[0].files[0]);
    form_data.append('dynamic_frequency_response', $("#dynamic_frequency_response_file")[0].files[0]);
    $.ajax({
        url:'php/product_actions.php',
        type:'POST',
        cache: false,
        data: form_data,
        dataType:'json',
        processData: false, // Не обрабатываем файлы (Don't process the files)
        contentType: false, // Так jQuery скажет серверу что это строковой запрос
    }).done(function(data) {
        //notification("Изображение добавлено")
    }).fail(function(data){
        alert("Ошибка отправки данных")
    });
}
function download_doc(id, product_type){
    window.location.href = ("../php/phpWord.php?id=" + id + "&product_type=" + product_type)
}
//function products_create_dep_name_list(){
//    var list_dep = '<ul>';
//    $.each(product_deps_list,function(index,value){
//        if(index!=0) {
//            list_dep += '<li class="main_row"><img align="bottom" alt="del" class="curs_point" onclick="products_del_dep_name(' + index + ')" src="images/16x16_not_available.png">&nbsp;' + value + '</li>';
//        }
//    })
//    list_dep += '</ul>';
//    $('#depNamesList').html(list_dep);
//}