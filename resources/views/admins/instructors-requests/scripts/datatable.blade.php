<script>
    $(document).ready(function () {
        $('#instructors-datatable').DataTable({
            processing: true,
            serverSide: true,
            cache: false,
            ajax: '{{ route("dashboard.instructors.requests.datatables") }}',
            columns: [
                {data: 'DT_RowIndex', name: 'id', searchable: true, orderable: true},
                {data: 'user.first_name', name: 'user.first_name', searchable: false, orderable: false},
                {data: 'user.last_name', name: 'user.last_name', searchable: false, orderable: false},
                {data: 'user.email', name: 'user.email', searchable: false, orderable: false},
                {data: 'message', name: 'message', searchable: false, orderable: false},
                {data: 'attachment', name: 'attachment', searchable: false, orderable: false},
                {data: 'status', name: 'status', searchable: false, orderable: false,
                    render: function (data, type, row) {
                        if (data === 0) {
                            return '<span class="badge bg-warning">Pending</span>';
                        } else if (data === 1) {
                            return '<span class="badge bg-success">Accepted</span>';
                        } else if (data === 2) {
                            return '<span class="badge bg-danger">Rejected</span>';
                        }
                    }
                },
                {data: 'requested_at', name: 'requested_at', searchable: false, orderable: false},
                {data: 'actions', name: 'actions', searchable: false, orderable: false} ,
                {data: 'View_Details', name: 'View_Details', searchable: false, orderable: false}
            ],
            language:{
                url: DATATABLE_TRANSLATIONS_FILE_URL[USER_LOCALE]
            }
        });
    });
</script>
