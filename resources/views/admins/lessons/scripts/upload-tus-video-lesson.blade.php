<script>
    $(document).on('click', '#submit-form-upload', function (e) {
        e.preventDefault();
        let uploadUrl = $("#upload-video-lesson").attr('action');
        let file = document.getElementById('file_data').files[0];
        let submitButton = $("#submit-form-upload");
            submitButton.attr('disabled', true);
            submitButton.html('<i class="fa fa-spinner fa-spin"></i>uploading...');
        let upload = new tus.Upload(file, {
            uploadUrl: uploadUrl,
            onError: function (error) {
                submitButton.attr('disabled', false);
                submitButton.html('upload now');
                toast('error', error);
                console.log('error: ' + error);
            },
            onProgress: function (bytesUploaded, bytesTotal) {
                let percentage = (bytesUploaded / bytesTotal * 100).toFixed(2);
                let progress = $("#progress-bar");
                progress.css('width', percentage + '%');
                progress.text(percentage + '%');
            },
            onSuccess: function () {
                let route = "{{route('dashboard.lessons.video.uploaded',':lesson_id')}}";
                let lesson_id = $("#lesson_id").val();
                route = route.replace(':lesson_id', lesson_id);
                submitButton.html(`uploaded successfully`);
                $.ajax({
                    url: route,
                    type: 'POST',
                    data: {_token: '{{csrf_token()}}'},
                    success: function (response) {
                        if (response.type === 'success') {
                            toast(response.type, response.message);
                            window.location.href = response.next;
                        } else {
                            toast(response.type, response.message);
                        }
                    },
                    error: function (response) {
                        toast('error', 'an error occurred while assigning the video to folder');
                    }
                });
                toast('success', 'video uploaded successfully');
                console.log("Download %s from %s", upload.file.name, upload.url)
            }
        })
        upload.start();
    });
</script>
