function literatureDataTable(product_type, id){
    literatureTable = $('.literatureDataTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Russian.json"
        },
        "ajax": {
            url: "php/dataTablesLiterature.php",
            type: "post",
            data: function (d) {
                d.product_type = product_type
                d.id = id
            },
        },
        "columnDefs": [
            {"className": "dt-center", "targets": "_all"},
            {"targets": 1, "orderDataType": "dom-text", "type": "string"},
            {"targets": 2, "orderDataType": "dom-text", "type": "string"}
        ],
        "columns": [
            null, // Наименование
            null, // Автор
            //null, // Издатель
            null, // Год издания
            //null, // Сайт
            {"orderable": false}, // Включен
        ],
        "aaSorting": [
            //[0, 'asc'],
        ],
        "bSortCellsTop": true,
        "iDisplayLength": 10,
        "lengthMenu": [[10, 20, 50, 100, -1],[10, 20, 50, 100, "Все"]],
        "lengthChange": false,
        "paging": true, //Turn off paging, all records on one page
        "ordering": true, //Turn off ordering of records
        "info": false  //Turn off table information
    })
}