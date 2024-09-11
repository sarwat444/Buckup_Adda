<div class="btn-group">
    <a href="{{route('dashboard.courses.show',$course->id)}}" class="text-muted font-size-20 edit"><i
            class="bx bxs-show"></i></a>
    <a href="{{route('dashboard.courses.edit',$course->id)}}" class="text-muted font-size-20 edit"><i
            class="bx bxs-edit"></i></a>
    <form action="{{ route('dashboard.sections.destroy', $course->id) }}" method="POST">@csrf @method('delete')
        <a class="text-muted font-size-20 confirm-delete"><i class="bx bx-trash"></i></a>
    </form>
</div>
