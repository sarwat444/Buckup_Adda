<div class="btn-group">
    <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Actions
        <i class="mdi mdi-chevron-down"></i></button>
    <div class="dropdown-menu" style="">
        @if($instructorRequest->status === \App\Enums\InstructorRequestStatus::pending->value)
            <a class="dropdown-item change-order-status" data-request-id="{{$instructorRequest->id}}"
               data-status="{{\App\Enums\InstructorRequestStatus::accepted->value}}">Accepted</a>
            <a class="dropdown-item change-order-status" data-request-id="{{$instructorRequest->id}}"
               data-status="{{\App\Enums\InstructorRequestStatus::rejected->value}}">Rejected</a>
        @elseif($instructorRequest->status === \App\Enums\InstructorRequestStatus::accepted->value || $instructorRequest->status === \App\Enums\InstructorRequestStatus::rejected->value)
            <a class="dropdown-item">can`t change request status</a>
        @endif
    </div>
</div>
