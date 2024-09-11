@extends('admins.layouts.app')
@push('title','تعديل بيانات المؤشر')

@push('styles')
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/select2/css/select2.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <style>
        input[switch] {
            display: inline !important;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-6">
                      <form id="update-user-from" action="{{route('dashboard.moksherat.update',$mokasher->id)}}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <label for="name" class="col-form-label" name="name">أسم المؤشر</label>
                            <input type="text" name="name" value="{{$mokasher->name}}" placeholder="أسم المؤشر"
                                   class="form-control" id="name"
                                   required>
                        </div>
                        <div class="mb-2">
                            @if(!empty($mokasher->type))
                                @php
                                    $types = json_decode($mokasher->type) ;
                                @endphp
                            @endif
                            <label for="type" class="col-form-label">نوع المؤشر</label>
                            <select class="form-control select2" name="type[]" multiple style="width: 100%">
                                <option value="0" @if(in_array(0, $types)) selected @endif>مؤشر وزارة</option>
                                <option value="1" @if(in_array(1, $types)) selected @endif>مؤشر جامعه</option>
                                <option value="2" @if(in_array(2, $types)) selected @endif>مؤشر كليه</option>
                                <option value="3" @if(in_array(3, $types)) selected @endif>الكل</option>
                            </select>
                                <input type="hidden" name="program_id" value="{{$mokasher->program_id}}">
                                <input type="hidden" name="id" value="{{$mokasher->id}}">
                        </div>

                        <div class="mb-2 text-center">
                            <div class="spinner-border text-primary m-1 d-none" role="status"><span
                                    class="sr-only"></span></div>
                        </div>

                        <button type="submit" id="submit-button" class="btn btn-primary w-md">تعديل</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/select2/js/select2.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/form-advanced.init.js')}}"></script>
    @include('admins.courses.scripts.detect-input-change')
@endpush
