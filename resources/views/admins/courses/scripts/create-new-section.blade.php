<script>
    $("#store-new-section").submit(function (event) {
        event.preventDefault();
        let formData = new FormData($('#store-new-section')[0]);
        let submitButton = $(this).find('#submit-button');
        let spinner = $(this).find('.spinner-border');
        $.ajax({
            'url': $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                spinner.removeClass('d-none');
                submitButton.attr('disabled', true);
            },
            success: function (data) {
                toast(data.type, data.message);
                location.reload();
            },
            error: function (data) {
                submitButton.attr('disabled', false);
                spinner.addClass('d-none');
                $.each(data.responseJSON.errors, function (key, value) {
                    toast("error", value[0]);
                });
            },
        });
    });
</script>
