<script>
    $(document).ready(function () {
        $('.form-search-products-users').on('keyup', function () {

            let criteria = $(this).find('input[name="criteria"]').val();

            if (criteria.length > 0) {
                $.ajax({
                    type: 'GET',
                    url: '',
                    data: {'criteria': criteria},
                    success: function (response) {
                        if (response.data.length > 0) {
                            $('.products-result-search').html(`<u>product result :</u>`);
                            let route = '';
                            $.each(response.data, function (index, value) {
                                let url = route.replace(':id', value.id);
                                $('.products-result-search').append(`<li><a href="` + url + `" target="_blank">${value.name}</a></li>`);
                            });
                        } else {
                            $('.products-result-search').html(`<li class="text-center">no products result founded</li>`);
                        }
                    },
                    error: function (response) {
                        toast('error', 'something went wrong');
                    }
                });
            } else {
                $('.products-result-search').html(`<li class="text-center">no products result</li>`);
            }

            if (criteria.length > 0) {
                $.ajax({
                    type: 'GET',
                    url: '',
                    data: {'criteria': criteria},
                    success: function (response) {
                        if (response.data.length > 0) {
                            $('.users-result-search').html(`<u>user result :</u>`);
                            let route = '';
                            $.each(response.data, function (index, value) {
                                let url = route.replace(':id', value.id);
                                $('.users-result-search').append(`<li><a href="` + url + `" target="_blank">${value.first_name} ${value.last_name}</a></li>`);
                            });
                        } else {
                            $('.users-result-search').html(`<li class="text-center">no users result founded</li>`);
                        }
                    },
                    error: function (response) {
                        toast('error', 'something went wrong');
                    }
                });
            } else {
                $('.users-result-search').html(`<li class="text-center">no users result</li>`);
            }
        })
    })
</script>
