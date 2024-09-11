@extends('admins.layouts.app')

@push('title','المؤشرات')

@push('styles')
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- DataTables -->
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>

    <style>
        .select2-container--bootstrap4.select2-dropdown--below {
            z-index: 1051; /* Adjust the z-index as needed */
        }
    </style>
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18"> {{ $program->program }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"> {{ $program->program }}</a></li>
                    <li class="breadcrumb-item active">  البرامج  </li>
                </ol>
            </div>

        </div>
    </div>
</div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <button type="button" class="btn btn-primary waves-effect waves-light"
                                data-bs-toggle="modal" data-bs-target="#create-new-category">
                            <i class="bx bx-add-to-queue font-size-16 align-middle me-2"></i>أضافه مؤشر جديد
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>المؤشر</th>
                                <th> نوع المؤشر</th>
                                <th>  مضاف بواسطه</th>
                                <th>مدخلات المؤشر</th>
                                <th>التحكم</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($mokashert  as $mokasher)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td style="text-align: right">{{ $mokasher->name }} </td>
                                    <td style="text-align: right">
                                       @if(!empty($mokasher->type))
                                           @php
                                           $types = json_decode($mokasher->type) ;
                                           @endphp
                                           @foreach ($types as $type)
                                                  @if($type == 0)
                                                    <span class="badge badge-soft-primary font-size-13 mb-1"> وزاره </span>
                                                   @elseif($type == 1)
                                                    <span class="badge badge-soft-primary font-size-13 mb-1"> جامعه </span>
                                                    @elseif($type == 2)
                                                    <span class="badge badge-soft-primary font-size-13 mb-1"> كليه </span>
                                                    @elseif($type == 3)
                                                    <span class="badge badge-soft-primary font-size-13 mb-1"> الكل </span>
                                                  @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td style="text-align: right">

                                        {{ $mokasher->addedBy_fun->geha   ?? 'الأداره'}}

                                    </td>
                                    <td><a  class="btn btn-success btn btn-sm font-size-12" href="{{ route('dashboard.moksherat.mokaseerinput', $mokasher->id) }}"> مدخلات المؤشر </a></td>
                                    <td>
                                        <div class="btn-group">

                                            <a  href="{{route('dashboard.moksherat.edit' ,$mokasher->id )}}" data-category-id="{{ $mokasher->id }}" class="text-muted font-size-20 "><i class="bx bxs-edit"></i></a>
                                            <form action="{{ route('dashboard.moksherat.destroy', $mokasher->id) }}"
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
    </div>
    @include('admins.moksherat.modals.store-modal')
    @include('admins.moksherat.modals.edit-modal')
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
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/select2/js/select2.min.js')}}"></script>

    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/form-advanced.init.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                dropdownParent: $('#create-new-category') // Adjust selector based on your modal's ID
            });
        });
    </script>

    @include('admins.moksherat.scripts.store')
    @include('admins.moksherat.scripts.delete')
    @include('admins.moksherat.scripts.edit')
@endpush
