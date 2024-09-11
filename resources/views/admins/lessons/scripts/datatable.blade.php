<script>
    $(document).ready(function () {
        $('#lessons-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("dashboard.lessons.datatables") }}',
            columns: [
                {data: 'DT_RowIndex', name: 'id', searchable: true, orderable: true},
                {data: 'title', name: 'title', searchable: true, orderable: true},
                {data: 'course.name', name: 'course.name', searchable: false, orderable: false},
                {data: 'section.name', name: 'section.name', searchable: false, orderable: false},
                {data: 'type', name: 'type', searchable: false, orderable: false},
                {data: 'provider', name: 'provider', searchable: false, orderable: false},
                {data: 'is_free', name: 'is_free', searchable: false, orderable: false},
                {data: 'is_publish', name: 'is_publish', searchable: false, orderable: false},
                {data: 'actions', name: 'actions', searchable: false, orderable: false}
            ],
            language: {
                url: DATATABLE_TRANSLATIONS_FILE_URL[USER_LOCALE]
            }
        });
    });
</script>
