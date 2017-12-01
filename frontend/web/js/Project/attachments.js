
$(document).ready(function () {
    $('.delete-attachment').click(function () {
        var ob = $(this);
        var data = {};
        data.id = ob.attr('data-id');
        $.ajax({
            type: "POST",
            url: "/ajax/delete-attachment-by-id",
            data: data,
            success: function (res) {
                if (res == true) {
                    ob.closest('.attachment').hide();
                }
            }
        });
    })

});