<script>
    $(document).ready(function () {
        $('#courses-datatable').DataTable({
            processing: true,
            serverSide: true,
            cache: false,
            ajax: '{{ route("dashboard.courses.datatables") }}',
            columns: [
                {data: 'DT_RowIndex', name: 'id', searchable: true, orderable: true},
                {data: 'title', name: 'title', searchable: true, orderable: true},
                {data: 'image', name: 'image', searchable: false, orderable: false},
                {data: 'category.name', name: 'category.name', searchable: false, orderable: false},
                {data: 'price', name: 'price', searchable: true, orderable: true},
                {data: 'old_price', name: 'old_price', searchable: true, orderable: true},
                {
                    data: 'level', name: 'level', searchable: false, orderable: false,

                    render: function (data, type, row) {
                        if (data === 1) {
                            return '<span class="badge bg-success">beginner</span>';
                        } else if (data === 2) {
                            return '<span class="badge bg-info">intermediate</span>';
                        } else if (data === 3) {
                            return '<span class="badge bg-warning">expert</span>';
                        }
                    }

                },
                {
                    data: 'is_top', name: 'is_top', searchable: false, orderable: false,

                    render: function (data, type, row) {
                        if (data === 1) {
                            return '<span class="badge bg-success">Yes</span>';
                        } else {
                            return '<span class="badge bg-danger">No</span>';
                        }
                    }
                },
                {
                    data: 'is_active', name: 'is_active', searchable: false, orderable: false,

                    render: function (data, type, row) {
                        if (data === 1) {
                            return '<span class="badge bg-success">Yes</span>';
                        } else {
                            return '<span class="badge bg-danger">No</span>';
                        }
                    }
                },
                {
                    data: 'is_free', name: 'is_free', searchable: false, orderable: false,

                    render: function (data, type, row) {
                        if (data === 1) {
                            return '<span class="badge bg-success">Yes</span>';
                        } else {
                            return '<span class="badge bg-danger">No</span>';
                        }
                    }
                },
                {data: 'actions', name: 'actions', searchable: false, orderable: false}
            ],
            language:{
                url: DATATABLE_TRANSLATIONS_FILE_URL[USER_LOCALE]
            }
        });
    });
</script>
