var IsNotifications = false;

$(document).ready(function () {

    Notifications();

    setInterval(function () {
        Notifications();
    }, 5000);

    $(document).on('click', '#notification', function (e) {
        if (IsNotifications) {
            $('.notifications').show();
        }
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
var Sock_Interval = setInterval(function () {
    if (socket_flag == 'noo') {
        socket.onmessage = function (event) {
            var mess = JSON.parse(event.data);
            if (mess.type == 'notification') {
                UpdateNotificationNumber();
                var val = mess.date;
                if (val.type == '0') {
                    $('#notifications_list').append(
                        '<li class="active-not">' +
                        '<a data-not-id = "' + val.id + '" title="' + val.date + '" data-id="' + val.project_id + '"><span class="fa fa-tags" aria-hidden="true"></span> You were tagged in the comment</a>' +
                        '</li>'
                    )
                } else {
                    $('#notifications_list').append(
                        '<li class="active-not">' +
                        '<a data-not-id = "' + val.id + '" title="' + val.date + '" data-id="' + val.project_id + '"><span class="fa fa-user-o" aria-hidden="true"></span> You have a new project</a>' +
                        '</li>'
                    )
                }
            }
        };
    }
    clearInterval(Sock_Interval);
}, 1000)


function Notifications() {
    $.ajax({
        type: "POST",
        url: "/ajax/get-current-user-notifications",
        success: function (res) {

            if (res) {
                SetNotificationNumber(res);
                SetNotificationsHtml(res);
            }
            if (res.length > 0) {
                IsNotifications = true;
            } else {
                IsNotifications = false;
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

function UpdateNotificationNumber() {
    var count = $('#notification em').html();
    $('#notification em').html(count * 1 + 1);
}

function SetNotificationsHtml(res) {
    $('#notifications_list').html('');
    res.forEach(function (val) {
        var status = val.status == 0 ? "active-not" : '';
        if (val.type == '0') {
            $('#notifications_list').append(
                '<li class="' + status + '">' +
                '<a data-not-id = "' + val.id + '" title="' + val.date + '" data-id="' + val.project_id + '"><span class="fa fa-tags" aria-hidden="true"></span> You were tagged in the comment</a>' +
                '</li>'
            )
        } else {
            $('#notifications_list').append(
                '<li class="' + status + '">' +
                '<a data-not-id = "' + val.id + '" title="' + val.date + '" data-id="' + val.project_id + '"><span class="fa fa-user" aria-hidden="true"></span> You have a new project</a>' +
                '</li>'
            )
        }
    })
}

