@extends('admins.layouts.app')
@push('title',__('admin-dashboard.create video lesson'))

@push('styles')
    <link href="{{asset('/assets/admin/libs/select2/css/select2.min.css')}}" rel="stylesheet"
          type="text/css"/>
@endpush

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">{{__('admin-dashboard.create video lesson')}}</h4>
                    <div id="upload-form-content">
                        <form id="store-lesson-video" action="{{route('dashboard.lessons.store.video')}}"
                              method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">{{__('admin-dashboard.Lesson Title')}}</label>
                                        <input type="text" name="title" placeholder="{{__('admin-dashboard.Lesson Title')}}" class="form-control"
                                               id="title" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="course_id" class="form-label">{{__('admin-dashboard.Lesson Course')}}</label>
                                        <select name="course_id" class="form-control select2 course" required>
                                            <option disabled selected>{{__('admin-dashboard.select course')}}</option>
                                            @foreach($courses as $course)
                                                <option value="{{$course->id}}" {{request()->input('course_id') == $course->id ? 'selected' : ''}}>{{$course->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="section_id" class="form-label">{{__('admin-dashboard.Lesson Section')}}</label>
                                        <select name="section_id" class="form-control sections select2" required>
                                            <option disabled selected>{{__('admin-dashboard.select section')}}</option>
                                            @if(request()->input('section_id'))
                                                <option value="{{request()->input('section_id')}}" selected>{{request()->input('section_name')}}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="type" class="form-label">{{__('admin-dashboard.Lesson Type')}}</label>
                                        <select name="type" class="form-control select2" required>
                                            <option disabled>{{__('admin-dashboard.select type')}}</option>
                                            <option
                                                value="{{\App\Enums\LessonType::video->value}}" selected>{{\App\Enums\LessonType::video->name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="provider" class="form-label">{{__('admin-dashboard.Lesson Provider')}}</label>
                                        <select name="provider" class="form-control select2" required>
                                            <option disabled>{{__('admin-dashboard.select provider')}}</option>
                                            <option
                                                value="{{\App\Enums\LessonProvider::vimeo->value}}" selected>{{\App\Enums\LessonProvider::vimeo->name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <p class="form-label mb-2">{{__('admin-dashboard.Free')}}</p>
                                        <input type="checkbox" value="1" name="is_free" id="is_free" switch="none"/>
                                        <label for="is_free" data-on-label="{{__('admin-dashboard.yes')}}" data-off-label="{{__('admin-dashboard.no')}}"></label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <p class="form-label mb-2">{{__('admin-dashboard.Publish')}}</p>
                                        <input type="checkbox" value="1" name="is_publish" id="is_publish" switch="none"/>
                                        <label for="is_publish" data-on-label="{{__('admin-dashboard.yes')}}" data-off-label="{{__('admin-dashboard.no')}}"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="video" class="form-label">{{__('admin-dashboard.Lesson Video File')}}</label>
                                        <input type="file" name="video" class="form-control"
                                               id="video" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2 text-center">
                                <div class="spinner-border text-primary m-1 d-none" role="status"><span
                                        class="sr-only"></span></div>
                            </div>

                            <div class="text-center">
                                <button type="submit" id="submit-button" class="btn btn-primary w-md">{{__('admin-dashboard.create')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('/assets/tus/tus.min.js')}}"></script>
    <script src="{{asset('/assets/admin/libs/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('/assets/admin/js/pages/form-advanced.init.js')}}"></script>
    @include('admins.lessons.scripts.upload-tus-video-lesson')
    @include('admins.lessons.scripts.course-sections')
    @include('admins.lessons.scripts.store-video')
@endpush
