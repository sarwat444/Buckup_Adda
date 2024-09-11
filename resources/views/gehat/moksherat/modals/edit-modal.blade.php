<div class="modal fade text-left" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="modal-reload">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تعديل البرنامج </h5>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="form-edit-category">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">أسم البرنامج</label>
                        <input type="text" name="program" class="form-control" id="name" placeholder="أسم البرنامج "  required>
                        <input type="hidden" name="addedBy" value="{{\Illuminate\Support\Facades\Auth::user()->id }}">
                    </div>
                    <div class="form-group text-center mt-2">
                        <button id="modal-blockui" type="submit" class="btn btn-primary">{{__('admin-dashboard.save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

