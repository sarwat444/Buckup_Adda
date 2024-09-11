<script>
    $(document).ready(function () {
        $('#lesson-comments-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("dashboard.lessons.comments.datatables",$lesson->id) }}',
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
