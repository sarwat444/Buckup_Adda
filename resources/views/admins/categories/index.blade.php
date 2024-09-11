@extends('admins.layouts.app')

@push('title',__('admin-dashboard.categories'))

@push('styles')
    <link href="{{asset('/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"
          type="text/css"/>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <button type="button" class="btn btn-primary waves-effect waves-light"
                                data-bs-toggle="modal" data-bs-target="#create-new-category">
                            <i class="bx bx-add-to-queue font-size-16 align-middle me-2"></i>{{__('admin-dashboard.new category')}}
                        </button>
                    </div>
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('admin-dashboard.Category Name')}}</th>
                            <th>{{__('admin-dashboard.Courses Count')}}</th>
                            <th>{{__('admin-dashboard.Actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td><span
                                        class="badge badge-pill badge-soft-primary font-size-12">{{ $category->courses_count }}</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="javascript:void(0);" data-category-id="{{ $category->id }}"
                                           class="text-muted font-size-20 edit"><i class="bx bxs-edit"></i></a>
                                        <form action="{{ route('dashboard.categories.destroy', $category->id) }}"
                                              method="POST">@csrf @method('delete')
                                            <a class="text-muted font-size-20 confirm-delete"><i
                                                    class="bx bx-trash"></i></a>
                                        </form>
                                    </div>
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

    @include('admins.categories.modals.store-modal')
    @include('admins.categories.modals.edit-modal')
@endsection


@push('scripts')
    <script src="{{asset('/assets/admin/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset('/assets/admin/js/pages/sweet-alerts.init.js')}}"></script>
    @include('admins.categories.scripts.store')
    @include('admins.categories.scripts.delete')
    @include('admins.categories.scripts.edit')
@endpush
