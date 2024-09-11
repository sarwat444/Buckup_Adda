@extends('admins.layouts.app')

@push('title','الجهات')
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
    <div class="card">
        <div class="card-body">
    <div class="print-report">
        <h3 class="mb-2 font-size-18  mb-4"> طباعه التقرير </h3>
        <form action="{{route('dashboard.print_users_report')}}" method="post">
            @csrf
                <div class="row">
                    <div class="col-md-4">
                        <input type="hidden" name="kheta_id" value="{{$kheta_id}}">
                        <label> من </label>
                        <input type="date" name="start" class="form-control" placeholder="البدايه">
                    </div>
                    <div class="col-md-4">
                        <label> الى </label>
                        <input type="date" name="end" class="form-control" placeholder="النهايه">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary mt-4"> طباعه التقرير<i class="bx bx-printer"></i> </button>
                    </div>
                </div>
        </form>
    </div>
    </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title"> الجهات</div>
                    <table id="students-datatable" class="table table-bordered dt-responsive  nowrap w-100 text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الرقم الوظيفى</th>
                            <th>الجهه</th>
                            <th>نشط   </th>
                            <th>أخر ظهور  </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$user->job_number}}</td>
                                <td>{{$user->geha}}</td>
                                <td>@if(\Illuminate\Support\Facades\Cache::has('user-is-online-'.$user->id))
                                        <span class="badge bg-success">نشظ</span>
                                    @else
                                        <span class="badge bg-danger">ليس نشظ</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($user->last_seen)->locale('ar')->diffForHumans() }}</td>
                            </tr>
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
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready(function (){
            $('#students-datatable').dataTable() ;
        });
    </script>
    @include('admins.users.geaht.scripts.delete')
@endpush
