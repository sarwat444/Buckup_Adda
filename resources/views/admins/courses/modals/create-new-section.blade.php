<div class="modal fade" id="create-new-section" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('admin-dashboard.New Section')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('dashboard.sections.store')}}" id="store-new-section">
                    @csrf
                    <input type="hidden" name="course_id" value="{{$course->id}}">
                    <div class="mb-2">
                        <label for="name" class="col-form-label">{{__('admin-dashboard.Section Name')}}:</label>
                        <input type="text" name="name" placeholder="{{__('admin-dashboard.Section Name')}}" class="form-control" id="name"
                               required>
                    </div>
                    <div class="mb-2 text-center">
                        <div class="spinner-border text-primary m-1 d-none" role="status"><span class="sr-only"></span>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('admin-dashboard.close')}}</button>
                        <button type="submit" class="btn btn-primary" id="submit-button">{{__('admin-dashboard.save')}}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
