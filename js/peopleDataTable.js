$(document).ready(function() {
    peopleTable = $('.peopleDataTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Russian.json"
        },
        "ajax": {
            url: "php/dataTablesPeople.php",
            type: "post",
            data: function (d) {
            },
        },
        "columnDefs": [
            {"className": "dt-center", "targets": "_all"},
            {"targets": 1, "orderDataType": "dom-text", "type": "string"},
            {"targets": 2, "orderDataType": "dom-text", "type": "string"}
        ],
        "columns": [
            null, // Логин
            null, // Уровень доступа
            null, // Фамилия
            null, // Имя
            null, // Отчество
            null, // Почта
            null, // Дата регистрации
            {"orderable": false} // Действие
        ],
        "aaSorting": [
            //[0, 'asc'],
        ],
        "bSortCellsTop": true,
        "iDisplayLength": 10,
        "bLengthChange": false,
        "lengthMenu": [[10, 20, 50, 100, -1],[10, 20, 50, 100, "Все"]],
        "paging": true, //Turn off paging, all records on one page
        "ordering": true, //Turn off ordering of records
        "info": false  //Turn off table information
    })
})