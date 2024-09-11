@extends('admins.layouts.app')
@push('title','مديري النظام')
@push('styles')
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link
        href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
        rel="stylesheet" type="text/css"/>
@endpush

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">مديري النظام</div>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <a href="{{route('dashboard.admins.create')}}"
                           class="btn btn-primary waves-effect waves-light">
                            <i class="bx bx-add-to-queue font-size-16 align-middle me-2"></i>أضافه مدير جديد
                        </a>
                    </div>
                    <table id="students-datatable" class="table table-bordered dt-responsive  nowrap w-100 table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الخطه</th>
                            <th>الأيميل</th>
                            <th>التحكم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $admin)
                            @if(!empty($admin->kheta))
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$admin->kheta->name}}</td>
                                <td>{{$admin->email}}</td>
                                <td>
                                    @if(auth()->user()->id != $admin->id)
                                    <div class="btn-group">
                                        <a href="{{ route('dashboard.admins.edit', $admin->id) }}" data-category-id="{{ $admin->id }}"
                                           class="text-muted font-size-20"><i class="bx bxs-edit"></i></a>
                                        <form action="{{ route('dashboard.admins.destroy') }}" method="POST">
                                             @csrf
                                            <input type="hidden" name="admin_id" value="{{$admin->id}}">
                                            <a class="text-muted font-size-20 confirm-delete"><i class="bx bx-trash"></i></a>
                                        </form>
                                    </div>
                                        @else
                                        <span class="badge badge-soft-danger">عير مسموح </span>
                                    @endif
                                </td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/sweet-alerts.init.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script
        src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script
        src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script
        src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    @include('admins.users.geaht.scripts.delete')
@endpush
