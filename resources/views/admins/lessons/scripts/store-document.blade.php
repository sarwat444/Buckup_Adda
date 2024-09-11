<script>
    $("#store-lesson-document-from").submit(function (event) {
        event.preventDefault();
        $(this).find(".spinner-border").removeClass('d-none');
        let formData = new FormData($('#store-lesson-document-from')[0]);
        $.ajax({
            'url': $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (response) {
                $(".spinner-border").addClass('d-none');
                toast(response.type, response.message);
                location.reload();
            },
            error: function (response) {
                $(".spinner-border").addClass('d-none');
                if (response.status === 422) {
                    $.each(response.responseJSON.errors, function (key, value) {
                        toast("error", value[0]);
                    });
                } else {
                    toast('error', 'Something went wrong');
                }
            },
        });
    });
</script>
