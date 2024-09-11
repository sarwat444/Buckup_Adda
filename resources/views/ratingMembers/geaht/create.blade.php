@extends('admins.layouts.app')
@push('title','أضافه جهه جديده')

@push('styles')
    <link href="{{asset('/assets/admin/libs/select2/css/select2.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <style>
        input[switch]{
            display: inline  !important;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">أضافه جهه جديده </h4>
                    <form id="store-user-from"  action="{{route('dashboard.users.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="job_number" class="form-label"> الرقم  الوظيفى  </label>
                                    <input type="text" name="job_number" placeholder="الرقم الوظيفى" class="form-control" id="job_number" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="geha" class="form-label">الجهه</label>
                                    <input type="text" name="geha" placeholder="الجهه" class="form-control" id="geha" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="url" class="form-label">الرقم السري</label>
                                    <input type="text" name="password" placeholder="الرقم السري" class="form-control"
                                           id="url" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="mangement_id" class="form-label">الأداره </label>
                                    <select name="mangement_id" id="mangement_id" class="form-control select2" required>
                                        <option disabled selected>تحديد الأداره</option>
                                        @foreach($mangements as $mangement)
                                            <option value="{{$mangement->id}}">{{$mangement->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="is_manger" data-on-label="تعم" data-off-label="لا">هل مدير ؟ </label>
                                    <input type="checkbox" value="1" name="is_manger" id="is_manger" switch="none"/>
                                </div>
                            </div>
                        </div>

                            <div class="mb-2 text-center">
                                <div class="spinner-border text-primary m-1 d-none" role="status"><span
                                        class="sr-only"></span></div>
                            </div>
                            <div>
                               <button type="submit" id="submit-button" class="btn btn-primary w-md btn-lg">حفظ الجهه </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('/assets/admin/libs/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('/assets/admin/js/pages/form-advanced.init.js')}}"></script>
    <script src="{{asset('/assets/admin/libs/jquery.repeater/jquery.repeater.min.js')}}"></script>
    <script src="{{asset('/assets/admin/js/pages/form-repeater.int.js')}}"></script>
    @include('admins.courses.scripts.detect-input-change')
@endpush
