$(document).ready(function () {
    UpdateProjectList()
});

function UpdateProjectList() {
    $.ajax({
        type: "POST",
        url: "/ajax/update-projects-list",
        data: __Get,
        success: function (res) {
            if (res) {
                $('#projects').html('').html(res);
                $('#popup-project').removeClass('active-popup');
            }
        }
    });
}