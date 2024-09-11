@extends('admins.layouts.app')
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
                    <form id="update-user-from" action="{{route('dashboard.users.update',$user->id)}}" method="POST" enctype="multipart/form-data">
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
                                    <label for="email" class="form-label">الأيميل </label>
                                    <input type="email" name="email" value="{{$user->email}}" placeholder="الأيميل" class="form-control" id="email" required>
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
                        <!--
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="role_name" class="form-label">الأداره </label>
                                    <select name="mangement_id" id="mangement_id" class="form-control select2" required>
                                        <option disabled selected>تحديد الأداره</option>
                                        @foreach($mangements as $mangement)
                                            <option value="{{ $mangement->id }}" @if($mangement->id == $user->mangemnet->id) selected @endif> {{$mangement->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        -->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="is_manger">هل مدير ؟ </label>
                                    <input type="checkbox" @if($user->is_manger == 1) checked @endif   name="is_manger" id="is_manger" />
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
