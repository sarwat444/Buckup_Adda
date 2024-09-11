@extends('admins.layouts.app')
@push('title','create video course')

@push('styles')
    <link href="{{asset('/assets/admin/libs/select2/css/select2.min.css')}}" rel="stylesheet"
          type="text/css"/>
@endpush

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">upload new video course</h4>
                    <div id="upload-form-content">
                        <form id="prepare-upload-video-course" action="{{route('dashboard.courses.video.upload',$course->id)}}"
                              method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="folder_id" class="form-label">Video Folder</label>
                                        <select name="folder_id" class="form-control select2" required>
                                            <option disabled selected>select folder</option>
                                            @foreach($folders as $folder)
                                                <option value="{{$folder->id}}">{{$folder->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="video_name" class="form-label">Video Name:</label>
                                        <input type="text" name="video_name" placeholder="lesson video name"
                                               class="form-control"
                                               id="video_name" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="video_description" class="form-label">Video Description:</label>
                                        <textarea name="video_description" placeholder="lesson video description"
                                                  class="form-control"
                                                  id="video_description" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="video" class="form-label">Course Video File:</label>
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
                                <button type="submit" id="submit-button" class="btn btn-primary w-md">upload</button>
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
    @include('admins.courses.video.scripts.store-video')
    @include('admins.courses.video.scripts.upload-tus-video-course')
@endpush
