<script>
    $(document).on('click' , '.confirm-delete' , function(){

        let form = $(this).closest("form");
        event.preventDefault();
        Swal.fire({
            title: "هل متاكد من الحذف ",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "green",
            cancelButtonColor: "red",
            confirmButtonText: "نعم",
            cancelButtonText: "تجاهل",
        }).then((result) => {
            if (result.value) {
                form.submit();
            }
        });
    });
</script>
