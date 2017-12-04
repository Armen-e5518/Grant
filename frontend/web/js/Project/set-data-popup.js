var f_params = false;
var d_params;

$(document).ready(function () {

    $('#projects .project').click(function () {

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
                $('#popup-project').addClass('active-popup');
                SetProjectDataInHtml(d_params, d_project_data, d_members_data, d_attachments, d_countries);
                clearInterval(Inter)
            }
        }, 200);

        var ob = $(this);
        var data = {};
        data.id = ob.attr('data-id');
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
    })


});


function SetProjectDataInHtml(d_params, d_project_data, d_members_data, d_attachments, d_countries) {
    $('#id_project').attr('data-id', d_project_data.id);
    $('#id_project_title').html(d_project_data.ifi_name);
    $('#id_project_des').html(d_project_data.project_dec);
    $('#id_project_deadline').html(d_project_data.deadline);
    $('#id_project_created').html(d_project_data.request_issued);
    $('#id_project_members').html('')
    d_members_data.forEach(function (val, index) {
        var img = val.image_url ? d_params.user_url + val.image_url : '/images/no-user.png';
        $('#id_project_members').append(
            '<div class="member-photo brd-rad-4">' +
            '<a href="#" class="d-block p-rel">' +
            '<img src="' + img + '">' +
            '<em class="tooltip p-abs brd-rad-4 font-12 white-txt">' + val.firstname + ' ' + val.lastname + ' </em>' +
            '</a>' +
            '</div>'
        );
    })
    $('#id_project_country').html('')
    d_countries.forEach(function (val, i) {
        var g = (d_countries.length - 1 == i) ? '' : '|';

        $('#id_project_country').append(
            ' <en>' + val.country_name + '</en> ' + g
        )
    })
    $('#id_project_attachments').html('')
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
            '<a download href="' + d_params.attachments_url + val.src + '" class="d-block font-w-300 font-14">' +
            type +
            val.src.substring(0, 20) + '...' + val.type +
            '</a>' +
            '</div>' +
            '</div>'
        )
    })

}

function GetMembersNotProject() {

}