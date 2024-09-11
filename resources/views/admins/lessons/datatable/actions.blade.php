<div class="btn-group">
    <a href="{{ route('dashboard.lessons.edit',$lesson->id)}}"
       class="text-muted font-size-20"><i
            class="bx bxs-edit"></i></a>
    <form
        action="{{ route('dashboard.lessons.destroy',$lesson->id)}}"
        method="POST">@csrf @method('delete')
        <a class="text-muted font-size-20 confirm-delete"><i class="bx bx-trash"></i></a>
    </form>
</div>
