@extends('gehat.layouts.app')

@push('title','البرامج')

@push('styles')
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <!-- DataTables -->
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    @if(!empty($programs) && count($programs) > 0)
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18"> {{ $programs[0]->goal->goal }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);"> {{ $programs[0]->goal->goal }} </a></li>
                        <li class="breadcrumb-item active">الأهداف</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <button type="button" class="btn btn-primary waves-effect waves-light"
                                data-bs-toggle="modal" data-bs-target="#create-new-category">
                            <i class="bx bx-add-to-queue font-size-16 align-middle me-2"></i>أضافه برنامج جديد
                        </button>
                    </div>
                    <div class="table-responsive">
                    <table id="datatable" class="table table-bordered  text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>البرنامج</th>
                            <th>عدد المؤشرات </th>
                            <th>المضاف بواسطه</th>
                            <th>التحكم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($programs  as $program)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td style="text-align: right"><a href="{{route('gehat.moksherat.show' , $program->id )}}"> {{ $program->program }} </a> </td>
                                <td> <span class="badge badge-pill badge-soft-primary font-size-12">{{ $program->moksherat_count}}</span> </td>
                                <td>  @if( $program->addedBy == 0 ) الأداره@else {{ $program->addedBy_fun->geha }} @endif  </td>

                                <td>
                                    @if($program->addedBy == \Illuminate\Support\Facades\Auth::user()->id )
                                    <div class="btn-group">
                                        <a href="javascript:void(0);" data-category-id="{{ $program->id }}"
                                           class="text-muted font-size-20 edit"><i class="bx bxs-edit"></i></a>
                                        <form action="{{ route('gehat.programs.destroy', $program->id) }}"
                                              method="POST">@csrf @method('delete')
                                            <a class="text-muted font-size-20 confirm-delete"><i
                                                    class="bx bx-trash"></i></a>
                                        </form>
                                    </div>
                                    @else
                                        <span class="badge badge-soft-danger">غير مصرح بالتعديل والحذف </span>
                                    @endif
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
    </div>

    @include('gehat.programs.modals.store-modal')
    @include('gehat.programs.modals.edit-modal')
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

    @include('gehat.programs.scripts.store')
    @include('gehat.programs.scripts.delete')
    @include('gehat.programs.scripts.edit')
@endpush
