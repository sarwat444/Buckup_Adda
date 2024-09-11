<script>
    const toast = (type,message) => {
        switch (type) {
            case 'success':
                flasher.success(message,"success");
                break;
            case 'error':
                flasher.error(message,"error");
                break;
            case 'warning':
                flasher.warning(message,"warning");
                break;
            case 'info':
                flasher.info(message,"info");
                break;
        }
    };
</script>
