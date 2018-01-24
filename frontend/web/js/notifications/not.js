$(document).ready(function () {

    Notifications();

    setInterval(function () {
        Notifications();
    }, 5000);

    $(document).on('click', '#notification', function (e) {
        $('.notifications').show();
    });

    $(document).on('click', '.notifications a', function (e) {
        var data = {};
        data.id = $(this).attr('data-not-id');
        $.ajax({
            type: "POST",
            url: "/ajax/read-notification",
            data: data,
            success: function (res) {
                if (res) {
                    Notifications();
                }
            }
        });
    });

    $('body').click(function () {
        $('.notifications').hide();
    })
});

function Notifications() {
    $.ajax({
        type: "POST",
        url: "/ajax/get-current-user-notifications",
        success: function (res) {
            if (res) {
                SetNotificationNumber(res);
                SetNotificationsHtml(res);
            }
        }
    });
}

function SetNotificationNumber(res) {
    var count = 0;
    res.forEach(function (val) {
        if (val.status == 0) {
            count++;
        }
    });
    if (count > 0) {
        $('#notification em').show().html(count)
    } else {
        $('#notification em').hide();
    }
}

function SetNotificationsHtml(res) {
    $('#notifications_list').html('');
    res.forEach(function (val) {
        var status = val.status == 0 ? "active-not" : '';
        if (val.type == '0') {
            $('#notifications_list').append(
                '<li class="' + status + '">' +
                '<a data-not-id = "' + val.id + '" title="' + val.date + '" data-id="' + val.project_id + '">You were tagged in the comment</a>' +
                '</li>'
            )
        } else {
            $('#notifications_list').append(
                '<li class="' + status + '">' +
                '<a data-not-id = "' + val.id + '" title="' + val.date + '" data-id="' + val.project_id + '">You have a new project</a>' +
                '</li>'
            )
        }
    })
}