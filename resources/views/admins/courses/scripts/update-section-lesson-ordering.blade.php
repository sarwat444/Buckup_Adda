<script>
    let sections = {{ Illuminate\Support\Js::from($course->sections->pluck('id')) }};
    if (sections.length > 0) {
        sections.forEach(function (id) {
            dragula([document.getElementById('section-lessons-dragula' + id)], {})
                .on('drop', function (elementWillDrop, newTarget, oldTarget, sibling) {
                    let existsSectionId = $(oldTarget).data('section-id');
                    let token = '{{csrf_token()}}';
                    let url = "{{route('dashboard.sections.update.order',':section')}}";
                    url = url.replace(':section', existsSectionId);
                    let arrangeNewLessonsOrdering = [];
                    $(newTarget).find('li').each(function (index, element) {
                        if ($(element).data('lesson-id')) {
                            arrangeNewLessonsOrdering.push($(element).data('lesson-id'));
                        }
                    });
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {_token: token, ordering: arrangeNewLessonsOrdering},
                        success: function (response) {
                            toast(response.type, response.message);
                        },
                        error: function (response) {
                            if (response.status === 422) {
                                $.each(response.responseJSON.errors, function (key, value) {
                                    toast("error", value[0]);
                                });
                            } else {
                                toast("error", "Something went wrong");
                            }
                        }
                    });
                });
        });
    }
</script>
