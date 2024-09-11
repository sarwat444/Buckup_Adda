<script>
    $("input").on("focus",function () {
        $(this).removeClass("is-invalid");
    });

    $("select").on("focus",function () {
        $(this).removeClass("is-invalid");
    });
</script>
