@extends('admins.layouts.kehta')
@push('title','الخطط الأستراتيجيه')

@push('styles')
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"
          type="text/css"/>
@endpush
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        @if(Auth::guard('admin')->user()->supper_admin  == 1 )
                            <button type="button" class="btn btn-primary waves-effect waves-light"
                                    data-bs-toggle="modal" data-bs-target="#create-new-category">
                                <i class="bx bx-add-to-queue font-size-16 align-middle me-2"></i>أضافه خطه جديده
                            </button>
                        @endif
                    </div>
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الخطط</th>
                            <th>عدد الغايات</th>
                            <th>التحكم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($ketas as $kheta)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if(!empty($kheta->image))
                                    <img class="img-thumbnail" src="{{asset(PUBLIC_PATH.$kheta->image)}}" height="70px" style="height: 50px">
                                  @else
                                  <img class="img-thumbnail" src="{{asset(PUBLIC_PATH.'uploads/kheta/default.png')}}" height="70px" style="height: 50px">
                                    @endif
                                </td>
                                <td><a href="{{ route('dashboard.objectives.show' , $kheta->id ) }}">{{ $kheta->name }}</a></td>
                                <td><span  class="badge badge-pill badge-soft-primary font-size-12">{{ $kheta->objectives_count }}</span>
                                </td>
                                <td>
                                    @if(Auth::guard('admin')->user()->supper_admin  == 1 )
                                        <div class="btn-group">
                                            <a href="javascript:void(0);" data-category-id="{{ $kheta->id }}"
                                               class="text-muted font-size-20 edit"><i class="bx bxs-edit"></i></a>
                                            <form action="{{ route('dashboard.kheta.destroy', $kheta->id) }}"
                                                  method="POST">@csrf @method('delete')
                                                <a class="text-muted font-size-20 confirm-delete"><i
                                                        class="bx bx-trash"></i></a>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-danger"> غير مسموح بالتعديل او الحذف </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">{{__('admin-dashboard.no data')}}</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('admins.kehta.modals.store-modal')
    @include('admins.kehta.modals.edit-modal')
@endsection
@push('scripts')
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/sweet-alerts.init.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/jquery.repeater/jquery.repeater.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/form-repeater.int.js')}}"></script>

    @include('admins.kehta.scripts.store')
    @include('admins.kehta.scripts.delete')
    @include('admins.kehta.scripts.edit')
@endpush
