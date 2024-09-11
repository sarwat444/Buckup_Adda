<script>
    $(document).on('click', '.change-order-status', function () {
        let status = $(this).data('status');
        let request_id = $(this).data('request-id');
        let _token = '{{csrf_token()}}';
        let url = '{{route('dashboard.instructors.requests.update.status',':request_id')}}';
        url = url.replace(':request_id', request_id);
        $.ajax({
            url: url,
            type: 'POST',
            data: {_token: _token, status: status},
            success: function (response) {
                location.reload();
                toast(response.type, response.message);
            },
            error: function (response) {
                if (response.responseJSON.errors) {
                    $.each(response.responseJSON.errors, function (key, value) {
                        toast("error", value[0]);
                    });
                } else {
                    toast("error", "something went wrong");
                }
            }
        });
    });
</script>
