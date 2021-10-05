$(document).ready(function() {
    $(document).on('click','#getEdit',function(e) {
        e.preventDefault();
        // openSideDiv($(this).data('product_type'), $(this).data('id'))
    });
    $(document).on('click','#getDelete',function(e) {
        e.preventDefault();
        var product_type = $(this).data('product_type')
        if(confirm("Вы уверены?")){
            $.ajax({
                url: 'php/product_actions.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    key: 6,
                    id: $(this).data('id'),
                    product_type: $(this).data('product_type')
                },
            }).done(function (data) {
                if(product_type == "sensor"){
                    sensorsAmount--
                    redrawDataTable()
                } else if (product_type == "device"){
                    devicesAmount--
                    redrawDataTable()
                }
            }).fail(function () {
                alert("Ошибка отправки данных")
            });
        }
    });
})

function sub_info(key) {
    document.location.replace("sub_info.php?key="+key);
}
function open_page(page) {
    document.location.replace(page);
}

function openSideDiv(product_type, id){
    $('.side-div-content').html('');
    $('.side-div').addClass('active');
    $('.login').removeClass('active');
    $('.menu').removeClass('active');
    $('.menu-btn').removeClass('active');
    //document.location.search = (id)
    if(id == undefined){
        document.location.hash = (product_type)
    }
    else {
        document.location.hash = (product_type + "-" + id)
    }
    $('.side-div-content').html();
    if(product_type == "registration"){
        $.ajax({
            url: 'html/registration.php',
            type: 'POST',
            dataType: 'html'
        }).done(function (data) {
            $('.side-div').css("transition", "0.5s")
            $('.side-div-content').html(data)
        }).fail(function () {
            alert("Ошибка отправки данных")
        });
    }
    else if(product_type == "options"){
        $.ajax({
            url: 'html/options.php',
            type: 'POST',
            dataType: 'html'
        }).done(function (data) {
            $('.side-div').css("transition", "0.5s")
            $('.side-div-content').html(data)
            peopleDataTable()
        }).fail(function () {
            alert("Ошибка отправки данных")
        });
    }
    else if(product_type == "sub_data"){
        $.ajax({
            url: 'html/sub_data.php',
            data: {
                key: (id)
            },
            type: 'POST',
            dataType: 'html'
        }).done(function (data) {
            $('.side-div').css("transition", "0.5s")
            $('.side-div-content').html(data)
            peopleDataTable()
            $('.sub_data select').select2({ // Применяем плагин select2 ко всем select
                tags: true, // Нужно, чтобы добавлять на лету новые значения
            });
        }).fail(function () {
            alert("Ошибка отправки данных")
        });
    }
    else {
        if (!isFinite(id) || !(product_type == "sensor" || product_type == "device")){
            $('.side-div').css("transition", "0.5s")
            $('.side-div-content').html("Неправильная ссылка")
            return;
        }
        //var product_type = (id > 0) ? "sensor" : "device";
        //var product_type = (id > 0) ? "sensor" : "device";
        //document.location.hash = (product_type + "-" + Math.abs(id))
        $.ajax({
            url: 'html/product.php',
            type: 'POST',
            dataType: 'html',
            data: {
                id: (id),
                product_type: (product_type),
            }
        }).done(function (data) {
            $('.side-div').css("transition", "0.5s")
            $('.side-div-content').html(data)
            literatureDataTable(product_type, id)
            applicationSphereDataTable(product_type, id)
            environmentDataTable(product_type, id)
            $('div.tabs select').select2({ // Применяем плагин select2 ко всем select
                tags: true, // Нужно, чтобы добавлять на лету новые значения
            });
            $('#sensors_in_devices').select2({ // Применяем плагин select2 ко всем select
                tags: false, // Нужно, чтобы добавлять на лету новые значения
            });
        }).fail(function () {
            alert("Ошибка отправки данных")
        });
    }
}
function sendAjax(url, ajax_form, key){
    $.ajax({
        url: "php/"+url,
        type: 'POST',
        dataType: 'json',
        data: "key=" + key + "&" + $("#"+ajax_form).serialize(),
    }).done(function (data) {
        if(data.error == "undefined"){
            notification(data.error)
            return;
        }
        else{
            //document.location.reload()
        }
    }).fail(function () {
        alert("Ошибка отправки данных")
    });
}
function upload_image(switchKey, input) {
    let file = input.files[0];
    let reader = new FileReader();
    reader.onload = function() {
        switch (switchKey){
            case 1:
                $("#dynamic_frequency_response").attr("src", reader.result);
                break;
            case 2:
                $("#picture").attr("src", reader.result);
                break;
            case 3:
                $("#blueprint").attr("src", reader.result);
                break;
            case 4:
                $("#scheme").attr("src", reader.result);
                break;
            default:
                break;
        }
    };
    reader.readAsDataURL(file);
    reader.onerror = function() {
        //console.log(reader.error);
    };
    ////var file_data = $('#dynamic_frequency_response').prop('files')[0];
    ////var file_data = $('#scheme-inp').prop('files')[0];
    //var form_data = new FormData();
    //form_data.append('key', switchKey);
    //form_data.append('id', $('#id').val());
    //form_data.append('type_of_product', $('#type_of_product').val());
    //form_data.append('file', file);
    //$.ajax({
    //    url:'php/uploadImages.php',
    //    type:'POST',
    //    cache: false,
    //    data: form_data,
    //    dataType:'json',
    //    processData: false, // Не обрабатываем файлы (Don't process the files)
    //    contentType: false, // Так jQuery скажет серверу что это строковой запрос
    //}).done(function(data) {
    //    notification("Изображение добавлено")
    //}).fail(function(data){
    //    alert("Ошибка отправки данных")
    //    console.log(data)
    //});
}
function notification(message){ // Окно с оповещением, дабы не вызывать alert, наверняка можно сделать получше
    $('#notification-label').text(message)
    $('#notification').slideDown()
    setTimeout(function(){
        $('#notification').slideUp()
    },2500)
}
// function open_options(){ // Небольшой костыль, стоило бы исправить, но это не критично
//     openSideDiv("options")
// }
