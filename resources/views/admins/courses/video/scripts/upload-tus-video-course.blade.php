<script>
    $(document).on('click','#submit-form-upload',function(e){
        e.preventDefault();
        let uploadUrl = $("#upload-video-course").attr('action');
        let file = document.getElementById('file_data').files[0];
        let submitButton = $("#submit-form-upload");
        submitButton.attr('disabled', true);
        submitButton.html('<i class="fa fa-spinner fa-spin"></i> uploading...');
        let upload = new tus.Upload(file, {
            uploadUrl: uploadUrl,
            onError: function(error) {
                toast('error','error upload video');
                console.log('error: ' + error);
                $("#submit-form-upload").attr('disabled', false);
            },
            onProgress: function(bytesUploaded, bytesTotal) {
                let percentage = (bytesUploaded / bytesTotal * 100).toFixed(2);
                let progress = $("#progress-bar");
                progress.css('width',percentage+'%');
                progress.text(percentage+'%');
            },
            onSuccess: function() {
                let route = "{{route('dashboard.courses.video.uploaded',':course_id')}}";
                let course_id = $("#course_id").val();
                route = route.replace(':course_id',course_id);
                submitButton.html(`uploaded successfully`);
                $.ajax({
                    url: route,
                    type: 'POST',
                    data: {_token: '{{csrf_token()}}'},
                    success: function(response){
                        if(response.type === 'success') {
                            toast(response.type, response.message);
                        } else {
                            toast(response.type, response.message);
                        }
                    },
                    error: function(response){
                        toast('error','an error occurred while assigning the video to folder');
                    }
                });
                toast('success','video uploaded successfully');
                console.log("Download %s from %s", upload.file.name, upload.url)
            }
        })
        upload.start();
    });
</script>
