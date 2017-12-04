$(document).ready(function () {


    $('#user-profile').click(function (e) {
        $('.user-down').toggleClass('d-none')
        e.stopPropagation();
    })
    $('body').click(function () {
        $('.user-down').addClass('d-none')
    })
});