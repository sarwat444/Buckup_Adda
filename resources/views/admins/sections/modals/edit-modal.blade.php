<div class="modal fade text-left" id="editSectionModal" tabindex="-1" role="dialog" aria-labelledby="editSectionModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="modal-reload">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('admin-dashboard.edit section')}}</h5>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="form-edit-section">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">{{__('admin-dashboard.section name')}}</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="{{__('admin-dashboard.section name')}}"
                               required>
                    </div>
                    <div class="form-group text-center mt-2">
                        <button id="modal-blockui" type="submit" class="btn btn-primary">{{__('admin-dashboard.save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

