<script>
    $(document).ready(function () {
        $('#courses-comments').DataTable({
            processing: true,
            serverSide: true,
            cache: false,
            ajax: '{{ route("dashboard.course.comments.datatables",$course->id) }}',
            columns: [
                {data: 'DT_RowIndex', name: 'id', searchable: true, orderable: true},
                {data: 'comment', name: 'comment', searchable: true, orderable: true},
                {data: 'user.name', name: 'user.name', searchable: false, orderable: false},
                {data: 'user.email', name: 'user.email', searchable: false, orderable: false},
                {data: 'actions', name: 'actions', searchable: false, orderable: false}
            ],
        });
    });
</script>
