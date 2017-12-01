$(document).ready(function () {
    IsChecked();

    $(document).on('change', '#projects-international_status', function () {
        IsChecked()
    });

    function IsChecked() {
        if ($('#projects-international_status').is(':checked')) {
            $('#add-country').prop('disabled', true);
        } else {
            $('#add-country').prop('disabled', false);
        }
    }

})
