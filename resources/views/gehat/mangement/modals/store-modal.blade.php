<div class="modal fade" id="create-new-category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">أضافه أداره</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('gehat.mangements.store')}}" id="store-new-category">
                    @csrf
                    <input type="hidden" value="{{\Illuminate\Support\Facades\Auth::user()->id}}" name="top_mangement">

                    <div class="mb-2">
                        <label for="name" class="col-form-label">الأداره</label>
                        <input type="text" name="name" placeholder="الأداره" class="form-control" id="name" required>
                    </div>

                    <div class="mb-2">
                        <label for="geha_number" class="col-form-label">الرقم الوظيفى</label>
                        <input type="text" name="geha_number" placeholder="الرقم الوظيفى " class="form-control" id="geha_number" required>
                    </div>

                    <div class="mb-2">
                        <label for="password" class="col-form-label">الرقم السري </label>
                        <input type="text" name="password" placeholder="الرقم  السري" class="form-control" id="password" required>
                    </div>
                    
                    <div class="mb-2 text-center">
                        <div class="spinner-border text-primary m-1 d-none" role="status"><span class="sr-only"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">حفظ</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">تجاهل</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
