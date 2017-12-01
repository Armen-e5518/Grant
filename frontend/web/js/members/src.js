$(document).ready(function () {

    $(document).on('click', '.add-members .select2-selection', function () {
        $('.select2-results__options li').each(function () {
            var ob = $(this);
            var res = ob.attr('id').split("-");
            var id = res[res.length - 1];
            var data = {};
            data.id = id;
            $.ajax({
                type: "POST",
                url: "/ajax/get-user-image",
                data: data,
                success: function (res) {
                    if (res) {
                        var name = ob.html();
                        if (res.image_url) {
                            var img = '<img width="15px" src="/uploads/' + res.image_url + '">'
                        } else {
                            var img = '<img width="15px" src="/images/no-user.png">'
                        }
                        ob.html(img + ' ' + name)
                    }
                }
            });
        })
    })
});