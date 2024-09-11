<script>
    $("#store-new-category").submit(function (event) {
        event.preventDefault();
        $(this).find(".spinner-border").removeClass('d-none');
        let formData = new FormData($('#store-new-category')[0]);
        $.ajax({
            'url': $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                $(".spinner-border").addClass('d-none');
                $("#store-new-category").trigger("reset");
                $("#create-new-category").modal('hide');
                location.reload();
                toast(data.type, data.message);
            },
            error: function (data) {
                $(".spinner-border").addClass('d-none');
                $.each(data.responseJSON.errors, function (key, value) {
                    toast("error", value[0]);
                });
            },
        });
    });
</script>
