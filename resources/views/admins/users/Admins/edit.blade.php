@extends('admins.layouts.app')
@push('title','تعديل بيانات المدير')

@push('styles')
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/select2/css/select2.min.css')}}" rel="stylesheet"
          type="text/css"/>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="update-user-from" action="{{route('dashboard.admins.updateadmin',$admin->id)}}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">   الخطه  </label>
                                    <select name="kheta_id" class="form-control select2" required>
                                        @foreach($khetas as  $kheta)
                                            <option value="{{$kheta->id}}" @if($admin->kheta_id == $kheta->id) selected @endif> {{$kheta->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">   الأيميل  </label>
                                    <input type="text" name="email" placeholder="الأيميل" class="form-control" id="email" value="{{$admin->email}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="url" class="form-label"> الرقم السري جديد</label>
                                    <input type="text" name="password" placeholder="الرقم السري" class="form-control"  id="url">
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 text-center">
                            <div class="spinner-border text-primary m-1 d-none" role="status"><span
                                    class="sr-only"></span></div>
                        </div>
                        <button type="submit" id="submit-button" class="btn btn-success w-md">تعديل</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/select2/js/select2.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/form-advanced.init.js')}}"></script>
    @include('admins.courses.scripts.detect-input-change')
    @include('admins.users.scripts.update-user')
@endpush
