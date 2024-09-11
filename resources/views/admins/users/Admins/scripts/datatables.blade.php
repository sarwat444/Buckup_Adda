<script>
    $(document).ready(function () {
        $('#Admins-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("dashboard.Admins.datatables") }}',
            columns: [
                {data: 'DT_RowIndex', name: 'id', searchable: true, orderable: true},
                {data: 'first_name', name: 'first_name', searchable: true, orderable: true},
                {data: 'last_name', name: 'last_name', searchable: true, orderable: true},
                {data: 'created_at', name: 'created_at', searchable: true , orderable: false},
                {data: 'user_status', name: 'user_status', searchable: false, orderable: false,
                    render: function (data, type, row) {
                      if(data == 0 )
                      {
                          return '<span class="badge badge-pill  badge-soft-danger  font-size-12"> In Active </span>';
                      }else if (data  == 1 )
                      {
                          return '<span class="badge badge-pill  badge-soft-primary  font-size-12"> Active </span>';
                      }else
                      {
                          return '<span class="badge badge-pill  badge-soft-warning  font-size-12"> Pending </span>';
                      }

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
