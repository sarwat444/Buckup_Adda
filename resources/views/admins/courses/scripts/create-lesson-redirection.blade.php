<script>
    $('#store-new-lesson').submit(function (event) {
        event.preventDefault();
        let course_id = '{{$course->id}}';
        let section_id = $(this).find('.sections option:selected').val();
        let section_name = $(this).find('.sections option:selected').text();
        let lesson_type = $(this).find('input[name=type]:checked').val();
        window.location.href = $(this).attr('action') + '?type=' + lesson_type + '&section_id=' + section_id + '&course_id=' + course_id + '&section_name=' + section_name;
    });
</script>
