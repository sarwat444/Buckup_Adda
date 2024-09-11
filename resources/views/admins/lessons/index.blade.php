@extends('admins.layouts.app')

@push('title',__('admin-dashboard.Lessons'))

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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <a href="{{route('dashboard.lessons.create',['type' => 'document'])}}"
                           class="btn btn-primary waves-effect waves-light">
                            <i class="bx bx-add-to-queue font-size-16 align-middle me-2"></i>{{__('admin-dashboard.New Lesson Document')}}
                        </a>
                        <a href="{{route('dashboard.lessons.create',['type' => 'video'])}}"
                           class="btn btn-primary waves-effect waves-light">
                            <i class="bx bx-add-to-queue font-size-16 align-middle me-2"></i>{{__('admin-dashboard.New Lesson Video')}}
                        </a>
                    </div>
                    <table id="lessons-datatable" class="table table-bordered dt-responsive  nowrap w-100 text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('admin-dashboard.Lesson Title')}}</th>
                            <th>{{__('admin-dashboard.Course Name')}}</th>
                            <th>{{__('admin-dashboard.Section Name')}}</th>
                            <th>{{__('admin-dashboard.Type')}}</th>
                            <th>{{__('admin-dashboard.Provider')}}</th>
                            <th>{{__('admin-dashboard.Free')}}</th>
                            <th>{{__('admin-dashboard.Publish')}}</th>
                            <th>{{__('admin-dashboard.Actions')}}</th>
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
    @include('admins.lessons.scripts.datatable')
    @include('admins.lessons.scripts.delete')
@endpush
