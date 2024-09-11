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


        .logo
        {
            border-radius: 50%;
            border: 2px solid #eee;
            padding: 0;
            height: 114px;
            margin-bottom: 20px ;
        }
        .main-directions h3
        {
            color: #fff;
            font-size: 34px;
            margin-top: 48px;
        }
        .btn {
            padding: 6px 51px;
            font-size: 19px;
            color: #fff;
            background-color: #083252;
            border-color: #556ee6;
            border: 0;
            border: 1px solid #606060;
        }
        .main-directions   p{
            margin-top: 41px;
            color: #ccc;
            font-size: 17px;
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-9 col-xl-9 text-center">
                <img class="mb-3" src="{{asset(PUBLIC_PATH.'assets/site/images/main-logo.png')}}">
                <div class="main-directions">
                    <img class="logo" src="{{asset(PUBLIC_PATH.'assets/admin/images/logo-light.png')}}" height="100px">
                    <h3> مرحبا بكم . فى  نظام أداء جامعه بنها </h3>
                    <p>الدخول  للنظام</p>
                    <div class="buttons mt-5">
                        <a href="{{route('admins.login')}}" class="btn btn-primary">مدير  نظام </a>
                        <a href="{{route('login')}}" class="btn btn-primary">  مدير الجهه   </a>
                        <a href="{{route('login')}}" class="btn btn-primary">   الجهه   </a>
                        <a href="{{route('ratingLogin')}}" class="btn btn-primary">   لجنه تقييم   </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
