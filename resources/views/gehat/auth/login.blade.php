@extends('gehat.auth.layout.app')
@push('title','تسجيل دخول الجهات')
@push('styles')
    <style>
        body , html
        {
            direction: rtl;
            text-align: right;
        }
        body
        {
            direction: rtl;
            font-family: 'Noto Kufi Arabic', sans-serif;
            background-image: linear-gradient( #0c3f77f2, #0f4e93c7), url({{asset(PUBLIC_PATH.'assets/site/images/background.jpg')}});
            background-size: cover;
            background-position: center;

        }
    </style>
@endpush
@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-6 text-center">
                <img class="mb-3" src="{{asset(PUBLIC_PATH.'assets/site/images/main-logo.png')}}">
                <div class="card overflow-hidden">
                    <div class="bg-primary bg-soft">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h3 class="text-center font-size-17 mt-4">  نظام أداء جامعه بنها</h3>
                                <p class="text-primary text-center">تسجيل دخول - الجهات </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="p-2 text-center">
                            <div class="mb-1">
                                @if($errors->any())
                                    @foreach($errors->all() as $error)
                                        <b class="text-danger">{{ $error }}</b>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="p-2" >

                            <form class="form-horizontal" action="{{route('authenticate')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="job_number" class="form-label" style="float: right;">الرقم الوظيفى</label>
                                    <input type="text" name="job_number" class="form-control" id="job_number" placeholder="الرقم  الوظيفى">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" style="float: right;">الرقم السري </label>
                                    <div class="input-group auth-pass-inputgroup">
                                        <input type="password" name="password" class="form-control" placeholder="الرقم السري  " aria-label="Password" aria-describedby="password-addon">
                                        <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                    </div>
                                </div>
                                <div class="mt-3 d-grid">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">تسجيل الدخول</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
