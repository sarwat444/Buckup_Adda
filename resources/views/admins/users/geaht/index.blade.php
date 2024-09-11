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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-4">
                        <form method="post" action="{{route('dashboard.change_execution_year')}}">
                            @csrf
                                <div class="card-title font-size-14">أختيار سنه التنفيذ </div>
                                <select name="execuation_year" class="form-control">
                                    @foreach($execution_years as $ex_year)
                                        <option value="{{$ex_year->year_name}}" @if($ex_year->selected == 1) selected @endif>{{$ex_year->year_name}}</option>
                                    @endforeach
                                </select>
                            <button type="submit"  class="btn btn-primary mt-4" >تنفيذ </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title"> الجهات</div>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <a href="{{route('dashboard.createuser',$kheta->id )}}" class="btn btn-primary waves-effect waves-light">
                            <i class="bx bx-add-to-queue font-size-16 align-middle me-2"></i>أضافه جهه جديده
                        </a>
                    </div>
                    <table id="students-datatable" class="table table-bordered dt-responsive  nowrap w-100 table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الرقم الوظيفى</th>
                            <th>الجهه</th>
                            <th>هل مدير ؟</th>
                            <th>التحكم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$user->job_number}}</td>
                                <td>{{$user->geha}}</td>
                                <td>@if($user->is_manger == 1) <span class="badge bg-success">مدير</span> @else -  @endif </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('dashboard.users.edit', $user->id) }}" data-category-id="{{ $user->id }}"
                                           class="text-muted font-size-20"><i class="bx bxs-edit"></i></a>
                                        <form action="{{ route('dashboard.users.destroy', $user->id) }}"
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

    @include('admins.users.geaht.scripts.delete')
@endpush
