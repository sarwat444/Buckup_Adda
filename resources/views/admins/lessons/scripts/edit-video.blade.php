<script>
    $('#update-lesson-video').submit(function (event) {
        event.preventDefault();
        let form = $(this);
        let spinner = form.find('.spinner-border').removeClass('d-none');
        let button = form.find('button').attr('disabled', true);
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            success: function (response) {
                button.attr('disabled', false);
                spinner.addClass('d-none');
                toast(response.type, response.message);
            },
            error: function (error) {
                button.attr('disabled', false);
                spinner.addClass('d-none');

                if (error.status === 422) {
                    $.each(error.responseJSON.errors, function (key, value) {
                        toast('error', value[0]);
                    });
                } else {
                    toast('error', 'something went wrong');
                }
            }
        });
    });
</script>
