var Users;
var Users_teg = [];

$(document).ready(function () {


    $.ajax({
        type: "POST",
        url: "/ajax/get-all-users",
        success: function (res) {
            if (res) {
                Users = res;

            }
        }
    });

    $('#id_project_title').focusout(function () {
        var data = {};
        data.text = $(this).val();
        data.project_id = $('#id_project').attr('data-id');
        $.ajax({
            type: "POST",
            url: "/ajax/save-project-title",
            data: data,
            success: function (res) {
                if (res) {

                }
            }
        });
    });

    $('#id_edit_project_des').click(function () {
        $('#id_project_des_text').show();
        $('#id_project_des').hide();
        $('#id_project_des_text').val($('#id_project_des').html())

    })

    $('#id_project_des_text').focusout(function () {
        var data = {};
        data.text = $('#id_project_des_text').val();
        data.project_id = $('#id_project').attr('data-id');
        $.ajax({
            type: "POST",
            url: "/ajax/save-project-description",
            data: data,
            success: function (res) {
                if (res) {
                    $('#id_project_des_text').hide();
                    $('#id_project_des').show();
                    $('#id_project_des').html(data.text)
                }
            }
        });
    })

    $('#id_sent_comment').click(function () {
        var data = {};
        data.text = ChangeCommentTextByTag(Users, $('#id_comment').val());
        data.project_id = $('#id_project').attr('data-id');
        $.ajax({
            type: "POST",
            url: "/ajax/save-project-comment",
            data: data,
            success: function (res) {
                if (res) {
                    console.log(Users_teg)
                    $('#id_comment').val('')
                    var val = res.model;
                    $('#id_commnets_data').prepend(
                        '<div class="txt-with-icon">' +
                        '<i class="person-icon font-w-700" data-foo="' + res.user_cut + '" title="' + res.user_name + '"></i>' +
                        '<div class="person-repost">' +
                        '<a href="#" class="d-block no-underline font-w-700">' + res.user_name + '</a>' +
                        '<span class="brd-rad-4 white-bg" >' +
                        ChangeCommentTextByTagHtml(val.comment) +
                        '</span>' +
                        '<a href="#" title="' + val.date + '" class="font-13 no-underline"><time class="timeago" datetime="' + val.date + '"></time></a>' +
                        '</div>' +
                        '</div>'
                    )
                    $("time.timeago").timeago();
                }
            }
        });
    });

    var tag_flag = false;
    $('#id_comment').keyup(function (e) {
        // console.log(e);
        if (e.keyCode == 32) {
            tag_flag = false;
            $('#id_users_tag').hide();
        }
        if (tag_flag) {
            var arr = $(this).val().split('@');
            var tag_string = arr[arr.length - 1]
            GetUsersByString(Users, tag_string)
        }
        if ($(this).val().slice(-1) == '@') {
            SetUsers(Users);
            tag_flag = true;
            $('#id_users_tag').show();
        }

    })


    $(document).on('mousedown', '#id_users_list li', function (e) {
        var text = $('#id_comment').val();
        var arr = text.split('@');
        var username = $(this).attr('data-user-name')
        var new_text = '';
        arr.forEach(function (val, index) {
            if (arr.length - 1 == index) {
                new_text += '@' + username + ' ';
            } else if (index == 0) {
                new_text += val;
            } else {
                new_text += '@' + val;
            }
        })
        $('#id_comment').val(new_text);
        tag_flag = false;
        $('#id_users_tag').hide();
        e.stopPropagation();
    })


});


function SetUsers(Users) {
    $('#id_users_list').html('');
    Users.forEach(function (val, i) {
        var class_a = i == 0 ? 'active-u' : '';
        $('#id_users_list').append('<li class="' + class_a + '" data-id = "' + val.id + '" data-user-name = "' + val.username + '">' + val.firstname + ' ' + val.lastname + '</li>')
    })
}

function GetUsersByString(Users, string) {
    var New_list = [];
    Users.forEach(function (val, i) {
        if ((val.username.indexOf(string) > -1 || val.firstname.indexOf(string) > -1 || val.lastname.indexOf(string) > -1)) {
            New_list.push(val)
        }
    });
    SetUsers(New_list);
}

function ChangeCommentTextByTag(Users, string) {
    Users_teg = [];
    // return string.replace(new RegExp("@([a-zA-Z0-9_-]*)", "g"), '[~$1]');
    return string.replace(new RegExp("@[a-zA-Z0-9_-]*", "g"), function (val, i) {
        var username = val.substr(1);
        if (CheckUserExists(Users, username)) {
            Users_teg.push(username);
            return '[~' + username + ']';
        } else {
            return '@' + username;
        }
    });
}

// ChangeCommentTextByTagHtml('sad as d [~gago] sadfsaf asdsa [~grantuser]')
function ChangeCommentTextByTagHtml(string) {
    return string.replace(/\[~([^\]]+)\]/g, function (val) {
        var username = val.slice(2, -1);
        return '<strong title="' + GetUserNameDataByUsername(Users, username) + '"  class="font-w-700">@' + username + '</strong>';
    });
}

function CheckUserExists(Users, username) {
    var f = false;
    Users.forEach(function (val) {
        if (val.username == username) {
            f = true;
        }
    });
    return f;
}

function GetUserNameDataByUsername(Users, username) {
    var a = false;
    Users.forEach(function (val) {
        if (val.username == username) {
            a = val;
        }
    });
    if (a) {
        return a.firstname + ' ' + a.lastname;
    } else {
        return '';
    }
}

