<script>
    $(document).ready(function () {
        $('.select2.course').on('change', function () {
            let course = $(this).val();
            let route = '{{ route("dashboard.courses.sections", ":course") }}';
            route = route.replace(':course', course);
            $.ajax({
                url: route,
                type: 'GET',
                success: function (response) {
                    if (response.sections.length > 0) {
                        let rows = '<option disabled selected>{{__('admin-dashboard.select section')}}</option>';
                        $.each(response.sections, function (index, section) {
                            rows += '<option value="' + section.id + '">' + section.name + '</option>';
                        });
                        $('.sections').html(rows);
                    } else {
                        $('.sections').html('<option disabled selected>{{__('admin-dashboard.select section')}}</option>');
                    }
                },
                error: function (response) {
                    toast('error', 'Something went wrong');
                }
            });
        });
    });
</script>
