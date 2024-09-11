<form id="upload-video-lesson" action="{{$uploadLink}}" enctype="multipart/form-data"
      method="POST">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <label for="file_data" class="form-label">Lesson Video File:</label>
                <input type="file" name="file_data" class="form-control"
                       id="file_data" required>
            </div>
        </div>
    </div>

    <div class="progress progress-xl mb-5">
        <div id="progress-bar" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100">0%</div>
    </div>
    <div class="text-center">
        <button type="submit" id="submit-form-upload" class="btn btn-primary w-md">upload now</button>
    </div>
</form>
<input type="hidden" id="lesson_id" value="{{$lessonId}}">
