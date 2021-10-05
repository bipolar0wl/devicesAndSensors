"use strict"
var DayNight =+ $.cookie('DayNight');

$(window).on('load', function(){ // Здесь это не работает, подключается в самом файле php
    $('#dayNight').bootstrapToggle({
        on: '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-brightness-high-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">' +
            '<path d="M12 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0z"/>' +
            '<path fill-rule="evenodd" d="M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>' +
            '</svg>',
        off: '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-moon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">' +
            '<path fill-rule="evenodd" d="M14.53 10.53a7 7 0 0 1-9.058-9.058A7.003 7.003 0 0 0 8 15a7.002 7.002 0 0 0 6.53-4.47z"/>' +
            '</svg>',
    })
})

//var themeurl = {}
//var themes = {
//    "default": "libs/bootstrap-4.5.0-dist/css/bootstrap.min.css",
//    "amelia" : "//bootswatch.com/amelia/bootstrap.min.css",
//    "cerulean" : "libs/bootstrap_themes/bootstrap_cerulean.css",
//    "cosmo" : "//bootswatch.com/cosmo/bootstrap.min.css",
//    "cyborg" : "//bootswatch.com/cyborg/bootstrap.min.css",
//    "darkly" : "libs/bootstrap_themes/bootstrap_darkly.css",
//    "flatly" : "//bootswatch.com/flatly/bootstrap.min.css",
//    "journal" : "//bootswatch.com/journal/bootstrap.min.css",
//    "readable" : "//bootswatch.com/readable/bootstrap.min.css",
//    "simplex" : "//bootswatch.com/simplex/bootstrap.min.css",
//    "slate" : "//bootswatch.com/slate/bootstrap.min.css",
//    "spacelab" : "//bootswatch.com/spacelab/bootstrap.min.css",
//    "united" : "//bootswatch.com/united/bootstrap.min.css",
//    "custom_dark" : "css/custom_dark.css",
//    "custom_light" : "css/custom_light.css"
//}
//var themesheet = $('<link href="'+themes['default']+'" rel="stylesheet" />');

$(document).ready(function() {
    // Загрузка параметров из куки или по умолчанию
    switch (DayNight) {
        case 0:
            $('.navbar').addClass('bg-dark');
            $('.navbar').removeClass('navbar-light');
            $('.navbar').addClass('navbar-dark');
            $('div, label').addClass('text-light');
            //$('.text-light').addClass('text-dark')
            $("#dayNight").bootstrapToggle('off')
            //$('#dayNight').removeAttr('checked')
            $('head').append('<link rel="stylesheet" type="text/css" href="css/variables_night.css">');
            //$('.odd').css('background-color','#373737')
            //$('.even').css('background-color','#3b3b3c')
            break;
        case 1:
            $('.navbar').removeClass('bg-dark');
            $('.navbar').addClass('navbar-light');
            $('.navbar').removeClass('navbar-dark');
            $('div, label').removeClass('text-light');
            //$('.text-dark').addClass('text-light')
            $("#dayNight").bootstrapToggle("on")
            //$('#dayNight').attr('checked', 'checked')
            $('head').append('<link rel="stylesheet" type="text/css" href="css/variables.css">');
            break;
        default:
            DayNight = 1;
            break;
    }
    // Изменение параметров
    //$('#dayNight').on('click', function (e) {
    $('#dayNight').change(function (e) {
        switch (DayNight) {
            case 0:
                $('.navbar').removeClass('bg-dark');
                $('.navbar').addClass('navbar-light');
                $('.navbar').removeClass('navbar-dark');
                $('div, label').removeClass('text-light');
                $('head').append('<link rel="stylesheet" type="text/css" href="css/variables.css">');
                DayNight = 1;
                $.cookie('DayNight', 1, { expires: 3600});
                break;
            case 1:
                $('.navbar').addClass('bg-dark');
                $('.navbar').removeClass('navbar-light');
                $('.navbar').addClass('navbar-dark');
                $('div, label').addClass('text-light');
                $('head').append('<link rel="stylesheet" type="text/css" href="css/variables_night.css">');
                DayNight = 0;
                $.cookie('DayNight', 0, { expires: 3600});
                break;
        }
        $.cookie('DayNight', DayNight, { expires: 3600});
    })
})

//$(document).ready(function() {
//    switch (DayNight) {
//        case 0:
//            $('.navbar').addClass('bg-dark');
//            $('.navbar').removeClass('navbar-light');
//            $('.navbar').addClass('navbar-dark');
//            $('div, label').addClass('text-light');
//            $("#dayNight").bootstrapToggle('off')
//            themesheet.appendTo('head');
//            themeurl = themes["custom_dark"];
//            themesheet.attr('href',themeurl);
//            break;
//        case 1:
//            $('.navbar').removeClass('bg-dark');
//            $('.navbar').addClass('navbar-light');
//            $('.navbar').removeClass('navbar-dark');
//            $('div, label').removeClass('text-light');
//            $("#dayNight").bootstrapToggle("on")
//            themesheet.appendTo('head');
//            themeurl = themes["custom_light"];
//            themesheet.attr('href',themeurl);
//            break;
//        default:
//            DayNight = 1;
//            break;
//    }
//    $('#dayNight').change(function(){
//        switch (DayNight) {
//            case 0:
//                $('.navbar').removeClass('bg-dark');
//                $('.navbar').addClass('navbar-light');
//                $('.navbar').removeClass('navbar-dark');
//                $('div, label').removeClass('text-light');
//                themesheet.appendTo('head');
//                themeurl = themes["custom_light"];
//                themesheet.attr('href',themeurl);
//                DayNight = 1;
//                $.cookie('DayNight', 1, { expires: 3600});
//                break;
//            case 1:
//                $('.navbar').addClass('bg-dark');
//                $('.navbar').removeClass('navbar-light');
//                $('.navbar').addClass('navbar-dark');
//                $('div, label').addClass('text-light');
//                themesheet.appendTo('head');
//                themeurl = themes["custom_dark"];
//                themesheet.attr('href',themeurl);
//                DayNight = 0;
//                $.cookie('DayNight', 0, { expires: 3600});
//                break;
//        }
//    })
//    $.cookie('DayNight', DayNight, { expires: 3600});
//})