<div class="modal fade" id="create-new-category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">أضافه مؤشر جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('dashboard.moksherat.store')}}" id="store-new-category">
                    @csrf
                    <div class="mb-2">
                        <label for="type" class="col-form-label">نوع المؤشر</label>
                        <select class="form-control select2" name="type[]" multiple style="width: 100%">
                            <option value="0">مؤشر وزارة</option>
                            <option value="1">مؤشر جامعة</option>
                            <option value="2">مؤشر كلية</option>
                            <option value="3">الكل</option>
                        </select>
                        <input type="hidden" name="program_id" value="{{$program_id}}">
                    </div>
                    <div class="mb-2">
                        <label for="program" class="col-form-label" name="name" >أسم المؤشر</label>
                        <input type="text" name="name" placeholder="أسم المؤشر" class="form-control" id="type" required>
                    </div>
                    <div class="mb-2 text-center">
                        <div class="spinner-border text-primary m-1 d-none" role="status"><span class="sr-only"></span></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> تجاهل </button>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
