<script>
    $("#update-staff-from").on('submit', function (event) {
        event.preventDefault();
        $(this).find(".spinner-border").removeClass('d-none');
        let formData = new FormData($('#update-staff-from')[0]);
        $.ajax({
            'url': $(this).attr('action'),
            type: $(this).attr('method'),
            enctype: 'multipart/form-data',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                $("#submit-button").attr('disabled', true);
            },
            success: function (data) {
                $(".spinner-border").addClass('d-none');
                toast(data.type, data.message);
                location.reload();
            },
            error: function (data) {
                $(".spinner-border").addClass('d-none');
                $("#submit-button").attr('disabled', false);
                if (data.responseJSON.errors) {
                    $.each(data.responseJSON.errors, function (key, value) {
                        toast("error", value[0]);
                    });
                } else {
                    toast("error", "something went wrong");
                }
            },
        });
    });
</script>
