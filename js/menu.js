$(document).ready(function() {
    $('.menu-btn').on('click', function (e) {
        e.preventDefault();
        $('.menu').toggleClass('active');
        $('.menu-btn').toggleClass('active');
        $('.side-div').removeClass('active');
        history.pushState("",document.title, window.location.origin)
    })

    $('.side-div-btn').on('click', function (e) {
        document.location.hash = ""
        history.pushState("",document.title, window.location.origin)
        $('.side-div').removeClass('active');
        $('.side-div-content').html(""); // На всякий случай удаляем все, что есть в side-div
    })
})