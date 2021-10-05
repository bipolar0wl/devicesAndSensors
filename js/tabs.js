// $(document).ready(function() {
//     $('.js-tab-trigger').click(function(){
//         var tab_id = $(this).attr('data-tab'),
//             tab_content = $('.js-tab-content[data-tab="'+tab_id +'"]');
//
//         $('.js-tab-trigger.active').removeClass('active');
//         $(this).addClass('active');
//
//         $('.js-tab-content.active').removeClass('active');
//         tab_content.addClass('active');
//     });
// })
function tab_change() {
    $('.js-tab-trigger').click(function(){
        var tab_id = $(this).attr('data-tab'),
            tab_content = $('.js-tab-content[data-tab="'+tab_id +'"]');
        $('.js-tab-trigger.active').removeClass('active');
        $(this).addClass('active');

        $('.js-tab-content.active').removeClass('active');
        tab_content.addClass('active');
    });
}