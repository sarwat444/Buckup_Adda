@extends('admins.layouts.app')

@push('title',__('admin-dashboard.Instructors Requests'))

@push('styles')
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
                    <table id="instructors-datatable"
                           class="table table-bordered dt-responsive  nowrap w-100 text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('admin-dashboard.First Name')}}</th>
                            <th>{{__('admin-dashboard.Last Name')}}</th>
                            <th>{{__('admin-dashboard.Instructor Email')}}</th>
                            <th>{{__('admin-dashboard.message')}}</th>
                            <th>{{__('admin-dashboard.attachment')}}</th>
                            <th>{{__('admin-dashboard.Request Status')}}</th>
                            <th>{{__('admin-dashboard.Requested At')}}</th>
                            <th>{{__('admin-dashboard.Actions')}}</th>
                            <th>{{__('admin-dashboard.Details')}} </th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{asset('/assets/admin/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script
        src="{{asset('/assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script
        src="{{asset('/assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script
        src="{{asset('/assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    @include('admins.instructors-requests.scripts.change-request-status')
    @include('admins.instructors-requests.scripts.datatable')
@endpush
