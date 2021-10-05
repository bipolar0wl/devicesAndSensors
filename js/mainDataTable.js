var sensorsCount = 0;
var devicesCount = 0;
var sensorsAmount;
var devicesAmount;
$(document).ready(function() {
    //$('#mainDataTable tfoot th').each( function () { // Для поиска в footer
    //    var title = $(this).text();
    //    $(this).html( '<input type="text" style="width: 130px;" placeholder="'+title+'" />' );
    //} );

    table = $('#mainDataTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Russian.json"
        },
        "initComplete": function(oSettings){
            for(var i = 0; i < oSettings.aoData.length; i++){
                if(oSettings.aoData[i]._aData[1] == "Датчик"){
                    sensorsCount++;
                }
                else{
                    devicesCount++;
                }
            }
            sensorsAmount = sensorsCount;
            devicesAmount = devicesCount;
            $('#sensorsCount').text(" Датчики (" + sensorsCount + "/" + sensorsAmount + ")")
            $('#devicesCount').text(" Приборы (" + devicesCount + "/" + devicesAmount + ")")

            //this.api().columns([1, 2]).every( function () {
            //    var column = this;
            //    var select = $('<select><option value=""></option></select>')
            //        .appendTo( $(column.footer()).empty() )
            //        .on( 'change', function () {
            //            var val = $.fn.dataTable.util.escapeRegex(
            //                $(this).val()
            //            );
            //            column
            //                .search( val ? '^'+val+'$' : '', true, false )
            //                .draw();
            //        } );
            //
            //    column.data().unique().sort().each( function ( d, j ) {
            //        select.append( '<option value="'+d+'">'+d+'</option>' )
            //    } );
            //} );
            //this.api().columns().every( function () {
            //    var that = this;
            //    $( 'input', this.footer() ).on( 'keyup change clear', function () {
            //        if ( that.search() !== this.value ) {
            //            that
            //                .search( this.value )
            //                .draw();
            //        }
            //    } );
            //} );
        },
        "ajax": {
            url: "php/dataTablesSensors.php",
            type: "post",
            data: function (d) {
                d.productTypeSelect = $("#productTypeSelect").val();
                d.countSensor = window.countSensor; // Показывать датчики
                d.countDevice = window.countDevice; // Показывать приборы
                //Общие
                d.filter_operation_principle = $("#filter_operation_principle").val();
                d.filter_manufacturing_technology = $("#filter_manufacturing_technology").val();
                // Датчики
                d.filter_sensitive_element = $("#filter_sensitive_element").val();
                d.filter_output_signal = $("#filter_output_signal").val();
                d.filter_signal_conversation = $("#filter_signal_conversation").val();
                // Приборы
                d.filter_device_purpose = $("#filter_device_purpose").val();
                d.filter_control_type = $("#filter_control_type").val();
                d.filter_measure_show_type = $("#filter_measure_show_type").val();
                d.filter_max_measurement_error = $("#filter_max_measurement_error").val();
                // Диапазон измерений
                d.filter_max_measurement = $("#filter_max_measurement").val(); // Максимальное значение измерения
                d.filter_min_measurement = $("#filter_min_measurement").val(); // Минимальное значение измерения
                d.filter_unit_of_measuring = $("#filter_unit_of_measuring").val(); // Единица измерения величины
                // Диапазон температур
                d.filter_max_temperature = $("#filter_max_temperature").val(); // Максимальная температура
                d.filter_min_temperature = $("#filter_min_temperature").val(); // Минимальная температура
                d.filter_temperature_unit = $("#filter_temperature_unit").val(); // Единица измерения температуры
                // Габаритные размеры и масса
                d.filter_max_length = $("#filter_max_length").val(); // Максимальная длина
                d.filter_max_width = $("#filter_max_width").val(); // Максимальная ширина
                d.filter_max_height = $("#filter_max_height").val(); // Максимальная высота
                d.filter_unit_of_length = $("#filter_unit_of_length").val(); // Единица измерения длины
                d.filter_max_weight = $("#filter_max_weight").val(); // Максимальная масса
                d.filter_unit_of_weight = $("#filter_unit_of_weight").val(); // Единица измерения массы
                // Дополнительно
                d.filter_power = $("#filter_power").val(); // Питание (Вольт)
                d.filter_protection_class = $("#filter_protection_class").val(); // Класс защиты
                d.filter_resource = $("#filter_resource").val(); // Минимальный ресурс (в часах)
                // Датчики
                d.filter_measuring_channels = $("#filter_measuring_channels").val(); // Количество измерительных каналов
                // Приборы
                d.filter_output_voltage = $("#filter_output_voltage").val(); // Выходное напряжение
                d.filter_in_resistance = $("#filter_in_resistance").val(); // Входное сопротивление
                d.filter_out_resistance = $("#filter_out_resistance").val(); // Выходное сопротивление
            },
        },
        "columnDefs": [
            {"className": "dt-center", "targets": "_all"}
        ],
        "columns": [
            null, // Название
            null, // Изделие
            null, // Тип изделия
            null, // Погрешность
            null, // Диапазон измерений
            null, // Ресурс
            null, // Вес
            null, // Габариты
            {"orderable": false} // Действие
        ],
        "aaSorting": [
            //[0, 'asc'],
        ],
        //"scrollY": "calc(100vh - 223px)",
        "scrollCollapse": true,
        "bSortCellsTop": true,
        "iDisplayLength": 10,
        "lengthMenu": [[10, 20, 50, 100, -1],[10, 20, 50, 100, "Все"]],
        "paging": true, //Turn off paging, all records on one page
        "ordering": true, //Turn off ordering of records
        "info": false //Turn off table information
    });
    $('#searchDataTable').keyup(function(){
        table.search($(this).val()).draw();
    })
})