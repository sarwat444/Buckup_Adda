<div class="modal fade" id="create-new-lesson" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('admin-dashboard.New Lesson')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('dashboard.lessons.create')}}" id="store-new-lesson">
                    <div class="col-12">
                        <div class="mb-2">
                            <div class="form-check form-check-inline font-size-16">
                                <input class="form-check-input" type="radio" name="type" id="video" value="video" checked>
                                <label class="form-check-label font-size-13" for="video"><i
                                        class="far fa-file-video me-1 font-size-20 align-top"></i>{{__('admin-dashboard.Video')}}</label>
                            </div>

                            <div class="form-check form-check-inline font-size-16">
                                <input class="form-check-input" type="radio" name="type" id="document" value="document">
                                <label class="form-check-label font-size-13" for="document"><i
                                        class="fas fa-file-alt me-1 font-size-20 align-top"></i>{{__('admin-dashboard.Document')}}</label>
                            </div>

                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-2">
                            <label for="section_id" class="form-label mt-1">{{__('admin-dashboard.Lesson Section')}}</label>
                            <select name="section_id" class="form-control sections select2" required></select>
                        </div>
                    </div>

                    <div class="mb-2 text-center">
                        <div class="spinner-border text-primary m-1 d-none" role="status"><span class="sr-only"></span>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('admin-dashboard.close')}}</button>
                        <button type="submit" class="btn btn-primary" id="submit-button">{{__('admin-dashboard.create')}}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
