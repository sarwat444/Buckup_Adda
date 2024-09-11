<script>
    $('.confirm-delete').click(function (event) {
        let form = $(this).closest("form");
        event.preventDefault();
        Swal.fire({
            title: "{{__('admin-dashboard.Are you sure?')}}",
            text: "{{__('admin-dashboard.You won\'t be able to revert this!')}}",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "green",
            cancelButtonColor: "red",
            confirmButtonText: "{{__('admin-dashboard.Yes, delete it!')}}",
            cancelButtonText: "{{__('admin-dashboard.No, cancel!')}}",
        }).then((result) => {
            if (result.value) {
                form.submit();
            }
        });
    });
</script>
