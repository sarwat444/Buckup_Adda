@extends('admins.layouts.app')

@push('title','Lesson Views')

@push('styles')
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

                        <div class="col-xl-5">
                            <div class="product-detai-imgs">
                                <div class="row">
                                    @if($lesson->isDocument())
                                        <div class="col-md-7 offset-md-1 col-sm-9 col-8">
                                            <div class="tab-content" id="v-pills-tabContent">
                                                <div class="tab-pane fade show active" id="product-1" role="tabpanel"
                                                     aria-labelledby="product-1-tab">
                                                    <div class="image-responsive-spatie">
                                                        <a href="{{$lesson->embed}}" target="_blank"><img
                                                                src="{{asset('/assets/admin/images/document/url-icon.png')}}"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($lesson->isVideo())
                                        <div class="col-md-7 offset-md-1 col-sm-9 col-8">
                                            <div class="tab-content" id="v-pills-tabContent">
                                                <div class="tab-pane fade show active" id="product-1" role="tabpanel"
                                                     aria-labelledby="product-1-tab">
                                                    <div class="vimeo-video">
                                                        {!!  $lesson->embed !!}
                                                    </div>
                                                    <div class="text-center">
                                                        <form id="delete-course-video"
                                                              action="{{route('dashboard.courses.video.delete',$lesson->id)}}"
                                                              method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="btn btn-danger waves-effect waves-light mt-2 me-1">
                                                                <i class="bx bx-trash me-2"></i> Delete Video
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-7">
                            <h5 class="mb-3">Lesson Information :</h5>
                            <div class="table-responsive">
                                <table class="table mb-0 table-bordered">
                                    <tbody>
                                    <tr>
                                        <th scope="row">Lesson Title</th>
                                        <td>{{$lesson->title}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Lesson Type</th>
                                        <td><span class="badge badge-soft-primary font-size-12">{{\App\Enums\LessonType::tryFrom($lesson->type)->name}}</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Lesson Provider</th>
                                        <td><span class="badge badge-soft-primary font-size-12">{{\App\Enums\LessonProvider::tryFrom($lesson->provider)->name}}</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Lesson Is Free</th>
                                        <td>{!! $lesson->isFree() ? '<span class="badge badge-soft-success font-size-12">yes</span>' : '<span class="badge badge-soft-danger font-size-12">no</span>'!!}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 400px;">Course Name</th>
                                        <td>{{$lesson->course->name}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Section Name</th>
                                        <td>{{$lesson->section->name}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Folder Name</th>
                                        <td>{{$lesson->folder->name}}</td>
                                    </tr>
                                    @if($lesson->isVideo())
                                        <tr>
                                            <th scope="row">video duration</th>
                                            <td>{{ hours_minutes_seconds($lesson->duration) }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">video status</th>
                                            <td>{{$lesson->status}}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th scope="row">created at</th>
                                        <td>{{$lesson->created_at->format('Y-m-d')}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">last update</th>
                                        <td>{{$lesson->updated_at->format('Y-m-d')}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Lesson Views:</h4>
                    <table id="lesson-views-datatable"
                           class="table table-bordered dt-responsive  nowrap w-100 text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>UserName</th>
                            <th>UserEmail</th>
                            <th>view Time</th>
                        </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{asset('/assets/admin/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset('/assets/admin/js/pages/sweet-alerts.init.js')}}"></script>
    <script src="{{asset('/assets/admin/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script
        src="{{asset('/assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script
        src="{{asset('/assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script
        src="{{asset('/assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    @include('admins.lessons.view.scripts.datatable')
@endpush
