//$(window).on('load', function(){
//    //$('.preloader').fadeOut().end().delay(400).fadeOut('slow');
//    $('.preloader').slideUp(0)
//})
//$(document).ready(function() {
//    startRef = document.location.hash.slice(1);
//    subRef = startRef.split("-");
//    switch (subRef[0]){
//        case (""):
//            history.pushState("", document.title, window.location.origin)
//            break;
//        default:
//            $('.side-div').css("transition", "0s")
//            openSideDiv(subRef[0], subRef[1])
//            break;
//    }
//})
//// Добавление или обновление URL адреса Не задействовано
//function addOrUpdateUrlParam(name, value){
//    var href = document.location.href;
//    var regex = new RegExp("[]&\?" + name + "=");
//    if (regex.test(href)) {
//        regex = new RegExp("([]&\?)" + name + "=\d+");
//        window.location.href = href.replace(regex, "" + name + "=" + value);
//    }
//    else {
//        if (href.indexOf("?") > -1) {
//            window.location.href = href + "&" + name + "=" + value;
//        }
//        else {
//            window.location.href = href + "?" + name + "=" + value;
//        }
//    }
//}