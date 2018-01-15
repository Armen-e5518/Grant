$(document).ready(function () {

    $('.delete-attachment').click(function () {
        var ob = $(this);
        var data = {};
        data.id = ob.attr('data-id');
        $.ajax({
            type: "POST",
            url: "/ajax/delete-attachment-by-id",
            data: data,
            success: function (res) {
                if (res == true) {
                    ob.closest('.attachment').hide();
                }
            }
        });
    })


    $('#id_attach_file').click(function () {
        $('#fileuploader').show();
        $('#id_attach_file').hide();
        var project_id = $('#id_project').attr('data-id');
        $("#fileuploader").uploadFile({
            url: "/file/upload",
            fileName: "myfile",
            formData: {"project_id": project_id},
            onSuccess: function (files, data, xhr, pd) {
                var val = JSON.parse(data);
                $('#fileuploader').hide();
                $('#id_attach_file').show();
                $('.ajax-file-upload-container').hide();
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
            },
        });
    })


});