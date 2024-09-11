<script>
    $(document).ready(function () {
        $('#sections-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("dashboard.sections.datatables") }}',
            columns: [
                {data: 'DT_RowIndex', name: 'id', searchable: true, orderable: true},
                {data: 'name', name: 'name', searchable: true, orderable: true},
                {data: 'course.name', name: 'course.name', searchable: false, orderable: false},
                {data: 'lessons_count', name: 'lessons_count.name', searchable: false, orderable: false,
                    render: function (data, type, row) {
                        return '<span class="badge badge-pill badge-soft-primary font-size-12">' + data + '</span>';
                    }
                },
                {data: 'actions', name: 'actions', searchable: false, orderable: false}
            ],
            language: {
                url: DATATABLE_TRANSLATIONS_FILE_URL[USER_LOCALE]
            },
        });
    });
</script>
