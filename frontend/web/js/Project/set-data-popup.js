var f_params = false;
var d_params;

$(document).ready(function () {

    $("#id_checklist_deadline").datepicker();

    setInterval(function () {
        $("time.timeago").timeago();
    }, 60 * 1000);

    setTimeout(function () {
        $('#popup-project').removeClass('active-popup');
        // $('#id_loader').hide();
        // $('#id_project').show();
    }, 500)


    $('#projects .project').click(function () {
        var hush = $(this).attr('data-id');
        if (history.pushState) {
            history.pushState(null, null, '#' + hush);
        }


        $('#popup-project').addClass('active-popup');
        var f_project_data = false;
        var d_project_data;
        var f_members_data = false;
        var d_members_data;
        var f_attachments = false;
        var d_attachments;
        var f_countries = false;
        var d_countries;

        $.ajax({
            type: "POST",
            url: "/ajax/get-params",
            data: null,
            success: function (params) {
                f_params = true;
                if (params) {
                    d_params = params;
                }
            }
        });

        var Inter = setInterval(function () {
            if (f_params && f_members_data && f_project_data && f_attachments && f_countries) {
                $('#id_project').show();
                $('#id_loader').hide();
                SetProjectDataInHtml(d_params, d_project_data, d_members_data, d_attachments, d_countries);
                clearInterval(Inter)
            }
        }, 800);


        var ob = $(this);
        var data = {};
        data.id = ob.attr('data-id');

        GetChecklistsByProjectId(data.id);
        GetProjectMembersListByProjectId(data.id);
        setInterval(function () {
            GetComments(data)
        }, 5000)
        console.log(data.id);
        $.ajax({
            type: "POST",
            url: "/ajax/get-project-data-by-id",
            data: data,
            success: function (project_data) {
                f_project_data = true;
                if (project_data) {
                    d_project_data = project_data;
                }
            }
        });

        $.ajax({
            type: "POST",
            url: "/ajax/get-members-data-by-project-id",
            data: data,
            success: function (members_data) {
                f_members_data = true;
                if (members_data) {
                    d_members_data = members_data;
                }
            }
        });

        $.ajax({
            type: "POST",
            url: "/ajax/get-attachments-by-project-id",
            data: data,
            success: function (attachments) {
                f_attachments = true;
                if (attachments) {
                    d_attachments = attachments
                }
            }
        });

        $.ajax({
            type: "POST",
            url: "/ajax/get-countries-by-project-id",
            data: data,
            success: function (countries) {
                f_countries = true;
                if (countries) {
                    d_countries = countries
                }
            }
        });

        $.ajax({
            type: "POST",
            url: "/ajax/get-comments-by-project-id",
            data: data,
            success: function (comments) {
                if (comments) {
                    $('#id_commnets_data').html('');
                    if (comments) {
                        comments.forEach(function (val, i) {
                            $('#id_commnets_data').append(
                                '<div class="txt-with-icon">' +
                                '<i class="person-icon font-w-700" data-foo="' + val.user_cut + '" title="' + val.user_name + '"></i>' +
                                '<div class="person-repost">' +
                                '<a href="#" class="d-block no-underline font-w-700">' + val.user_name + '</a>' +
                                '<span class="brd-rad-4 white-bg">' +
                                ChangeCommentTextByTagHtml(val.comment) +
                                '</span>' +
                                '<a href="#" title="' + val.date + '" class="font-13 no-underline"><time class="timeago" datetime="' + val.date + '"></time></a>' +
                                '</div>' +
                                '</div>'
                            )
                        });
                        $("time.timeago").timeago();
                    }
                }
            }
        });
    });

    $('#id_project_members').on('click', '.remove-member', function () {
        if (confirm("Do you really want to delete!") == true) {
            var ob = $(this);
            var data = {};
            data.user_id = ob.attr('data-id');
            data.project_id = $('#id_project').attr('data-id');
            $.ajax({
                type: "POST",
                url: "/ajax/delete-project-member",
                data: data,
                success: function (res) {
                    if (res) {
                        ob.closest('.project-member').remove();
                        GetProjectMembersListByProjectId(data.project_id);
                    }
                }
            });
        }
    })
});

function GetProjectMembersListByProjectId(id) {
    var data = {};
    data.id = id;
    $.ajax({
        type: "POST",
        url: "/ajax/get-members-not-project",
        data: data,
        success: function (members) {
            if (members) {
                $('#id_members').html('<option value="0">Select a members</option>');
                members.forEach(function (val) {
                    $('#id_members').append(
                        '<option data-img = "' + val.image_url + '"  value="' + val.id + '">' + val.firstname + ' ' + val.lastname + '</option>'
                    )
                })
            }
        }
    });
}

function SetProjectDataInHtml(d_params, d_project_data, d_members_data, d_attachments, d_countries) {

    var Status = GetStatusTile(d_project_data.status);
    $('#id_project').attr('data-id', d_project_data.id);
    $('#id_project_title').html(d_project_data.ifi_name);
    $('#id_project_des').html(d_project_data.project_dec);
    $('#id_project_deadline').html(d_project_data.deadline);
    $('#id_project_created').html(d_project_data.request_issued);
    $('#id_project_members').html('');
    $('#id_status_title').html(Status.title).removeClass('in-progress pending').addClass(Status.class);

    if (d_project_data.status == 0) {
        $('#id_approve').show();
        $('#id_reject').show();
    }
    if (d_project_data.status == 1) {
        ApproveStatus();
    }
    if (d_project_data.status == 2) {
        SubmitStatus();
    }
    if (d_project_data.status == 3 || d_project_data.status == 4 || d_project_data.status == 5) {
        HideButtons();
    }
    d_members_data.forEach(function (val, index) {
        var img = val.image_url ? d_params.user_url + val.image_url : '/images/no-user.png';
        $('#id_project_members').append(
            '<div title="' + val.firstname + ' ' + val.lastname + '" class="project-member member-photo brd-rad-4">' +
            '<a href="#" class="d-block p-rel">' +
            '<em data-id = "' + val.id + '" title="Remove member" class="remove-member">X</em>' +
            '<img src="' + img + '">' +
            '<em class="tooltip p-abs brd-rad-4 font-12 white-txt">' + val.firstname + ' ' + val.lastname + ' </em>' +
            '</a>' +
            '</div>'
        );
    });

    $('#id_project_country').html('');
    d_countries.forEach(function (val, i) {
        var g = (d_countries.length - 1 == i) ? '' : '|';

        $('#id_project_country').append(
            ' <en>' + val.country_name + '</en> ' + g
        )
    });

    $('#id_project_attachments').html('');
    d_attachments.forEach(function (val, i) {
        var type = ' <i class="fa fa-file" aria-hidden="true"></i>';
        if (val.type == 'pdf') {
            type = ' <i class="fa fa-file-pdf-o"></i>';
        } else if (val.type == 'doc' || val.type == 'docx') {
            type = '<i class="fa fa-file-word-o"></i>';
        } else if (val.type == 'jpg' || val.type == 'png' || val.type == 'jpeg') {
            type = '<i class="fa fa-picture-o" aria-hidden="true"></i>';
        }
        $('#id_project_attachments').append(
            '<div class="txt-without-icon"> ' +
            '<div class="related-documents">' +
            '<a download title="' + val.src + '" href="' + d_params.attachments_url + val.src + '" class="d-block font-w-300 font-14">' +
            type +
            val.src.substring(0, 20) + '...' + val.type +
            '</a>' +
            '</div>' +
            '</div>'
        )
    })
}

function GetChecklistsByProjectId(id) {
    var data = {};
    data.project_id = id;
    $.ajax({
        type: "POST",
        url: "/ajax/get-checklists-by-project-id",
        data: data,
        success: function (res) {
            if (res) {
                $('#id_checklists_data').html('');
                res.forEach(function (val, i) {
                    var members = '';
                    var status = val.status == 1 ? 'disabled-area' : '';
                    var checked = val.status == 1 ? 'checked' : '';
                    val.members.forEach(function (m) {

                        var img = (m.image_url && m.image_url != 'null') ? '/uploads/' + m.image_url : '/uploads/no-user.png';
                        members += '<div title="' + m.firstname + ' ' + m.lastname + '" class="member-photo brd-rad-4">' +
                            '<a href="#" class="d-block p-rel">' +
                            '<img src="' + img + '">' +
                            '<em class="tooltip p-abs brd-rad-4 font-12 white-txt">' + m.firstname + ' ' + m.lastname + '</em>' +
                            '</a>' +
                            '</div>';
                    });
                    $('#id_checklists_data').append(
                        '<div class="txt-without-icon p-rel ' + status + '">' +
                        '<label for="checklist-id-' + val.id + '" class="p-abs" style="left:0;">' +
                        '<input ' + checked + ' data-id="' + val.id + '" class="checkbox-checklist" type="checkbox" id="checklist-id-' + val.id + '">' +
                        '<strong class="bullet p-rel brd-+rad-4"></strong>' +
                        '</label>' +
                        '<span title="Title" class="d-block font-w-500 margin-btn-5">' + val.title + '</span>' +
                        '<span title="Description" class="d-block gray-txt font-w-300 margin-btn-5">' + val.description + '</span>' +
                        members +
                        '<span title="Deadline" class="d-block red-txt font-w-300"> Deadline: ' + val.deadline + '</span>' +
                        '</div>'
                    )
                });
                CheckSliderStatus()
            }
        }
    });
}

function CheckSliderStatus() {
    $('.checkbox-checklist:checked').closest('.txt-without-icon').addClass('disabled-area');
    var count = $('.checkbox-checklist').length;
    var checked = $('.checkbox-checklist:checked').length;
    var pr = Math.ceil((checked / count) * 100);
    pr = pr ? pr : 0;
    $('#id_slider').css('width', pr + '%')
    $('#id_slider_text').html(pr + '%')
}


//     0 => "Pending approval",
//     1 => "In progress",
//     2 => "Submitted",
//     3 => "Accepted",
//     4 => "Rejected",
//     5 => "Closed",
function GetStatusTile(id) {
    var s = '';
    var s_class = '';
    switch (id) {
        case 0:
            s = 'PENDING APPROVAL';
            s_class = 'pending';
            break;
        case 1:
            s = 'SUBMISSION PROCESS';
            s_class = 'in-progress';
            break;
        case 2:
            s = 'In progress';
            s_class = 'in-progress';
            break;
        case 3:
            s = 'Accepted';
            s_class = 'applied';
            break;
        case 4:
            s = 'Dismissed';
            s_class = 'in-progress';
            break;
        case 5:
            s = 'REJECTED';
            s_class = 'in-progress';
            break;
    }
    return {
        'title': s,
        'class': s_class
    }
}

function GetComments(data) {
    $.ajax({
        type: "POST",
        url: "/ajax/get-comments-by-project-id",
        data: data,
        success: function (comments) {
            if (comments) {
                $('#id_commnets_data').html('');
                if (comments) {
                    comments.forEach(function (val, i) {
                        $('#id_commnets_data').append(
                            '<div class="txt-with-icon">' +
                            '<i class="person-icon font-w-700" data-foo="' + val.user_cut + '" title="' + val.user_name + '"></i>' +
                            '<div class="person-repost">' +
                            '<a href="#" class="d-block no-underline font-w-700">' + val.user_name + '</a>' +
                            '<span class="brd-rad-4 white-bg">' +
                            ChangeCommentTextByTagHtml(val.comment) +
                            '</span>' +
                            '<a href="#" title="' + val.date + '" class="font-13 no-underline"><time class="timeago" datetime="' + val.date + '"></time></a>' +
                            '</div>' +
                            '</div>'
                        )
                    });
                    $("time.timeago").timeago();
                }
            }
        }
    });
}