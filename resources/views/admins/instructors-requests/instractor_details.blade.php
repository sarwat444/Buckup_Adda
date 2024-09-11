@extends('admins.layouts.app')

@push('title',__('admin-dashboard.categories'))

@push('styles')
    <link href="{{asset('/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"
          type="text/css"/>
@endpush

@section('content')
    <div class="row">
        <div class="col-6">
            <div class="card">
                 <div class="card-header" style=" color: #556ee6; font-size: 16px;">
                     Instractor Information Details
                 </div>
                <div class="card-body">
                    <table class="table table-bordered table-responsive">
                         <tbody>
                                 <tr><th>First Name : </th> <td>{{$instractorData->user->first_name}}</td></tr>
                                 <tr><th>Last Name :  </th> <td>{{$instractorData->user->last_name}}</td></tr>
                                 <tr><th>Email :      </th> <td>{{$instractorData->user->email}}</td></tr>
                                 <tr><th>Phone  :     </th> <td>{{$instractorData->user->instractorDetails->phone}}</td></tr>
                                 <tr><th>Phone2   :   </th> <td>{{$instractorData->user->instractorDetails->phone2}}</td></tr>
                                 <tr><th>Experience Certifications   : </th> <td>{{$instractorData->user->instractorDetails->experience_certifications}} </td></tr>
                                 <tr><th>Teaching Fileds   : </th> <td>{{$instractorData->user->instractorDetails->teaching_fileds}}</td></tr>
                                 <tr><th>Teaching Languages   : </th> <td>{{$instractorData->user->instractorDetails->teaching_languages}}</td></tr>
                                 <tr><th>LinkedIn   : </th> <td>{{$instractorData->user->instractorDetails->linkedIn}}</td></tr>
                         </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header" style=" color: #556ee6; font-size: 16px;">
                    Instractor Bank Details
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-responsive">
                        <tbody>
                            <tr><th>Account Name   : </th> <td>{{$instractorData->user->bankdetails->account_name}} </td></tr>
                            <tr><th>Bank Country    : </th> <td>{{$instractorData->user->bankdetails->bank_country}}</td></tr>
                            <tr><th>Bank Name   : </th> <td>{{$instractorData->user->bankdetails->bank_name}}</td></tr>
                            <tr><th>Acoount Number  : </th> <td>{{$instractorData->user->bankdetails->account_number}}</td></tr>
                            <tr><th>Swift Code   : </th> <td>{{$instractorData->user->bankdetails->swift_code}}</td></tr>
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
