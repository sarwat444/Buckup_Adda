@extends('admins.layouts.app')
@push('title',__('admin-dashboard.edit course'))

@push('styles')
    <link href="{{asset('/assets/admin/libs/select2/css/select2.min.css')}}" rel="stylesheet"
          type="text/css"/>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="update-course-from" action="{{route('dashboard.courses.update',$course->id)}}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="title" class="form-label">{{__('admin-dashboard.Course Title')}}:</label>
                                    <input type="text" name="title" value="{{$course->title}}"
                                           placeholder="{{__('admin-dashboard.Course Title')}}" class="form-control"
                                           id="title" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="url" class="form-label">{{__('admin-dashboard.Course Url')}}</label>
                                    <input type="text" name="url" placeholder="{{__('admin-dashboard.Course Url')}}" class="form-control"
                                           id="url"  value="{{$course->title}}" required>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="category_id" class="form-label">{{__('admin-dashboard.Course Instructor')}}</label>
                                    <select name="instructor_id" id="instructor_id" class="form-control select2" required>
                                        <option disabled selected>Select Instructor</option>
                                        @foreach($instructors as $instructor)
                                            @if(!empty($instructor->user))
                                                <option value="{{$instructor->user->id}}"  @if($course->instructor_id == $instructor->user->id ) selected  @endif>{{$instructor->user->first_name}} {{$instructor->user->last_name}} </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">{{__('admin-dashboard.Course Category')}}</label>
                                        <select name="category_id" id="category_id" class="form-control select2" required>
                                            <option disabled selected>{{__('admin-dashboard.select category')}}</option>
                                            @foreach($categories as $category)
                                                <option
                                                    value="{{$category->id}}" {{($course->category_id === $category->id) ? 'selected' : '' }}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="level" class="form-label">{{__('admin-dashboard.Course Level')}}</label>
                                        <select name="level" id="level" class="form-control select2" required>
                                            <option disabled selected>{{__('admin-dashboard.select level')}}</option>
                                            @foreach(\App\Enums\CourseLevel::cases() as $level)
                                                <option
                                                    value="{{$level->value}}" {{($course->level === $level->value) ? 'selected' : ''}}>{{$level->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="tags" class="form-label">Tags</label>
                                        <input type="text" name="tags" id="tags" class="form-control" placeholder="Tags" value="{{$course->tags}}" required>
                                    </div>
                                </div>

                           </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="price" class="form-label">{{__('admin-dashboard.Course Price')}}:</label>
                                    <input type="number" value="{{$course->price}}" name="price"
                                           placeholder="{{__('admin-dashboard.Course Price')}}"
                                           class="form-control"
                                           id="price" {{$course->isFree() ? 'disabled' : ''}}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="old_price" class="form-label">{{__('admin-dashboard.Course oldPrice')}}:</label>
                                    <input type="number" value="{{$course->old_price}}" name="old_price"
                                           placeholder="{{__('admin-dashboard.Course oldPrice')}}"
                                           class="form-control"
                                           id="old_price" {{$course->isFree() ? 'disabled' : ''}}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <p class="form-label mb-2">{{__('admin-dashboard.Is Top')}}:</p>
                                            <input type="checkbox" value="1" name="is_top" id="is_top"
                                                   switch="none" {{ ($course->IsTop()) ? 'checked' : ''}}/>
                                            <label for="is_top" data-on-label="{{__('admin-dashboard.yes')}}" data-off-label="{{__('admin-dashboard.no')}}"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <p class="form-label mb-2">{{__('admin-dashboard.Is Active')}}:</p>
                                            <input type="checkbox" value="1" name="is_active" id="is_active"
                                                   switch="none" {{ ($course->IsActive()) ? 'checked' : ''}}/>
                                            <label for="is_active" data-on-label="{{__('admin-dashboard.yes')}}" data-off-label="{{__('admin-dashboard.no')}}"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <p class="form-label mb-2">{{__('admin-dashboard.Is Free')}}:</p>
                                            <input type="checkbox" value="1" name="is_free" id="is_free"
                                                   switch="none" {{ ($course->IsFree()) ? 'checked' : ''}}/>
                                            <label for="is_free" data-on-label="{{__('admin-dashboard.yes')}}" data-off-label="{{__('admin-dashboard.no')}}"></label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="description" class="form-label">{{__('admin-dashboard.Course Description')}}:</label>
                                    <textarea name="description" rows="5" placeholder="{{__('admin-dashboard.Course Description')}}"
                                              class="form-control"
                                              id="description" required>{{$course->description}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Thumbnail</label>
                                            <input type="file" name="image" id="image" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3 mt-4">
                                            <img src="{{$course->getFirstMediaUrl('courses')}}"  class="img-thumbnail" alt="course image"
                                                 width="100px">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Cover</label>
                                            <input type="file" name="cover" id="cover" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3 mt-4">
                                            <img src="{{$course->getFirstMediaUrl('courses')}}"  class="img-thumbnail" alt="course image"
                                                 width="100px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="seo" class="form-label">Seo - meta Tags  </label>
                                    <input type="text" name="seo" id="seo" class="form-control" placeholder="Seo Meta Tags " value="{{$course->seo}}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="video_type" class="form-label">Demo  Video  - Optional </label>
                                    <select class="form-control" name="video_type"  id="video_type">
                                        <option selected disabled> Select Demo  Type </option>
                                        <option value="1" @if($course->video_type == 1 ) selected @endif> You Tube  </option>
                                        <option value="2" @if($course->video_type == 2 ) selected @endif> Vimeo  </option>
                                        <option value="3" @if($course->video_type == 3 ) selected @endif> External Link   </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="path" class="form-label">Path</label>
                                    <input type="text" name="path" id="path"value="{{$course->path}}" class="form-control" placeholder="Path Url" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 text-center">
                            <div class="spinner-border text-primary m-1 d-none" role="status"><span
                                    class="sr-only"></span></div>
                        </div>
                            <button type="submit" id="submit-button" class="btn btn-success w-md">{{__('admin-dashboard.update')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <button type="button" class="btn btn-primary waves-effect waves-light section2-btn"
                                data-bs-toggle="modal" data-bs-target="#create-new-section">
                            <i class="fa fa-plus"> </i>{{__('admin-dashboard.New Section')}}
                        </button>
                    </div>
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th colspan="2" class="text-center">{{__('admin-dashboard.Course Sections')}}</th>
                        </tr>
                        @forelse($course->sections as $section)
                            <tr>
                                <th colspan="2">
                                    <ul>
                                        <li> <i class="fa fa-angle-right"></i> {{$section->name}}</li>
                                    </ul>
                                </th>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">{{__('admin-dashboard.No Sections')}}</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('admins.courses.modals.create-new-section')
    @include('admins.courses.modals.create-new-lesson')
@endsection

@push('scripts')
    <script src="{{asset('/assets/admin/libs/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('/assets/admin/js/pages/form-advanced.init.js')}}"></script>
    @include('admins.courses.scripts.create-lesson-redirection')
    @include('admins.courses.scripts.detect-input-change')
    @include('admins.courses.scripts.create-new-section')
    @include('admins.courses.scripts.course-sections')
    @include('admins.courses.scripts.update')
@endpush
