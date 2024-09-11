<script>
    $('.create-new-lesson').on('click', function (event) {
        event.preventDefault();
        let newLessonButton = $(this);
        let modal = $('#create-new-lesson');
        let selectSection = $('.sections');
        $.ajax({
            url: '{{route('dashboard.courses.sections',$course->id)}}',
            type: 'GET',
            beforeSend: function () {
                newLessonButton.html(`<i class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i>{{__('admin-dashboard.loading...')}}`);
                newLessonButton.attr('disabled', true);
            },
            success: function (response) {
                newLessonButton.html(`<i class="bx bx-add-to-queue font-size-16 align-middle me-2"></i>{{__('admin-dashboard.New Lesson')}}`);
                newLessonButton.attr('disabled', false);
                if (response.sections.length > 0) {
                    let rows = '';
                    $.each(response.sections, function (index, section) {
                        rows += '<option value="' + section.id + '">' + section.name + '</option>';
                    });
                    $(selectSection).select2({
                        dropdownParent: $(modal),
                        width: '100%'
                    });
                    modal.modal('show');
                    $(selectSection).html(rows);
                } else {
                    toast('error', `{{__('admin-dashboard.no sections found please create new section first')}}`);
                }
            },
            error: function (error) {
                newLessonButton.html(`<i class="bx bx-add-to-queue font-size-16 align-middle me-2"></i>{{__('admin-dashboard.New Lesson')}}`);
                newLessonButton.attr('disabled', false);
                toast('error', 'something went wrong');
            },
        });
    });
</script>
