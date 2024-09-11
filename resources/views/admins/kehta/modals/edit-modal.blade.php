<div class="modal fade text-left" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="modal-reload">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تعديل  بيانات  الخطه</h5>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="form-edit-category" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">أسم الخطه </label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="أسم الخطه " required>
                    </div>
                    <div class="form-group">
                        @if(!empty($kheta->image))
                        <img class="img-thumbnail" src="{{asset(PUBLIC_PATH.$kheta->image)}}" height="70px" style="height: 50px">
                      @else
                      <img class="img-thumbnail" src="{{asset(PUBLIC_PATH.'uploads/kheta/default.png')}}" height="70px" style="height: 50px">
                        @endif
                        <label>صوره اللوجو</label>
                     <input type="file" name="image" class="form-control">
                    </div>
                    <div class="form-group text-center mt-2">
                        <button id="modal-blockui" type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

