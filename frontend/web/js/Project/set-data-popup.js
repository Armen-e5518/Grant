$(document).ready(function () {

    var f_params = false;
    var d_params;
    var f_project_data = false;
    var d_project_data;
    var f_members_data = false;
    var d_members_data;
    var f_attachments = false;
    var d_attachments;

    $.ajax({
        type: "POST",
        url: "/ajax/get-params",
        data: data,
        success: function (params) {
            f_params = true;
            if (params) {
                d_params = params;
            }
        }
    });


    $('#projects .project').click(function () {

        setInterval(function () {
            if (f_params && f_members_data && f_project_data && f_attachments) {
                SetProjectDataInHtml()
            }
        }, 200);

        var ob = $(this);
        var data = {};
        data.id = ob.attr('data-id');
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
    })


});


function SetProjectDataInHtml($project) {

}