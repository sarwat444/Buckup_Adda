<script>
    $("#store-user-from").on('submit', function (event) {
        event.preventDefault();
        let submitButton = $(this).find("#submit-button");
        let formData     = new FormData($('#store-user-from')[0]);
        let spinner      = $(this).find(".spinner-border");
        $.ajax({
            'url': $(this).attr('action'),
            type: $(this).attr('method'),
            enctype: 'multipart/form-data',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                spinner.removeClass('d-none');
                submitButton.attr('disabled', true);
            },
            success: function (data) {
                spinner.addClass('d-none');
                toast(data.type, data.message);
                window.location.href = data.next;
            },
            error: function (data) {
                spinner.addClass('d-none');
                submitButton.attr('disabled', false);
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
