$(document).ready(function () {

    $('#id_approve').click(function () {
        var data = {};
        data.project_id = $('#id_project').attr('data-id');
        data.status = 1;
        $.ajax({
            type: "POST",
            url: "/ajax/save-change-status",
            data: data,
            success: function (res) {
                if (res) {
                    var Status = GetStatusTile(data.status);
                    ApproveStatus()
                    $('#id_status_title').html(Status.title).removeClass('in-progress applied pending').addClass(Status.class);
                }
            }
        });
    });

    $('#id_submit').click(function () {
        var data = {};
        data.project_id = $('#id_project').attr('data-id');
        data.status = 2;
        $.ajax({
            type: "POST",
            url: "/ajax/save-change-status",
            data: data,
            success: function (res) {
                if (res) {
                    var Status = GetStatusTile(data.status);
                    SubmitStatus()
                    $('#id_status_title').html(Status.title).removeClass('in-progress applied pending').addClass(Status.class);
                }
            }
        });
    });

    $('#id_accepted').click(function () {
        var data = {};
        data.project_id = $('#id_project').attr('data-id');
        data.status = 3;
        $.ajax({
            type: "POST",
            url: "/ajax/save-change-status",
            data: data,
            success: function (res) {
                if (res) {
                    var Status = GetStatusTile(data.status);
                    HideButtons()
                    $('#id_status_title').html(Status.title).removeClass('in-progress applied pending').addClass(Status.class);
                }
            }
        });
    });

    $('#id_reject').click(function () {
        var data = {};
        data.project_id = $('#id_project').attr('data-id');
        data.status = 4;
        $.ajax({
            type: "POST",
            url: "/ajax/save-change-status",
            data: data,
            success: function (res) {
                if (res) {
                    var Status = GetStatusTile(data.status);
                    HideButtons()
                    $('#id_status_title').html(Status.title).removeClass('in-progress applied pending').addClass(Status.class);
                }
            }
        });
    });

    $('#id_closed').click(function () {
        var data = {};
        data.project_id = $('#id_project').attr('data-id');
        data.status = 5;
        $.ajax({
            type: "POST",
            url: "/ajax/save-change-status",
            data: data,
            success: function (res) {
                if (res) {
                    var Status = GetStatusTile(data.status);
                    HideButtons()
                    $('#id_status_title').html(Status.title).removeClass('in-progress applied pending').addClass(Status.class);
                }
            }
        });
    });
});

function ApproveStatus() {
    $('#id_checklist_block').show();
    // $('#id_change_status').show();
    $('#id_add_checklist').show();
    $('#id_submit').show();
    $('#id_approve').hide();
    $('#id_reject').hide();
}
function SubmitStatus() {
    $('#id_submit').hide();
    $('#id_checklist_block').show();
    // $('#id_change_status').show();
    $('#id_add_checklist').show();
    $('#id_accepted').show();
    $('#id_closed').show();
}
function HideButtons() {
    $('#id_buttons').hide();
    $('#id_checklist_block').show();
    $('#id_add_checklist').show();
}