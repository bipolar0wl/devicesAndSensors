$(document).ready(function() {
    $('select').select2({ // Применяем плагин select2 ко всем select
        tags: false, // Нужно, чтобы добавлять на лету новые значения
    });
    $("#edit_measurable_value").change(function(){ // Дополнение к sub_change case: 7
        if ($("#edit_measurable_value").val() == 0){
            $("#edit_measurable_value_name").val("")
        }else {
            $("#edit_measurable_value_name").val($("#edit_measurable_value option:selected").text())
        }
    })
})

function sub_change(key, status) {
    switch (key) {
        case 1: // Производитель
            $.ajax({
                url:'php/sub_info_actions.php',
                type:'POST',
                data:{
                    key: key,
                    function_key: 1,
                    producer_id: $("#edit_producer").val()
                },
                dataType:'json'
            }).done(function(data) {
                if ($("#edit_producer").val() == 0){
                    $("#edit_producer_name").val("")
                }else {
                    $("#edit_producer_name").val($("#edit_producer option:selected").text())
                }
                $("#edit_producer_address").val(data.producer_address)
                $("#edit_producer_phone").val(data.producer_phone)
                $("#edit_producer_website").val(data.producer_website)
                $("#edit_producer_email").val(data.producer_email)
            }).fail(function(data){
                alert("Ошибка отправки данных")
            });
            change_text_save_changes($("#edit_producer").val(), status)
            break;
        case 2: // Литература
            $.ajax({
                url:'php/sub_info_actions.php',
                type:'POST',
                data:{
                    key: key,
                    function_key: 1,
                    literature_id: $("#edit_literature").val()
                },
                dataType:'json'
            }).done(function(data) {
                if ($("#edit_literature").val() == 0){
                    $("#edit_literature_name").val("")
                }else {
                    $("#edit_literature_name").val($("#edit_literature option:selected").text())
                }
                $("#edit_literature_author").val(data.literature_author)
                $("#edit_literature_date").val(data.literature_date)
                $("#edit_literature_publisher").val(data.literature_publisher)
                $("#edit_literature_website").val(data.literature_website)
            }).fail(function(data){
                alert("Ошибка отправки данных")
            });
            change_text_save_changes($("#edit_literature").val(), status)
            break;
        case 3: // Среда измерения
            $.ajax({
                url:'php/sub_info_actions.php',
                type:'POST',
                data:{
                    key: key,
                    function_key: 1,
                    environment_id: $("#edit_environment").val()
                },
                dataType:'json'
            }).done(function(data) {
                if ($("#edit_environment").val() == 0){
                    $("#edit_environment_name").val("")
                }else {
                    $("#edit_environment_name").val($("#edit_environment option:selected").text())
                }
                $("#edit_environment_description").val(data.edit_environment_description)
            }).fail(function(data){
                alert("Ошибка отправки данных")
            });
            change_text_save_changes($("#edit_environment").val(), status)
            break;
        case 4: // Область применения
            $.ajax({
                url:'php/sub_info_actions.php',
                type:'POST',
                data:{
                    key: key,
                    function_key: 1,
                    application_sphere_id: $("#edit_application_sphere").val()
                },
                dataType:'json'
            }).done(function(data) {
                if ($("#edit_application_sphere").val() == 0){
                    $("#edit_application_sphere_name").val("")
                }else {
                    $("#edit_application_sphere_name").val($("#edit_application_sphere option:selected").text())
                }
            }).fail(function(data){
                alert("Ошибка отправки данных")
            });
            change_text_save_changes($("#edit_environment").val(), status)
            break;
        case 5: // Технология изготовления
            $.ajax({
                url:'php/sub_info_actions.php',
                type:'POST',
                data:{
                    key: key,
                    function_key: 1,
                    manufacturing_technology_id: $("#edit_manufacturing_technology").val()
                },
                dataType:'json'
            }).done(function(data) {
                if ($("#edit_manufacturing_technology").val() == 0){
                    $("#edit_manufacturing_technology_name").val("")
                }else {
                    $("#edit_manufacturing_technology_name").val($("#edit_manufacturing_technology option:selected").text())
                }
                $("#edit_manufacturing_technology_description").val(data.manufacturing_technology_description)
            }).fail(function(data){
                alert("Ошибка отправки данных")
            });
            change_text_save_changes($("#edit_manufacturing_technology").val(), status)
            break;
        case 6: // Принцип действия
            $.ajax({
                url:'php/sub_info_actions.php',
                type:'POST',
                data:{
                    key: key,
                    function_key: 1,
                    operation_principle_id: $("#edit_operation_principle").val()
                },
                dataType:'json'
            }).done(function(data) {
                if ($("#edit_operation_principle").val() == 0){
                    $("#edit_operation_principle_name").val("")
                }else {
                    $("#edit_operation_principle_name").val($("#edit_operation_principle option:selected").text())
                }
                $("#edit_operation_principle_description").val(data.operation_principle_description)
            }).fail(function(data){
                alert("Ошибка отправки данных")
            });
            change_text_save_changes($("#edit_operation_principle").val(), status)
            break;
        case 7: // Тип датчика
            $.ajax({
                url:'php/sub_info_actions.php',
                type:'POST',
                data:{
                    key: key,
                    function_key: 1,
                    sensor_type_id: $("#edit_sensor_type").val()
                },
                dataType:'json'
            }).done(function(data) {
                if ($("#edit_sensor_type").val() == 0){
                    $("#edit_sensor_type_name").val("")
                }else {
                    $("#edit_sensor_type_name").val($("#edit_sensor_type option:selected").text())
                }
                if(data.measurable_value_id) {
                    $("#edit_measurable_value").val(data.measurable_value_id);
                }
                else{
                    $("#edit_measurable_value").val(0);
                }
                $('#edit_measurable_value').trigger('change');
                if ($("#edit_measurable_value").val() == 0){
                    $("#edit_measurable_value_name").val("")
                }else {
                    $("#edit_measurable_value_name").val($("#edit_measurable_value option:selected").text())
                }
                // $('#edit_measurable_value_name').val($("#edit_measurable_value").val());
            }).fail(function(data){
                alert("Ошибка отправки данных")
            });
            change_text_save_changes($("#edit_sensor_type").val(), status)
            break;
        case 8: // Чувствительный элемент
            $.ajax({
                url:'php/sub_info_actions.php',
                type:'POST',
                data:{
                    key: key,
                    function_key: 1,
                    sensitive_element_id: $("#edit_sensitive_element").val()
                },
                dataType:'json'
            }).done(function(data) {
                if ($("#edit_sensitive_element").val() == 0){
                    $("#edit_sensitive_element_name").val("")
                }else {
                    $("#edit_sensitive_element_name").val($("#edit_sensitive_element option:selected").text())
                }
                $("#edit_sensitive_element_description").val(data.sensitive_element_description)
            }).fail(function(data){
                alert("Ошибка отправки данных")
            });
            change_text_save_changes($("#edit_sensitive_element").val(), status)
            break;
        case 9: // Характер выходного сигнала
            $.ajax({
                url:'php/sub_info_actions.php',
                type:'POST',
                data:{
                    key: key,
                    function_key: 1,
                    output_signal_id: $("#edit_output_signal").val()
                },
                dataType:'json'
            }).done(function(data) {
                if ($("#edit_output_signal").val() == 0){
                    $("#edit_output_signal_name").val("")
                }else {
                    $("#edit_output_signal_name").val($("#edit_output_signal option:selected").text())
                }
                $("#edit_output_signal_description").val(data.output_signal_description)
            }).fail(function(data){
                alert("Ошибка отправки данных")
            });
            change_text_save_changes($("#edit_output_signal").val(), status)
            break;
        case 10: // Характер преобразования сигнала
            $.ajax({
                url:'php/sub_info_actions.php',
                type:'POST',
                data:{
                    key: key,
                    function_key: 1,
                    signal_conversation_id: $("#edit_signal_conversation").val()
                },
                dataType:'json'
            }).done(function(data) {
                if ($("#edit_signal_conversation").val() == 0){
                    $("#edit_signal_conversation_name").val("")
                }else {
                    $("#edit_signal_conversation_name").val($("#edit_signal_conversation option:selected").text())
                }
                $("#edit_signal_conversation_description").val(data.signal_conversation_description)
            }).fail(function(data){
                alert("Ошибка отправки данных")
            });
            change_text_save_changes($("#edit_signal_conversation").val(), status)
            break;
        case 11: // Тип прибора
            if ($("#edit_device_type").val() == 0){
                $("#edit_device_type_name").val("")
            }else{
                $("#edit_device_type_name").val($("#edit_device_type option:selected").text())
            }
            change_text_save_changes($("#edit_device_type").val(), status)
            break;
        case 12: // Назначение прибора
            if ($("#edit_device_purpose").val() == 0){
                $("#edit_device_purpose_name").val("")
            }else{
                $("#edit_device_purpose_name").val($("#edit_device_purpose option:selected").text())
            }
            change_text_save_changes($("#edit_device_purpose").val(), status)
            break;
        case 13: // Способ управления
            if ($("#edit_device_control_type").val() == 0){
                $("#edit_control_type_name").val("")
            }else{
                $("#edit_control_type_name").val($("#edit_device_control_type option:selected").text())
            }
            change_text_save_changes($("#edit_device_control_type").val(), status)
            break;
        case 14: // Воспроизведение измеряемой величины
            if ($("#edit_device_measure_show_type").val() == 0){
                $("#edit_measure_show_type_name").val("")
            }else{
                $("#edit_measure_show_type_name").val($("#edit_device_measure_show_type option:selected").text())
            }
            change_text_save_changes($("#edit_device_measure_show_type").val(), status)
            break;
        default:
            break;
    }
}
function change_text_save_changes(inp_val, status) {
    $("#edit_save_changes").show()
    if(inp_val == 0){
        $("#edit_save_changes").text("Добавить")
    }
    else if(status > 2){
        $("#edit_save_changes").text("Сохранить изменения")
    }
    else{
        $("#edit_save_changes").hide()
    }
}

function save_changes(key) {
    switch (key) {
        case 1: // Производитель
            $.ajax({
                url:'php/sub_info_actions.php',
                type:'POST',
                data:{
                    key: key,
                    function_key: 2,
                    producer_id: $("#edit_producer").val(),
                    producer_name: $("#edit_producer_name").val(),
                    producer_address: $("#edit_producer_address").val(),
                    producer_phone: $("#edit_producer_phone").val(),
                    producer_website: $("#edit_producer_website").val(),
                    producer_email: $("#edit_producer_email").val()
                },
                dataType:'json'
            }).done(function(data){
                notification("Производитель сохранен")
            }).fail(function(data){
                alert("Ошибка отправки данных")
            });
            break;
        case 2: // Литература
            $.ajax({
                url:'php/sub_info_actions.php',
                type:'POST',
                data:{
                    key: key,
                    function_key: 2,
                    literature_id: $("#edit_literature").val(),
                    literature_name: $("#edit_literature_name").val(),
                    literature_author: $("#edit_literature_author").val(),
                    literature_date: $("#edit_literature_date").val(),
                    literature_publisher: $("#edit_literature_publisher").val(),
                    literature_website: $("#edit_literature_website").val()
                },
                dataType:'json'
            }).done(function(data) {
                notification("Литература сохранена")
            }).fail(function(data){
                alert("Ошибка отправки данных")
            });
            break;
        case 3: // Среда измерения
            $.ajax({
                url:'php/sub_info_actions.php',
                type:'POST',
                data:{
                    key: key,
                    function_key: 2,
                    environment_id: $("#edit_environment").val(),
                    environment_name: $("#edit_environment_name").val(),
                    environment_description: $("#edit_environment_description").val(),
                },
                dataType:'json'
            }).done(function(data) {
                notification("Среда измерения сохранена")
            }).fail(function(data){
                alert("Ошибка отправки данных")
            });
            break;
        case 4: // Область применения
            $.ajax({
                url:'php/sub_info_actions.php',
                type:'POST',
                data:{
                    key: key,
                    function_key: 2,
                    application_sphere_id: $("#edit_application_sphere").val(),
                    application_sphere_name: $("#edit_application_sphere_name").val()
                },
                dataType:'json'
            }).done(function(data) {
                notification("Область применения сохранена")
            }).fail(function(data){
                alert("Ошибка отправки данных")
            });
            break;
        case 5: // Технология изготовления
            $.ajax({
                url:'php/sub_info_actions.php',
                type:'POST',
                data:{
                    key: key,
                    function_key: 2,
                    manufacturing_technology_id: $("#edit_manufacturing_technology").val(),
                    manufacturing_technology_name: $("#edit_manufacturing_technology_name").val(),
                    manufacturing_technology_description: $("#edit_manufacturing_technology_description").val(),
                },
                dataType:'json'
            }).done(function(data) {
                notification("Технология изготовления сохранена")
            }).fail(function(data){
                alert("Ошибка отправки данных")
            });
            break;
        case 6: // Принцип действия
            $.ajax({
                url:'php/sub_info_actions.php',
                type:'POST',
                data:{
                    key: key,
                    function_key: 2,
                    operation_principle_id: $("#edit_operation_principle").val(),
                    operation_principle_name: $("#edit_operation_principle_name").val(),
                    operation_principle_description: $("#edit_operation_principle_description").val(),
                },
                dataType:'json'
            }).done(function(data) {
                notification("Принцип действия сохранен")
            }).fail(function(data){
                alert("Ошибка отправки данных")
            });
            break;
        case 7: // Тип датчика
            $.ajax({
                url:'php/sub_info_actions.php',
                type:'POST',
                data:{
                    key: key,
                    function_key: 2,
                    sensor_type_id: $("#edit_sensor_type").val(),
                    //sensor_type_name: $("#edit_sensor_type option:selected").text(),
                    sensor_type_name: $("#edit_sensor_type_name").val(),
                    measurable_value_id: $("#edit_measurable_value").val(),
                    //measurable_value_name: $("#edit_measurable_value option:selected").text()
                    measurable_value_name: $("#edit_measurable_value_name").val()
                },
                dataType:'json'
            }).done(function(data) {
                notification("Тип датчика сохранен")
            }).fail(function(data){
                alert("Ошибка отправки данных")
            });
            break;
        case 8: // Чувствительный элемент
            $.ajax({
                url:'php/sub_info_actions.php',
                type:'POST',
                data:{
                    key: key,
                    function_key: 2,
                    sensitive_element_id: $("#edit_sensitive_element").val(),
                    sensitive_element_name: $("#edit_sensitive_element_name").val(),
                    sensitive_element_description: $("#edit_sensitive_element_description").val(),
                },
                dataType:'json'
            }).done(function(data) {
                notification("Чувствительый элемент сохранен")
            }).fail(function(data){
                alert("Ошибка отправки данных")
            });
            break;
        case 9: // Характер выходного сигнала
            $.ajax({
                url:'php/sub_info_actions.php',
                type:'POST',
                data:{
                    key: key,
                    function_key: 2,
                    output_signal_id: $("#edit_output_signal").val(),
                    output_signal_name: $("#edit_output_signal_name").val(),
                    output_signal_description: $("#edit_output_signal_description").val(),
                },
                dataType:'json'
            }).done(function(data) {
                notification("Характер выходного сигнала сохранен")
            }).fail(function(data){
                alert("Ошибка отправки данных")
            });
            break;
        case 10: // Характер преобразования сигнала
            $.ajax({
                url:'php/sub_info_actions.php',
                type:'POST',
                data:{
                    key: key,
                    function_key: 2,
                    signal_conversation_id: $("#edit_signal_conversation").val(),
                    signal_conversation_name: $("#edit_signal_conversation_name").val(),
                    signal_conversation_description: $("#edit_signal_conversation_description").val(),
                },
                dataType:'json'
            }).done(function(data) {
                notification("Характер преобразования сигнала сохранен")
            }).fail(function(data){
                alert("Ошибка отправки данных")
            });
            break;
        case 11: // Тип прибора
            $.ajax({
                url:'php/sub_info_actions.php',
                type:'POST',
                data:{
                    key: key,
                    function_key: 2,
                    device_type_id: $("#edit_device_type").val(),
                    device_type_name: $("#edit_device_type_name").val()
                },
                dataType:'json'
            }).done(function(data) {
                notification("Тип прибора сохранен")
            }).fail(function(data){
                alert("Ошибка отправки данных")
            });
            break;
        case 12: // Назначение прибора
            $.ajax({
                url:'php/sub_info_actions.php',
                type:'POST',
                data:{
                    key: key,
                    function_key: 2,
                    device_purpose_id: $("#edit_device_purpose").val(),
                    device_purpose_name: $("#edit_device_purpose_name").val()
                },
                dataType:'json'
            }).done(function(data) {
                notification("Назначение прибора сохранено")
            }).fail(function(data){
                alert("Ошибка отправки данных")
            });
            break;
        case 13: // Способ управления
            $.ajax({
                url:'php/sub_info_actions.php',
                type:'POST',
                data:{
                    key: key,
                    function_key: 2,
                    control_type_id: $("#edit_device_control_type").val(),
                    control_type_name: $("#edit_control_type_name").val()
                },
                dataType:'json'
            }).done(function(data) {
                notification("Спопсоб управления сохранен")
            }).fail(function(data){
                alert("Ошибка отправки данных")
            });
            break;
        case 14: // Воспроизведение измеряемой величины
            $.ajax({
                url:'php/sub_info_actions.php',
                type:'POST',
                data:{
                    key: key,
                    function_key: 2,
                    measure_show_type_id: $("#edit_device_measure_show_type").val(),
                    measure_show_type_name: $("#edit_measure_show_type_name").val()
                },
                dataType:'json'
            }).done(function(data) {
                notification("Воспроизведение измеряемой величины сохранено")
            }).fail(function(data){
                alert("Ошибка отправки данных")
            });
            break;
        default:
            break;
    }
    location.reload()
}