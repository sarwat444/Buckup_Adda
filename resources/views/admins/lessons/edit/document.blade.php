@extends('admins.layouts.app')
@push('title',__('admin-dashboard.edit document lesson'))

@push('styles')
    <link href="{{asset('/assets/admin/libs/select2/css/select2.min.css')}}" rel="stylesheet"
          type="text/css"/>
@endpush

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">{{__('admin-dashboard.edit document lesson')}}</h4>
                    <form id="update-lesson-document" action="{{route('dashboard.lessons.update.document',$lesson->id)}}"
                          method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">{{__('admin-dashboard.Lesson Title')}}</label>
                                    <input type="text" name="title" value="{{$lesson->title}}" class="form-control"
                                           id="title" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="embed" class="form-label">{{__('admin-dashboard.Document Url')}}</label>
                                    <input type="url" name="embed" value="{{$lesson->embed}}" placeholder="{{__('admin-dashboard.Document Url')}}"
                                           class="form-control"
                                           id="embed" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="section_id" class="form-label">{{__('admin-dashboard.Lesson Section')}}</label>
                                    <select name="section_id" class="form-control select2" required>
                                        <option disabled>{{__('admin-dashboard.select section')}}</option>
                                        @foreach($sections as $section)
                                            <option value="{{$section->id}}" {{$lesson->section_id == $section->id ? 'selected' : ''}}>{{$section->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label for="type" class="form-label">{{__('admin-dashboard.Lesson Type')}}</label>
                                    <select name="type" class="form-control select2" required>
                                        <option disabled>{{__('admin-dashboard.select type')}}</option>
                                        <option
                                            value="{{\App\Enums\LessonType::document->value}}" selected>{{\App\Enums\LessonType::document->name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label for="provider" class="form-label">{{__('admin-dashboard.Lesson Provider')}}</label>
                                    <select name="provider" class="form-control select2" required>
                                        <option disabled>{{__('admin-dashboard.select provider')}}</option>
                                        <option
                                            value="{{\App\Enums\LessonProvider::url->value}}" selected>{{\App\Enums\LessonProvider::url->name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <p class="form-label mb-2">{{__('admin-dashboard.Free')}}</p>
                                    <input type="checkbox" value="1" name="is_free" id="is_free" switch="none" {{$lesson->isFree() ? 'checked' : ''}}/>
                                    <label for="is_free" data-on-label="{{__('admin-dashboard.yes')}}" data-off-label="{{__('admin-dashboard.no')}}"></label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <p class="form-label mb-2">{{__('admin-dashboard.Publish')}}</p>
                                    <input type="checkbox" value="1" name="is_publish" id="is_publish" switch="none" {{$lesson->isPublish() ? 'checked' : ''}}/>
                                    <label for="is_publish" data-on-label="{{__('admin-dashboard.yes')}}" data-off-label="{{__('admin-dashboard.no')}}"></label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-2 text-center">
                            <div class="spinner-border text-primary m-1 d-none" role="status"><span
                                    class="sr-only"></span></div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary w-md">{{__('admin-dashboard.update')}}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('/assets/admin/libs/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('/assets/admin/js/pages/form-advanced.init.js')}}"></script>
    @include('admins.lessons.scripts.edit-document')
@endpush
