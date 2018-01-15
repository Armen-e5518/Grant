$(document).ready(function () {
    $(document).on('click', '.favorite-project', function (e) {
        var ob = $(this);
        var data = {};
        data.id = ob.attr('data-id');
        $.ajax({
            type: "POST",
            url: "/ajax/add-or-delete-favorite",
            data: data,
            success: function (res) {
                if (res) {
                    if (res == 'save') {
                        ob.removeClass('fa-star-o');
                        ob.addClass('fa-star');
                    }
                    if (res == 'delete') {
                        ob.removeClass('fa-star');
                        ob.addClass('fa-star-o');
                    }
                }
            }
        });
        e.stopPropagation();
    })

});