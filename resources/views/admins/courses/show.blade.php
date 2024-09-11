@extends('admins.layouts.app')

@push('title',__('admin-dashboard.Course Details'))

@push('styles')
    <link href="{{asset('/assets/admin/libs/dragula/dragula.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link
        href="{{asset('/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
        rel="stylesheet" type="text/css"/>
@endpush

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="product-detai-imgs">
                                <div class="row">
                                    <div class="col-md-7 offset-md-1 col-sm-9 col-8">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade show active" id="product-1" role="tabpanel"
                                                 aria-labelledby="product-1-tab">
                                                <div class="image-responsive-spatie">
                                                    {{$course->getFirstMedia('courses')}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7 offset-md-1 col-sm-9 col-8 mt-2">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade show active" id="product-1" role="tabpanel"
                                                 aria-labelledby="product-1-tab">
                                                @if($course->has_video)
                                                    <div class="vimeo-video">
                                                        {!!  $course->video->embed !!}
                                                    </div>
                                                    <div class="text-center">
                                                        <form id="delete-course-video"
                                                              action="{{route('dashboard.courses.video.delete',$course->id)}}"
                                                              method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="btn btn-danger waves-effect waves-light mt-2 me-1">
                                                                <i class="bx bx-trash me-2"></i>{{__('admin-dashboard.Delete Video')}}
                                                            </button>
                                                        </form>

                                                    </div>
                                                @else
                                                    <div class="alert alert-danger alert-dismissible fade show"
                                                         role="alert">
                                                        <a href="{{route('dashboard.courses.video',$course->id)}}"
                                                           class="text-danger">
                                                            {{__('admin-dashboard.his course has no video click here to add video')}}
                                                            t</a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="mt-4 mt-xl-3">
                                <a href="javascript: void(0);" class="text-primary">{{$course->title}}</a>
                                <h4 class="mt-1 mb-3">{{$course->name}}</h4>

                                <p class="text-muted float-start me-3">
                                    @for($i=1;$i<=5;$i++)
                                        <i class="bx bxs-star {{ $i <= $course->rates_avg_rate ? 'text-warning' : '' }}"></i>
                                    @endfor
                                </p>
                                <p class="text-muted mb-4">( {{$course->rates_count}} {{__('admin-dashboard.geaht Review')}} )</p>
                                @if(!$course->isFree())
                                    <h5 class="mb-4">{{__('admin-dashboard.Price')}} : <span class="text-muted me-2"><del>{{$course->old_price}}</del></span>
                                        <b>{{$course->price}}</b></h5>
                                @else
                                    <h5 class="mb-4">{{__('admin-dashboard.Price')}} : <span
                                            class="badge bg-soft-success text-success">{{__('admin-dashboard.Free')}}</span></h5>
                                @endif
                                <p class="text-muted mb-4">{{$course->description}}</p>
                                <div class="row mb-3">
                                    <p class="text-muted mb-4">{{__('admin-dashboard.Course Prerequisite')}}</p>
                                    <div class="col-md-12">
                                        <div>
                                            <ul class="list-unstyled">
                                                @forelse($course->prerequisites as $prerequisite)
                                                    <li class="mb-2">
                                                        <i class="mdi mdi-checkbox-blank-circle text-primary me-1"></i>
                                                        {{$prerequisite->course_prerequisites}}
                                                    </li>
                                                @empty
                                                    <li class="mb-2">
                                                        <i class="mdi mdi-checkbox-blank-circle text-primary me-1"></i>
                                                        {{__('admin-dashboard.No Prerequisites')}}
                                                    </li>
                                                @endforelse
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end row -->

                    <div class="mt-5">
                        <h5 class="mb-3">{{__('admin-dashboard.Some information about this course')}} :</h5>

                        <div class="table-responsive">
                            <table class="table mb-0 table-bordered">
                                <tbody>
                                <tr>
                                    <th scope="row" style="width: 400px;">{{__('admin-dashboard.Category')}}</th>
                                    <td>{{$course->category->name}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{__('admin-dashboard.Instructor')}}</th>
                                    <td>{{$course->user?->full_name}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{__('admin-dashboard.Is Free')}}</th>
                                    <td>{{$course->isFree() ? 'yes' : 'no'}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{__('admin-dashboard.Is Active')}}</th>
                                    <td>{{$course->isActive() ? 'yes' : 'no'}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{__('admin-dashboard.Is Top')}}</th>
                                    <td>{{$course->isTop() ? 'yes' : 'no'}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{__('admin-dashboard.level')}}</th>
                                    <td>{{\App\Enums\CourseLevel::tryFrom($course->level)->name}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{__('admin-dashboard.enrollments count')}}</th>
                                    <td>{{$course->enrollments_count}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{__('admin-dashboard.created at')}}</th>
                                    <td>{{$course->created_at->format('Y-m-d')}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{__('admin-dashboard.last update')}}</th>
                                    <td>{{$course->updated_at->format('Y-m-d')}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-0">{{__('admin-dashboard.course sections')}}:</h4>
                    @forelse($course->sections as $section)
                        <div class="col-12">
                            <div class="mt-4">
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button fw-medium" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseOne{{$section->id}}"
                                                    aria-expanded="true" aria-controls="collapseOne{{$section->id}}">
                                                {{$section->name}}
                                            </button>
                                        </h2>
                                        <div id="collapseOne{{$section->id}}" class="accordion-collapse collapse"
                                             aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div>
                                                            <ul class="list-unstyled" data-section-id="{{$section->id}}"
                                                                id="section-lessons-dragula{{$section->id}}">
                                                                @forelse($section->lessons as $lesson)
                                                                    <li class="mb-2" data-lesson-id="{{$lesson->id}}">
                                                                        <i class="mdi mdi-checkbox-blank-circle text-primary me-1"></i>
                                                                        {{$lesson->title}}

                                                                        <ul class="list-inline float-sm-end mb-sm-0 mt-2">
                                                                            <li class="list-inline-item">
                                                                                <a href="{{route('dashboard.lessons.likes',$lesson->id)}}"
                                                                                   target="_blank"><i
                                                                                        class="far fa-thumbs-up me-1"></i> {{$lesson->likes_count}}
                                                                                </a>
                                                                            </li>
                                                                            <li class="list-inline-item">
                                                                                <a href="{{route('dashboard.lessons.comments',$lesson->id)}}"
                                                                                   target="_blank"><i
                                                                                        class="far fa-comment-dots me-1"></i> {{$lesson->comments_count}}
                                                                                </a>
                                                                            </li>
                                                                            <li class="list-inline-item">
                                                                                <a href="{{route('dashboard.lessons.views',$lesson->id)}}"
                                                                                   target="_blank"><i
                                                                                        class="far fa-eye me-1"></i> {{$lesson->views_count}}
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                        @if($lesson->isFree())
                                                                            <span
                                                                                class="badge bg-soft-success text-success">free</span>
                                                                        @else
                                                                            <span
                                                                                class="badge bg-soft-warning text-warning">paid</span>
                                                                        @endif
                                                                        @if($lesson->isPublish())
                                                                            <span
                                                                                class="badge bg-soft-success text-success">published</span>
                                                                        @else
                                                                            <span
                                                                                class="badge bg-soft-danger text-danger">draft</span>
                                                                        @endif
                                                                        <div class="text-muted font-size-12"><i
                                                                                class="far fa-calendar-alt text-primary me-1"></i>{{$lesson->created_at->format('D-M-Y')}}
                                                                        </div>

                                                                    </li>
                                                                @empty
                                                                    <li class="mb-2">
                                                                        <i class="mdi mdi-checkbox-blank-circle text-primary me-1"></i>
                                                                        {{__('admin-dashboard.no lessons')}}
                                                                    </li>
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty

                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection



@push('scripts')
    <script src="{{asset('/assets/admin/libs/dragula/dragula.min.js')}}"></script>
    <script src="{{asset('/assets/admin/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset('/assets/admin/js/pages/sweet-alerts.init.js')}}"></script>

    <script src="{{asset('/assets/admin/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script
        src="{{asset('/assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script
        src="{{asset('/assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script
        src="{{asset('/assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    @include('admins.courses.scripts.update-section-lesson-ordering')
    @include('admins.courses.scripts.delete-course-video')
@endpush
