$(document).ready(function () {

    $('#filtering-icon').click(function (e) {
        $('#popup-filtering').addClass('active-popup');
        e.stopPropagation();
    });

    $('#popup-filtering').click(function (e) {
        $(this).removeClass('active-popup')
        e.stopPropagation();
    });
    
    $('#popup-filtering .filtering-popup').click(function (e) {
        e.stopPropagation();
    })
});