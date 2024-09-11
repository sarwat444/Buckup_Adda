<div class="btn-group">
    <form action="{{ route('dashboard.sections.destroy', $comment->id) }}" method="POST">@csrf @method('delete')
        <a class="text-muted font-size-20 confirm-delete"><i class="bx bx-trash"></i></a>
    </form>
</div>
