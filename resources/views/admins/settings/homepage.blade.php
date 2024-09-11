@extends('admins.layouts.app')

@push('title',__('admin-dashboard.Homepage Courses Top Settings'))

@push('styles')@endpush


@section('content')

    <div class="row">
        @forelse($courses as $course)
            <div class="col-xl-3 col-sm-6">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="avatar-sm mx-auto mb-4">
                            <img src="{{ $course->getFirstMedia('courses')->getUrl('courses_thumb') }}"
                                 alt="course-thumb-image" class="img-fluid">
                        </div>
                        <p class="text-muted">{{$course->name}}</p>
                    </div>
                    <div class="card-footer bg-transparent border-top">
                        <div class="contact-links d-flex font-size-20">
                            <div class="flex-fill">
                                <div class="square-switch">
                                    <input type="checkbox" class="change-course-activity"
                                           data-course-id="{{$course->id}}" value="1" id="square-switch-{{$course->id}}"
                                           switch="none" {{($course->is_top === \App\Constant\CourseOptions::is_top)  ? 'checked' : ''}}>
                                    <label for="square-switch-{{$course->id}}" data-on-label="On"
                                           data-off-label="Off"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
        @endforelse

        <div class="col-12 text-center">
            {!! $courses->links() !!}
        </div>
    </div>

@endsection

@push('scripts')
   @include('admins.settings.scripts.change-course-activity')
@endpush
