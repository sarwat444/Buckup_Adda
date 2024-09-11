@extends('admins.layouts.app')

@push('title','Course Comments')

@push('styles')
    <link href="{{asset('/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link
        href="{{asset('/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
        rel="stylesheet" type="text/css"/>
@endpush

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div>
                <h5 class="mb-3">course comments :</h5>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="courses-comments" class="table table-bordered dt-responsive  nowrap w-100 text-center">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Course Comment</th>
                                        <th>User Name</th>
                                        <th>User Email</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>
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

    @include('admins.courses.comments.scripts.course-comments-datatable')
@endpush
