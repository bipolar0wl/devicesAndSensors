"use strict"
var login = $.cookie('login');
var password = $.cookie('password');
// Прелоадер

$(window).on('load', function(){
    $.ajax({
        url: "php/authorization.php",
        type: 'POST',
        dataType: 'json',
        data: {
            key: 3,
            login: login,
            password: password
        },
        async: false
    }).done(function (data) {
        $.cookie('login', login, { expires: 3600});
        $.cookie('password', password, { expires: 3600});
        $('#div-navbar').load("/navbar.php");
    }).fail(function () {
        alert("Ошибка отправки данных");
    });
})

$(document).ready(function() {
    // Переключение отображения логина
    // $('.authorization').on('click', function () {
    //     $('.login').toggleClass('active')
    // })
})
function authorization() {
    if ($('#auth_login').val() == ""){
        notification("Введите логин");
        return;
    }
    if ($('#auth_password').val() == ""){
        notification("Введите пароль")
        return;
    }
    $.ajax({
        url: "php/authorization.php",
        type: 'POST',
        dataType: 'json',
        //data: "key=" + 1 + "&" + $("#login-content").serialize(),
        data: {
            key: 1,
            login: $('#auth_login').val(),
            password: $('#auth_password').val()
        },
    }).done(function (data) {
        if(!!data.error){
            notification(data.error)
            return;
        }
        else{
            //$('.login-content').html(data.html)
            $.cookie('login', $('#auth_login').val(), { expires: 3600});
            $.cookie('password', $('#auth_password').val(), { expires: 3600});
            window.location.reload()
        }
    }).fail(function () {
        alert("Ошибка отправки данных")
    });
}
function registration(){
    //if ($('#regPasswordRepeat').val() != $('#regPassword').val()){
    //    notification("Пароли не совпадают")
    //    return;
    //}
    $.ajax({
        url:'php/authorization.php',
        type:'POST',
        //data: "key=" + 2 + "&" + $("#registration").serialize(),
        data:{
            key: 2,
            regLogin: $('#regLogin').val(),
            regPassword: $('#regPassword').val(),
            regPasswordRepeat: $('#regPasswordRepeat').val(),
            regSurname: $('#regSurname').val(),
            regName: $('#regName').val(),
            regPatronymic: $('#regPatronymic').val(),
            regEmail: $('#regEmail').val()
        },
        dataType:'json'
    }).done(function(data){
        if(!!data.error){
            notification(data.error)
            return;
        }
        else{
            notification("Пользователь зарегистирован")
            window.location.replace(window.location.origin)
            //history.pushState("", document.title, window.location.origin)
            //$('.side-div').removeClass('active');
            //$('.login-content').html(data.html)
        }
    }).fail(function(data){
        alert("Ошибка отправки данных")
    });
}
function sign_out(){
    $.ajax({
        url:'php/authorization.php',
        type:'POST',
        data:{
            key: 4,
        },
        dataType:'json'
    }).done(function(data) {
        $.removeCookie("login");
        $.removeCookie("password");
        document.location.reload()
    }).fail(function(data){
        alert("Ошибка отправки данных")
    });
}
// Добавление или обновление URL адреса Не задействовано
function addOrUpdateUrlParam(name, value){
    var href = document.location.href;
    var regex = new RegExp("[]&\?" + name + "=");
    if (regex.test(href)) {
        regex = new RegExp("([]&\?)" + name + "=\d+");
        window.location.href = href.replace(regex, "" + name + "=" + value);
    }
    else {
        if (href.indexOf("?") > -1) {
            window.location.href = href + "&" + name + "=" + value;
        }
        else {
            window.location.href = href + "?" + name + "=" + value;
        }
    }
}