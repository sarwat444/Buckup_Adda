<script>
    $(document).ready(function () {
        $('#lesson-views-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("dashboard.lessons.views.datatables",$lesson->id) }}',
            columns: [
                {data: 'DT_RowIndex', name: 'id', searchable: true, orderable: true},
                {data: 'user.name', name: 'user.name', searchable: false, orderable: false},
                {data: 'user.email', name: 'user.email', searchable: false, orderable: false},
                {
                    data: 'created_at', name: 'created_at', searchable: false, orderable: false,
                    render: function (data) {
                        return new Date(data).toLocaleString();
                    }
                }
            ],

        });
    });
</script>
