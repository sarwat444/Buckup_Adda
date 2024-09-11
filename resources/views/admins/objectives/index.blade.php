@extends('admins.layouts.app')
@push('title','الغايات')
@push('styles')
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- DataTables -->
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ $kheta->name }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $kheta->name }}</a></li>
                        <li class="breadcrumb-item active">لوحه  التحكم </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex mb-4">
        <a href="{{route('dashboard.objectivesDashboard',$kheta->id)}}" class="btn btn-primary btn-sm" style="margin-left: 5px"> لوحه التحكم </a>
        <a href="{{route('dashboard.users.show',$kheta->id)}}" class="btn btn-success btn-sm" style="margin-left: 5px"> الجهات </a>
        <a href="{{route('dashboard.ratingMembers.show' ,$kheta->id )}}" class="btn btn-success btn-sm" style="margin-left: 5px">لجان التقييم</a>
        <a href="{{route('dashboard.mokasherat_gehat_report' ,$kheta->id )}}" class="btn btn-success btn-sm" style="margin-left: 5px"> تقرير أنجاز الجهات </a>
        <a href="{{route('dashboard.mokasherat_files_report' , $kheta->id )}}" class="btn btn-success btn-sm" style="margin-left: 5px">  تقرير متابعه الجهات </a>
        <a href="{{route('dashboard.Histogram_kheta_objectives_dashboard' , $kheta->id )}}" class="btn btn-success btn-sm" style="margin-left: 5px"> متابعه تطور  الأداء  </a>
        <a href="{{route('dashboard.active_users' , $kheta->id )}}" class="btn btn-success btn-sm" style="margin-left: 5px"> نشاط الجهات  </a>
        <a href="{{route('dashboard.mokasherat_wezara' , $kheta->id )}}" class="btn btn-success btn-sm" style="margin-left: 5px">  تقرير متابعه مؤشرات الوزاره  </a>
        <a href="{{route('dashboard.gehat_targets_report' ,$kheta->id )}}" class="btn btn-success btn-sm" style="margin-left: 5px"> تقرير مستهدف الجهات </a>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <button type="button" class="btn btn-primary waves-effect waves-light"
                                data-bs-toggle="modal" data-bs-target="#create-new-category">
                            <i class="bx bx-add-to-queue font-size-16 align-middle me-2"></i> أضافه غايه جديده
                        </button>
                    </div>
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الغايه</th>
                            <th>عدد الأهداف الاستراتيجيه</th>
                            <th>التحكم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($objectives  as $objective)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{route('dashboard.goals.show' ,$objective->id  )}}"> {{ $objective->objective }} </a> </td>
                                <td> <span class="badge badge-pill badge-soft-primary font-size-12">{{ $objective->goals_count }}</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="javascript:void(0);" data-category-id="{{ $objective->id }}"
                                           class="text-muted font-size-20 edit"><i class="bx bxs-edit"></i></a>
                                        <form action="{{ route('dashboard.objectives.destroy', $objective->id) }}"
                                              method="POST">@csrf @method('delete')
                                            <a class="text-muted font-size-20 confirm-delete"><i
                                                    class="bx bx-trash"></i></a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">لا يوجد بيانات بالجدول</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('admins.objectives.modals.store-modal')
    @include('admins.objectives.modals.edit-modal')
@endsection
@push('scripts')

    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/sweet-alerts.init.js')}}"></script>
    <!-- Required datatable js -->
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Responsive examples -->
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <!-- Datatable init js -->
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/datatables.init.js')}}"></script>

    @include('admins.objectives.scripts.store')
    @include('admins.objectives.scripts.delete')
    @include('admins.objectives.scripts.edit')
@endpush
