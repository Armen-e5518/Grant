$(document).ready(function () {

    $('#popup-project .filtering-popup, #projects a ').click(function (e) {
        // console.log('stopPropagation')
        e.stopPropagation();
    })

    // $('#projects .project').click(function (e) {
    //     $('#popup-project').addClass('active-popup')
    //     e.stopPropagation();
    // });

    $('#popup-project,i.popup-close').click(function (e) {
        $('#id_project').hide();
        $('#id_loader').show();
        location.reload();
        e.stopPropagation();
    })


});

function DataUpdateIndex() {
    
}