@extends('gehat.layouts.app')
@push('title','تعديل بيانات الجهه')

@push('styles')
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/select2/css/select2.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <style>
        input[switch]{
            display: inline  !important;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="update-user-from" action="{{route('gehat.users.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="job_number" class="form-label"> الرقم  الوظيفى  </label>
                                    <input type="text" name="job_number" value="{{$user->job_number}}" placeholder="الرقم الوظيفى" class="form-control" id="job_number" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="geha" class="form-label">الجهه</label>
                                    <input type="text" name="geha" value="{{$user->geha}}" placeholder="الجهه" class="form-control" id="geha" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">الرقم السري الجديد </label>
                                    <input type="text" name="password" placeholder="الرقم السري الجديد " class="form-control"
                                           id="password" >
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="geha_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">

                        <input type="hidden"   name="is_manger" value="0" id="is_manger" />
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
