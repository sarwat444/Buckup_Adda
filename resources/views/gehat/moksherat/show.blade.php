@extends('gehat.layouts.app')
@push('title','عرض بيانات المؤشر')
@push('styles')
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
                <div class="card-body" style="text-align: right">
                    <h3 class="text-center  font-size-17 mb-4"> {{ $mokaser_data->name }}</h3>
                    @if(!empty($selected_year))
                        <label> المستهدف فى سنه {{ $selected_year->year_name }}</label>
                        <input type="text" readonly value="{{$selected_year_value->value}}" class="form-control" >
                        <input  type="hidden" name="target" value="{{$selected_year_value->value}}">
                        <input type="hidden" name="year_id" value="{{ $selected_year_value->year_id }}">
                    @else
                        <span class="text-danger">* لم يتم  تحديد السنه  المستهدفه </span>
                    @endif
                   <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">الربع الأول</div>
                                    <div class="form-group mb-2">
                                        <label>الأنشطه</label>
                                        <textarea class="form-control" readonly>{{$mokaser_data->mokasher_geha_inputs->vivacity1}}</textarea>
                                    </div>

                                    <div class="form-group mb-2">
                                        <label>المعوقات </label>
                                        <textarea class="form-control" readonly>{{$mokaser_data->mokasher_geha_inputs->impediments1}}</textarea>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label>الأدله والشواهد </label>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <th>#</th>
                                            <th>الملف</th>
                                            </thead>
                                            @if(!empty($mokaser_data->mokasher_geha_inputs->evidence1))
                                                @php
                                                    $files  = json_decode($mokaser_data->mokasher_geha_inputs->evidence1) ;
                                                @endphp
                                                @foreach( $files as  $file)
                                                    <tr>
                                                        <td>{{$loop->iteration }}</td>
                                                        <td><a href="{{asset($file)}}"><i class="fa fa-file"></i> {{$file}} </a></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <span>لا يوجد ملفات لعرضها !</span>
                                            @endif
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">الربع الثانى</div>

                                    <div class="form-group mb-2">
                                        <label>الأنشطه</label>
                                        <textarea class="form-control" readonly>{{$mokaser_data->mokasher_geha_inputs->vivacity2}}</textarea>
                                    </div>

                                    <div class="form-group mb-2">
                                        <label>المعوقات </label>
                                        <textarea class="form-control" readonly>{{$mokaser_data->mokasher_geha_inputs->impediments2}}</textarea>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label>الأدله والشواهد </label>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <th>#</th>
                                            <th>الملف</th>
                                            </thead>
                                            @if(!empty($mokaser_data->mokasher_geha_inputs->evidence2))
                                                @php
                                                    $files  = json_decode($mokaser_data->mokasher_geha_inputs->evidence2) ;
                                                @endphp
                                                @foreach( $files as  $file)
                                                    <tr>
                                                        <td>{{$loop->iteration }}</td>
                                                        <td><a href="{{asset($file)}}"><i class="fa fa-file"></i> {{$file}} </a></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <span>لا يوجد ملفات لعرضها !</span>
                                            @endif
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">الربع الثالث</div>


                                    <div class="form-group mb-2">
                                        <label>الأنشطه</label>
                                        <textarea class="form-control" readonly>{{$mokaser_data->mokasher_geha_inputs->vivacity3}}</textarea>
                                    </div>

                                    <div class="form-group mb-2">
                                        <label>المعوقات </label>
                                        <textarea class="form-control" readonly>{{$mokaser_data->mokasher_geha_inputs->impediments3}}</textarea>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label>الأدله والشواهد </label>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <th>#</th>
                                            <th>الملف</th>
                                            </thead>
                                            @if(!empty($mokaser_data->mokasher_geha_inputs->evidence3))
                                                @php
                                                    $files  = json_decode($mokaser_data->mokasher_geha_inputs->evidence3) ;
                                                @endphp
                                                @foreach( $files as  $file)
                                                    <tr>
                                                        <td>{{$loop->iteration }}</td>
                                                        <td><a href="{{asset($file)}}"><i class="fa fa-file"></i> {{$file}} </a></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <span>لا يوجد ملفات لعرضها !</span>
                                            @endif
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">الربع الرابع</div>

                                    <div class="form-group mb-2">
                                        <label>الأنشطه</label>
                                        <textarea class="form-control" readonly>{{$mokaser_data->mokasher_geha_inputs->vivacity4}}</textarea>
                                    </div>

                                    <div class="form-group mb-2">
                                        <label>المعوقات </label>
                                        <textarea class="form-control" readonly>{{$mokaser_data->mokasher_geha_inputs->impediments4}}</textarea>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label>الأدله والشواهد </label>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <th>#</th>
                                            <th>الملف</th>
                                            </thead>
                                            @if(!empty($mokaser_data->mokasher_geha_inputs->evidence4))
                                                @php
                                                    $files  = json_decode($mokaser_data->mokasher_geha_inputs->evidence4) ;
                                                @endphp
                                                @foreach( $files as  $file)
                                                    <tr>
                                                        <td>{{$loop->iteration }}</td>
                                                        <td><a href="{{asset($file)}}"><i class="fa fa-file"></i> {{$file}} </a></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <span>لا يوجد ملفات لعرضها !</span>
                                            @endif
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

            @endsection

            @push('scripts')
                <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/select2/js/select2.min.js')}}"></script>
                <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/form-advanced.init.js')}}"></script>
                <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/jquery.repeater/jquery.repeater.min.js')}}"></script>
                <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/form-repeater.int.js')}}"></script>
    @include('admins.courses.scripts.detect-input-change')
    @endpush
