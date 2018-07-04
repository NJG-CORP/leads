$(document).ready(function () {
    $(".hidden-field").each(function () {
        let code = $(this).html();
        $(this).
        html('**********').
        css('display', $(this).data('display-type') ? $(this).data('display-type') : 'block').
        data('code',code).
        data('hidden',true);
    });
});

$(".hidden-field").on('click',function () {
    if($(this).data('hidden')) {
        $(this).html($(this).data('code')).data('hidden',false);
    } else {
        $(this).html('**********').data('hidden',true);
    }
});
