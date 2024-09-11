@extends('admins.layouts.app')
@push('title',__('admin-dashboard.create course'))

@push('styles')
    <link href="{{asset('/assets/admin/libs/select2/css/select2.min.css')}}" rel="stylesheet"
          type="text/css"/>
@endpush

@section('content')
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Choose Course  Type</h4>
                    <label for="category_id" class="form-label">{{__('admin-dashboard.Course Type')}} <span class="text-danger">*</span> </label>
                    <select name="category_id" id="category_id" class="form-control select2" required>
                        <option disabled selected>Course Type</option>
                            <option value="0">Public Course </option>
                            <option value="1">Custom Course </option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">{{__('admin-dashboard.create new course')}}</h4>
                    <form id="store-course-from" class="repeater" action="{{route('dashboard.courses.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="title" class="form-label">{{__('admin-dashboard.Course Title')}}</label>
                                    <input type="text" name="title" placeholder="{{__('admin-dashboard.Course Title')}}" class="form-control"
                                           id="title" required>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="url" class="form-label">{{__('admin-dashboard.Course Url')}}</label>
                                    <input type="text" name="url" placeholder="{{__('admin-dashboard.Course Url')}}" class="form-control"
                                           id="url" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="category_id" class="form-label">{{__('admin-dashboard.Course Instructor')}}</label>
                                    <select name="instructor_id" id="instructor_id" class="form-control select2" required>
                                        <option disabled selected>Select Instructor</option>
                                                 @foreach($instructors as $instructor)
                                                        @if(!empty($instructor->user))
                                                                    <option value="{{$instructor->user->id}}">{{$instructor->user->first_name}} {{$instructor->user->last_name}} </option>
                                                        @endif
                                                @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="category_id" class="form-label">{{__('admin-dashboard.Course Category')}}</label>
                                    <select name="category_id" id="category_id" class="form-control select2" required>
                                        <option disabled selected>{{__('admin-dashboard.select category')}}</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
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
                                            <option value="{{$level->value}}">{{$level->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="tags" class="form-label">Tags</label>
                                    <input type="text" name="tags" id="tags" class="form-control" placeholder="Tags" required>
                                </div>
                            </div>


                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="price" class="form-label">{{__('admin-dashboard.Course Price')}}</label>
                                    <input type="number" value="0" name="price" placeholder="{{__('admin-dashboard.Course Price')}}"
                                           class="form-control"
                                           id="price">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="old_price" class="form-label">{{__('admin-dashboard.Course oldPrice')}}</label>
                                    <input type="number" value="0" name="old_price" placeholder="{{__('admin-dashboard.Course oldPrice')}}"
                                           class="form-control"
                                           id="old_price">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <p class="form-label mb-2">{{__('admin-dashboard.Is Free')}}</p>
                                            <input type="checkbox" value="1" name="is_free" id="is_free" switch="none"/>
                                            <label for="is_free" data-on-label="{{__('admin-dashboard.yes')}}" data-off-label="{{__('admin-dashboard.no')}}"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <p class="form-label mb-2">{{__('admin-dashboard.Is Top')}}</p>
                                            <input type="checkbox" value="1" name="is_top" id="is_top" switch="none"/>
                                            <label for="is_top" data-on-label="{{__('admin-dashboard.yes')}}" data-off-label="{{__('admin-dashboard.no')}}"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <p class="form-label mb-2">{{__('admin-dashboard.Is Active')}}</p>
                                            <input type="checkbox" value="1" name="is_active" id="is_active" switch="none"/>
                                            <label for="is_active" data-on-label="{{__('admin-dashboard.yes')}}" data-off-label="{{__('admin-dashboard.no')}}"></label>
                                        </div>
                                    </div>
                                </div>
                         </div>

                        </div>


                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="description" class="form-label">{{__('admin-dashboard.Course Description')}}</label>
                                    <textarea name="description" placeholder="{{__('admin-dashboard.Course Description')}}" class="form-control"
                                              id="description" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="image" class="form-label">Thumbnail</label>
                                    <input type="file" name="image" id="image" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="image" class="form-label">Cover Image </label>
                                    <input type="file" name="cover" id="cover" class="form-control" required>
                                </div>
                            </div>
                        </div>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                                <label for="seo" class="form-label">Seo - meta Tags  </label>
                                                <input type="text" name="seo" id="seo" class="form-control" placeholder="Seo Meta Tags " required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="video_type" class="form-label">Demo  Video  - Optional </label>
                                            <select class="form-control" name="video_type"  id="video_type">
                                                <option selected disabled> Select Demo  Type </option>
                                                <option value="1"> You Tube  </option>
                                                <option value="2"> Vimeo  </option>
                                                <option value="3"> External Link   </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="path" class="form-label">Path</label>
                                            <input type="text" name="path" id="path" class="form-control" placeholder="Path Url" required>
                                        </div>
                                    </div>
                                </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div data-repeater-list="course_prerequisites">
                                        <div data-repeater-item class="row">
                                            <div class="mb-3 col-lg-10">
                                                <label>{{__('admin-dashboard.Course Prerequisite')}}</label>
                                                <input type="text" name="course_prerequisites"
                                                       class="form-control"
                                                       placeholder="{{__('admin-dashboard.enter one point course prerequisite')}}"/>
                                            </div>
                                            <div class="col-lg-2 align-self-center">
                                                <div class="d-grid">
                                                    <input data-repeater-delete type="button" class="btn btn-primary"
                                                           value="{{__('admin-dashboard.Delete')}}"/>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <input data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0"
                                           value="{{__('admin-dashboard.Add prerequisite')}}"/>
                                </div>
                            </div>


                        </div>
                        <div class="mb-2 text-center">
                            <div class="spinner-border text-primary m-1 d-none" role="status"><span
                                    class="sr-only"></span></div>
                        </div>
                        <div>
                            <button type="submit" id="submit-button" class="btn btn-primary w-md btn-lg">{{__('admin-dashboard.create')}} Course </button>
                        </div>
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
    <script src="{{asset('/assets/admin/libs/jquery.repeater/jquery.repeater.min.js')}}"></script>
    <script src="{{asset('/assets/admin/js/pages/form-repeater.int.js')}}"></script>
    @include('admins.courses.scripts.detect-input-change')
    @include('admins.courses.scripts.store')
@endpush
