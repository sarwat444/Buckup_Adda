<script>
    $(document).on('click', '.edit', function () {
        let sectionId = $(this).data('section-id');
        let route = "{{route('dashboard.sections.edit',':id')}}";
        route = route.replace(':id', sectionId);
        $.ajax({
            url: route,
            method: 'GET',
            success: function (response) {
                if (response.data) {
                    let route = "{{route('dashboard.sections.update',':id')}}";
                    route = route.replace(':id', response.data.id);
                    $('#form-edit-section').attr('action', route);
                    let modalEditSection = $('#editSectionModal');
                    modalEditSection.find('#name').val(response.data.name);
                    modalEditSection.modal('show');
                } else {
                    toast('error', 'section not found');
                }
            },
            error: function (response) {
                toast('error', 'an error occurred');
            }
        });
    });
</script>
