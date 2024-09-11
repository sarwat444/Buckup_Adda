@extends('admins.layouts.app')
@push('title','لجان التقييم')
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
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{$kheta->name}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{$kheta->name}}</a></li>
                        <li class="breadcrumb-item active">لجان التقييم </li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title"> لجان التقييم</div>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <a href="{{route('dashboard.CreateratingMembers', $kheta->id)}}" class="btn btn-primary waves-effect waves-light">
                            <i class="bx bx-add-to-queue font-size-16 align-middle me-2"></i>أضافه لجنه جديده
                        </a>
                    </div>
                    <table id="students-datatable" class="table table-bordered dt-responsive  nowrap w-100 text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الأسم</th>
                            <th>الرقم الوظيفى</th>
                            <th> جهات التقييم </th>
                            <th>التحكم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ratingMembers as $member)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $member->username }}</td>
                                <td>{{ $member->job_number }}</td>
                                <td>
                                    @if(!empty($member->gehat))
                                            @php
                                                $gehat = json_decode($member->gehat);
                                                $users = \App\Models\User::whereIn('id', $gehat)->get();
                                            @endphp
                                            @foreach($users as $user)
                                                 <p>{{$user->geha }}</p>
                                            @endforeach
                                        @else
                                        --
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('dashboard.ratingMembers.edit', $member->id) }}" data-category-id="{{ $member->id }}"
                                           class="text-muted font-size-20"><i class="bx bxs-edit"></i></a>
                                        <form action="{{ route('dashboard.ratingMembers.destroy', $member->id) }}"
                                              method="POST">@csrf @method('delete')
                                            <a class="text-muted font-size-20 confirm-delete"><i
                                                    class="bx bx-trash"></i></a>
                                        </form>
                                    </div>
                                </td>
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

    @include('admins.ratingMembers.scripts.delete')
@endpush
