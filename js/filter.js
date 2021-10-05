var countSensor = 1;
var countDevice = 1;

var productTypeSelect; // Тип датчика или прибора
// Основные параметры
// Датчики
var sensitive_element; // Чувствительный элемент
var output_signal; // Характер выходного сигнала
var signal_conversation; // Характер преобразования сигнала
// Приборы
var device_purpose; // Назначение
var control_type; // Способ управления
var measure_show_type; // Способ воспроизведения измеряемой величины
// Общие
var operation_principle; // Принцип действия
var manufacturing_technology; // Технология изготовления
var filter_max_measurement_error; // Максимальная погрешность
// Диапазон измерений
var filter_max_measurement; // Максимальное значение измерения
var filter_min_measurement; // Минимальное значение измерения
var filter_unit_of_measuring; // Единица измерения величины
// Диапазон температур
var filter_max_temperature; // Максимальная температура
var filter_min_temperature; // Минимальная температура
var filter_temperature_unit; // Единица измерения температуры
// Габаритные размеры и масса
var filter_max_length; // Максимальная длина
var filter_max_width; // Максимальная ширина
var filter_filter_max_height; // Максимальная высота
var filter_unit_of_length; // Единица измерения длины
var filter_max_weight; // Максимальная масса
var filter_unit_of_weight; // Единица измерения массы
// Дополнительно
var filter_power; // Питание (Вольт)
var filter_protection_class; // Класс защиты
var filter_resource; // Минимальный ресурс (в часах)
// Датчики
var filter_measuring_channels = ""; // Количество измерительных каналов
// Приборы
var filter_output_voltage = ""; // Выходное напряжение
var filter_in_resistance = ""; // Входное сопротивление
var filter_out_resistance = ""; // Выходное сопротивление

$(document).ready(function() {
    $('#productTypeSelect').select2({ // Здесь плагин select2 я хотел использовать для множественного выбора, не знаю пригодится ли
        placeholder: "Не выбрано",
        //tags: true // Нужно, чтобы добавлять на лету новые значения
    });

    $('#countSensor').change( function() {
        countSensor = +($('#countSensor').prop('checked')); // + Лучше не трогать, или можно написать -0, нужно чтобы true или false были равно 1 или 0
        productTypeSelectFunc()
        redrawDataTable()
        if (countSensor){
            $(".filter_select_sensor").show("fast")
        }
        else{
            $(".filter_select_sensor").hide("fast")
        }
    })
    $('#countDevice').change( function() {
        countDevice = +($('#countDevice').prop('checked'));
        //countDevice = 1;
        productTypeSelectFunc()
        redrawDataTable()
        if (countDevice){
            $(".filter_select_device").show("fast")
        }
        else{
            $(".filter_select_device").hide("fast")
        }
    })
    $('#productTypeSelect').change( function() {
        table.search("")
        if ($("#productTypeSelect").val() > 0){
            $("#label_productTypeSelect").text("Тип датчика")
            $(".filter_select_device").hide("fast")
            $(".filter_select_sensor").show("fast")
        }
        else if($("#productTypeSelect").val() < 0){
            $("#label_productTypeSelect").text("Тип прибора")
            $(".filter_select_sensor").hide("fast")
            $(".filter_select_device").show("fast")
        }
        else{
            $("#label_productTypeSelect").text("Тип датчика или прибора")
            $(".filter_select_sensor").show("fast")
            $(".filter_select_device").show("fast")
        }
        $(".table_filter").val("")
        $(".table_filter_select").val(0)
        redrawDataTable()
    })
    $.ajax({
        url: 'php/filter.php',
        type: 'POST',
        dataType: 'json'
    }).done(function (data) {
        productTypeSelect = data.productTypeSelect
        max_measurement_error = data.max_measurement_error
        // Датчики
        $("#filter_div_sensitive_element").html(data.sensitive_element)
        $('#filter_sensitive_element').change( function() { redrawDataTable() })
        $("#filter_div_output_signal").html(data.output_signal)
        $('#filter_div_output_signal').change( function() { redrawDataTable() })
        $("#filter_div_signal_conversation").html(data.signal_conversation)
        $('#filter_div_signal_conversation').change( function() { redrawDataTable() })
        // Приборы
        $("#filter_div_device_purpose").html(data.device_purpose)
        $('#filter_div_device_purpose').change( function() { redrawDataTable() })
        $("#filter_div_control_type").html(data.control_type)
        $('#filter_div_control_type').change( function() { redrawDataTable() })
        $("#filter_div_measure_show_type").html(data.measure_show_type)
        $('#filter_div_measure_show_type').change( function() { redrawDataTable() })
        // Общие
        $("#filter_div_operation_principle").html(data.operation_principle)
        $('#filter_div_operation_principle').change( function() { redrawDataTable() })
        $("#filter_div_manufacturing_technology").html(data.manufacturing_technology)
        $('#filter_div_manufacturing_technology').change( function() { redrawDataTable() })
        $('.filter-table select').select2({ // Применяем плагин select2 ко всем select
            width: '230px'
        });
        {
            productTypeSelectFunc() // Датчики и/или приборы и их типы
            $(".table_filter").change( function() { redrawDataTable() })
//             slider_one("infelicity", 0.00, +data.max_measurement_error, 0.01, +data.max_measurement_error, "filter_max_measurement_error", "%", 2)
//             // Диапазон измерений
//             slider_one("max_measurement", +data.min_measurement, +data.max_measurement, 1, +data.max_measurement, "filter_max_measurement", "", 1) // Максимальное значение измерения
//             slider_one("min_measurement", +data.min_measurement, +data.max_measurement, 1, +data.min_measurement, "filter_min_measurement", "", 1) // Минимальное значение измерения
//             $('#filter_unit_of_measuring').change( function() { redrawDataTable() }); // Единица измерения величины
// // Диапазон температур
//             slider_one("max_temperature", +data.min_temperature, +data.max_temperature, 1, +data.max_temperature, "filter_max_temperature", "", 1) // Максимальная температура
//             slider_one("min_temperature", +data.min_temperature, +data.max_temperature, 1, +data.min_temperature, "filter_min_temperature", "", 1) // Минимальная температура
//             $('#filter_temperature_unit').change( function() { redrawDataTable() }); // Единица измерения температуры
// // Габаритные размеры и масса
//             slider_one("max_length", 0, +data.max_length, 1, +data.max_length, "filter_max_length", "", 1) // Максимальная длина
//             slider_one("max_width", 0, +data.max_width, 1, +data.max_width, "filter_max_width", "", 1); // Максимальная ширина
//             slider_one("max_height", 0, +data.max_height, 1, +data.max_height, "filter_max_height", "", 1); // Максимальная высота
//             $('#filter_unit_of_length').change( function() { redrawDataTable() }); // Единица измерения длины
//             slider_one("max_weight", 0, +data.max_weight, 1, +data.max_weight, "filter_max_weight", "", 1); // Максимальная масса
//             $('#filter_unit_of_weight').change( function() { redrawDataTable() }); // Единица измерения массы
// // Дополнительно
//             $('#filter_power').change( function() { redrawDataTable() }); // Питание (Вольт)
//             $('#filter_protection_class').change( function() { redrawDataTable() }); // Класс защиты
//             slider_one("resource", 0.00, data.resource, 1, data.resource, "filter_resource", "ч", 2); // Минимальный ресурс (в часах)
// // Датчики
//             $('#filter_measuring_channels').change( function() { redrawDataTable() }); // Количество измерительных каналов
// // Приборы
//             $('#filter_output_voltage').change( function() { redrawDataTable() }); // Выходное напряжение
//             $('#filter_in_resistance').change( function() { redrawDataTable() }); // Входное сопротивление
//             $('#filter_out_resistance').change( function() { redrawDataTable() }); // Выходное сопротивление
        }
    }).fail(function () {
        alert("Ошибка отправки данных")
    });
})

$(document).on('click','#productTypeSelect',function(e) {
    e.preventDefault();
    $.ajax({
        url: 'php/authorization.php',
        type: 'POST',
        dataType: 'json'
    }).done(function(data){
    }).fail(function(){
        alert("Ошибка отправки данных")
    });
});
//
function slider_one(parameter, min, max, step, value, filter, symbol, cut_off) {
    $(function () {
        $("#range-" + parameter).slider({
            range: false,
            min: min,
            max: max,
            step: step,
            value: value,
            slide: function (event, ui) {
                $("#amount-" + parameter).val(ui.value + " " + symbol);
            },
            stop: function (event, ui) {
                if (ui.value == value) {
                    window[filter] = null
                } else {
                    window[filter] = ui.value
                }
                redrawDataTable();
            }
        });
        $('#productTypeSelect').change( function() { // Изменяется изделие
            $("#range-" + parameter).slider("value", value);
            // $(this).val() == value
            console.log(value)
        })
        $("#amount-" + parameter).val($("#range-" + parameter).slider("values", 0) + " " + symbol);
        $("#amount-" + parameter).focus(function () {
            $("#amount-" + parameter).val(this.value.substring(0, this.value.length - cut_off));
        })
        $("#amount-" + parameter).blur(function () { // Снятие фокусировки с поля фильтра
            $("#range-" + parameter).slider("value", $(this).val());
            $(this).val() < min ? $(this).val(min) : $(this).val()
            $(this).val() > max ? $(this).val(max) : $(this).val()
            if ($(this).val() == value) {
                window[filter] = null
            } else {
                window[filter] = $(this).val()
            }
            $("#amount-" + parameter).val(this.value + " " + symbol);
            redrawDataTable();
        })
    })
}
function slider_double(parameter, min, max, step, value_min, value_max, filter_min, filter_max, symbol){
    $("#range-"+parameter).slider({
        range: true,
        min: min - 0,
        max: max - 0,
        step: step,
        values: [value_min, value_max],
        slide: function (event, ui) {
            $("#amount-"+parameter).val(ui.values[0] + " " + symbol + " - " + ui.values[1] + " " + symbol);
            filter_min = ui.values[0]
            filter_max = ui.values[1]
            redrawDataTable();
        }
    });
    $("#amount-"+parameter).val($("#range-"+parameter).slider("values", 0) + " " + symbol +
        " - " + $("#range-"+parameter).slider("values", 1) + " " + symbol);
    $('.filter-table').append();
}

function drop_filters() {
    $(".table_filter").val("")
    table.search("")
    $('#countSensor').prop('checked', true)
    $('#countDevice').prop('checked', true)
    // $(".table_filter_select").val(0)
    // $("#productTypeSelect").val(0)
    $('.table_filter_select option[value=0]').prop('selected', true);
    $(".table_filter_select").trigger('change.select2')
    $('#productTypeSelect option[value=0]').prop('selected', true);
    $("#productTypeSelect").trigger('change.select2')
    redrawDataTable()
    notification("Фильтры сброшены")
}

function productTypeSelectFunc(){ // Обрабатывается <select>
    $('#productTypeSelect optgroup[label=Датчики]').remove()
    $('#productTypeSelect optgroup[label=Приборы]').remove()
    if (countSensor) {
        $('#productTypeSelect').append($("<optgroup label='Датчики'></optgroup>"))
        $("#label_productTypeSelect").text("Тип датчика")
    }
    if (countDevice) {
        $('#productTypeSelect').append($("<optgroup label='Приборы'></optgroup>"))
        $("#label_productTypeSelect").text("Тип прибора")
    }
    if(countSensor && countDevice){
        $("#label_productTypeSelect").text("Тип датчика или прибора")
    }
    Object.keys(productTypeSelect).forEach(function (entry) { // Для каждого ключа
        if (entry > 0) {
            $('#productTypeSelect optgroup[label=Датчики]').append($("<option></option>", {
                value: entry,
                text: productTypeSelect[entry]
            }))
        }
        if (entry < 0) {
            $('#productTypeSelect optgroup[label=Приборы]').append($("<option></option>", {
                value: entry,
                text: productTypeSelect[entry]
            }))
        }
    })
}

function redrawDataTable() {
    $('#mainDataTable').DataTable().ajax.reload(function(){
        sensorsCount = 0;
        devicesCount = 0;
        for(var i = 0; i < table.context[0].json.data.length; i++){
            if(table.context[0].json.data[i][1] == "Датчик"){
                sensorsCount++;
            }
            else{
                devicesCount++;
            }
        }
        $('#sensorsCount').text(" Датчики (" + sensorsCount + "/" + sensorsAmount + ")")
        $('#devicesCount').text(" Приборы (" + devicesCount + "/" + devicesAmount + ")")
    })
}