<div class="modal fade" id="create-new-category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">أضافه خطه جديده </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('dashboard.kheta.store')}}" id="store-new-category" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-2">
                        <label for="name" class="col-form-label">أسم الخطه </label>
                        <input type="text" name="name" placeholder="اسم الخطه" class="form-control" id="name"
                               required>
                    </div>
                    <div class="mb-2">
                        <label for="name" class="col-form-label">لوجو الخطه </label>
                        <input type="file" name="image"  class="form-control" id="logo" required>
                    </div>
                    <div class="outer-repeater">
                        <div data-repeater-list="outer-group" class="outer">
                            <div data-repeater-item class="outer">
                                <div class="inner-repeater mb-4">
                                                    <div data-repeater-list="inner-group" class="inner mb-3">
                                                        <label>سنوات التنفيذ </label>
                                                        <div data-repeater-item class="inner mb-3 row">
                                                            <div class="col-md-10 col-8">
                                                                <input type="text" name="years" class="inner form-control"  required placeholder="السنه"/>

                                                            </div>
                                                            <div class="col-md-2 col-4">
                                                                <div class="d-grid">
                                                                    <input data-repeater-delete type="button" class="btn btn-primary inner btn-sm" value="حذف "/>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <input data-repeater-create type="button" class="btn btn-success inner btn-sm" value="أضافه"/>
                                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 text-center">
                        <div class="spinner-border text-primary m-1 d-none" role="status"><span class="sr-only"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">أغلاق</button>
                        <button type="submit" class="btn btn-primary">حفظ </button>
                    </div>
                </form>

        </div>
    </div>
</div>
</div>
