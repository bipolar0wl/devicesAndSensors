function select_status(user_id, status_old, this_select){
    if(status_old != $(this_select).val()){
        $.ajax({
            url:'php/options_actions.php',
            type:'POST',
            data:{
                key: 1,
                user_id: user_id,
                status: $(this_select).val(),
            },
            dataType:'json'
        }).done(function(data) {
            notification("Статус изменен")
            if ($(this_select).val() == 5){
                $(this_select).prop("disabled", "true")
                $(this_select).css("color", "var(--theme-color)")
                //$(this_select).css("color", "#0089d0")
            }
        }).fail(function(data){
            alert("Ошибка отправки данных")
        });
    }
}
function edit_user(user_id){
    if ($("#edit_password_check").prop("checked")){
        if ($('#edit_password_one').val() != $('#edit_password_two').val()){
            notification("Пароли не совпадают")
            return;
        }
    }
    $.ajax({
        url:'php/options_actions.php',
        type:'POST',
        data:{
            key: 2,
            user_id: $('#edit_user_id').val(),
            login: $('#edit_login').val(),
            surname: $('#edit_surname').val(),
            name: $('#edit_name').val(),
            patronymic: $('#edit_patronymic').val(),
            email: $('#edit_email').val(),
            password_check: $('#edit_password_check').prop("checked"),
            password_one: $('#edit_password_one').val(),
            password_two: $('#edit_password_two').val()
        },
        dataType:'json'
    }).done(function(data) {
        if(!!data.error){
            notification(data.error)
            return;
        }
        else{
            $('.peopleDataTable').DataTable().ajax.reload(function(){})
            $(".edit_user_form").hide("fast")
            old_user_id = 0
            notification("Информация изменена")
        }
    }).fail(function(data){
        alert("Ошибка отправки данных")
    });
}
function edit_password(checkbox){
    if ($(checkbox).prop("checked")){
        $(".edit_password_div").show("fast")
    }
    else{
        $(".edit_password_div").hide("fast")
    }
}
let old_user_id = 0
function show_hide_user(user_id){
    $(".edit_user_form").hide("fast")
    if (user_id != old_user_id) {
        $.ajax({
            url:'php/options_actions.php',
            type:'POST',
            data:{
                key: 3,
                user_id: user_id
            },
            dataType:'json'
        }).done(function(data){
            $('#edit_login').val(data.login)
            $('#edit_surname').val(data.surname)
            $('#edit_name').val(data.name)
            $('#edit_patronymic').val(data.patronymic)
            $('#edit_email').val(data.email)
        }).fail(function(data){
            alert("Ошибка отправки данных")
        });
        $(".edit_user_form").show("fast")
        $('#edit_user_id').val(user_id)
        old_user_id = user_id
    }else{
        old_user_id = 0
    }
    //$('#edit_user_id').val(user_id)
    //old_user_id = user_id
}
function del_user(user_id){
    if(confirm("Вы уверенны?")){
        $.ajax({
            url:'php/options_actions.php',
            type:'POST',
            data:{
                key: 4,
                user_id: user_id
            },
            dataType:'json'
        }).done(function(data){
            $('.peopleDataTable').DataTable().ajax.reload(function(){})
        }).fail(function(data){
            alert("Ошибка отправки данных")
        });
    }
}