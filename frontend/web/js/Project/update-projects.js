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
                console.log('data table');
                // setTimeout(function () {
                $('#projects-data-t').DataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bInfo": false,
                    "bAutoWidth": false,
                    "columns": [
                        {"orderable": true},
                        {"orderable": true},
                        {"orderable": true},
                        {"orderable": true},
                        {"orderable": true},
                        {"orderable": true},
                        {"orderable": true},
                        {"orderable": true},
                        {"orderable": false}
                    ]
                });
                // }, 500)

            }
        }
    });
}