<script>
    $('#delete-course-video').click(function (event) {
        event.preventDefault();
        let url = $(this).attr('action');
        Swal.fire({
            title: 'Do you want to delete this video?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showDenyButton: true,
            confirmButtonText: `Delete only`,
            denyButtonText: `Delete & add new video`,
        }).then((result) => {
            if (result.isConfirmed) {
                url = url + '?add_new=0';
                $(this).attr('action', url);
                $('#delete-course-video').submit();

            } else if (result.isDenied) {
                url = url + '?add_new=1';
                $(this).attr('action', url);
                $('#delete-course-video').submit();
            }
        })

    });
</script>
