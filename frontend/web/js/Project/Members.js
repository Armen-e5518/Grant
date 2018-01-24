$(document).ready(function () {


    $('#id_add_members').click(function () {
        $(this).hide();
        $('#id_members').show();
    });

    $(document).on('change', '#id_members', function () {
        var data = {};
        data.id = this.value;
        data.project_id = $('#id_project').attr('data-id');
        $.ajax({
            type: "POST",
            url: "/ajax/save-member-by-project-id",
            data: data,
            success: function (res) {
                if (res) {
                    AddNewNotificationInUser(data.id, data.project_id,1);
                    var img_o = $('#id_members option:selected').attr('data-img');
                    var name = $('#id_members option:selected').html();
                    var id = $('#id_members option:selected').val();
                    var img = (img_o && img_o != 'null') ? d_params.user_url + img_o : '/images/no-user.png';
                    $('#id_project_members').append(
                        '<div title="' + name + '" class="project-member member-photo brd-rad-4">' +
                        '<a href="#" class="d-block p-rel">' +
                        '<em data-id = "' + id + '" class="remove-member">X</em>' +
                        '<img src="' + img + '">' +
                        '<em class="tooltip p-abs brd-rad-4 font-12 white-txt">' + name + ' </em>' +
                        '</a>' +
                        '</div>'
                    );
                    $('#id_members option:selected').remove();
                    $('#id_members').hide();
                    $('#id_add_members').show();
                }
            }
        });
    })

});


function AddNewNotificationInUser(user_id, project_id, type) {
    var data = {};
    data.user_id = user_id
    data.project_id = project_id;
    data.type = type;
    $.ajax({
        type: "POST",
        url: "/ajax/add-new-notification",
        data: data,
        success: function (res) {
            if (res) {

            }
        }
    });
}