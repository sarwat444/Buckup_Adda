<script>
    $("#is_free").change(function () {
        if ($(this).is(":checked")) {
            $('#price').val(0).attr('disabled', true);
            $('#old_price').val(0).attr('disabled', true);
        } else {
            $("#price").prop('disabled', false);
            $("#old_price").prop('disabled', false);
        }
    });
</script>
