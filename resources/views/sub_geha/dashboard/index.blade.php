@extends('sub_geha.layouts.app')

@push('title', __('admin-dashboard.Dashboard'))

@section('content')
    <h4>{{\Illuminate\Support\Facades\Auth::user()->geha }} </h4>
@endsection
@push('scripts')
    <script src="{{asset(PUBLIC_PATH.PUBLIC_PATH.'/assets/admin/libs/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/dashboard.init.js')}}"></script>
@endpush
