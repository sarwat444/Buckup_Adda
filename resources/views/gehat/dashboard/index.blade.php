
@extends('gehat.layouts.app')
@push('title', __('admin-dashboard.Dashboard'))
@section('content')
    <h4 class="mb-4">لوحه تحكم - مدير الجهه </h4>
    <h4>{{ Auth::user()->geha }}</h4>
@endsection
@push('scripts')
     <script src="{{asset('/assets/admin/libs/apexcharts/apexcharts.min.js')}}"></script>
     <script src="{{asset('/assets/admin/js/pages/dashboard.init.js')}}"></script>
@endpush
