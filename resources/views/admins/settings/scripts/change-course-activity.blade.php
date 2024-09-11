<script>
    $(document).ready(function () {
        $('.change-course-activity').on('change', function () {
            let _token = '{{ csrf_token() }}';
            let course_id = $(this).data('course-id');
            let is_top = $(this).is(':checked') ? 1 : 0;
            let url = '{{ route('dashboard.settings.courses.homepage.top',':course') }}';
            url = url.replace(':course', course_id);
            $.ajax({
                url: url,
                type: 'PUT',
                data: {_token: _token, is_top: is_top},
                success: function (response) {
                    toast(response.type, response.message);
                },
                error: function (response) {
                    console.log(response);
                }
            });
        });
    });
</script>
