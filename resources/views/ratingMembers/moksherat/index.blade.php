@extends('ratingMembers.layouts.app')

@push('title','المؤشرات')

@push('styles')
    <link href="{{asset('/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- DataTables -->
    <link href="{{asset('/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{asset('/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

@endpush
@section('content')

    @php
        $selectedYear = config('app.selected_year');
    @endphp

    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">المؤشرات - {{ Auth::user()->geha }} </h4>

        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">المؤشرات</a></li>
                <li class="breadcrumb-item active">الرئيسيه</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>المؤشر</th>
                            <th> نوع المؤشر</th>
                            <th>المضاف بواسطه</th>
                            <th>مدخلات المؤشر </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($mokashert  as $mokasher)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td style="text-align: right">{{ $mokasher->name }} </td>
                                <td style="text-align: right">    @if(!empty($mokasher->type))
                                        @php
                                            $types = json_decode($mokasher->type) ;
                                        @endphp
                                        @foreach ($types as $type)
                                            @if($type == 0)
                                                <span class="badge badge-soft-primary font-size-13"> وزاره </span>
                                            @elseif($type == 1)
                                                <span class="badge badge-soft-primary font-size-13"> جامعه </span>
                                            @elseif($type == 2)
                                                <span class="badge badge-soft-primary font-size-13"> كليه </span>
                                            @elseif($type == 3)
                                                <span class="badge badge-soft-primary font-size-13"> الكل </span>
                                            @endif
                                        @endforeach
                                    @endif</td>
                                <td>  @if( $mokasher->addedBy == 0 ) الأداره@else {{ $mokasher->addedBy_fun->geha }} @endif  </td>

                                <td>
                                    @if(!empty($mokasher->mokasher_geha_inputs))
                                     <a  class="btn btn-primary btn btn-sm" href="{{ route('rating.ratinginput', $mokasher->id ) }}"> عرض المؤشر </a>
                                    @else
                                        <span class="text-danger"> توجيه المؤشر أولا</span>
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
@endsection
@push('scripts')
    <script src="{{asset('/assets/admin/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset('/assets/admin/js/pages/sweet-alerts.init.js')}}"></script>
    <!-- Required datatable js -->
    <script src="{{asset('/assets/admin/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Responsive examples -->
    <script src="{{asset('/assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('/assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <!-- Datatable init js -->
    <script src="{{asset('/assets/admin/js/pages/datatables.init.js')}}"></script>

@endpush
