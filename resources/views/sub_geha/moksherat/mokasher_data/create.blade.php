@extends('sub_geha.layouts.app')
@push('title','أضافه مدخلات المؤشر ')
@push('styles')
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        #part_2,
        #part_3,
        #part_4 {
            display: none;
        }
    </style>
@endpush
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3"> أختر الربع المطلوب  </h4>
                    <div class="col-md-12">
                        <div class="form-group mb-2">
                            <select class="form-control" name="parts" id="parts">
                                <option value="1">الربع الأول</option>
                                <option value="2">الربع الثانى</option>
                                <option value="3">الربع الثالث</option>
                                <option value="4">الربع الرابع</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body" style="text-align: right">
                    <h4 class="card-title mb-3"> المستهدف السنوى  </h4>
                    <div class="form-group mb-2">
                        <input class="form-control" type="text" value="{{$mokasher->mokasher_geha_inputs->target}}"
                               readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body" style="text-align: right">
                            <div class="card">
                                <div class="card-body">
                                    <div id="part_1">
                                        <h3 class="font-size-17 mb-3">الربع الأول </h3>
                                        <p>المطلو ب تنفيذه : <span class="badge badge-soft-primary font-size-17"> {{$mokasher->mokasher_geha_inputs->part_1}} </span></p>
                                        <div class="row">
                                            <div class="col-md-7">
                                                <form style=" background-color: #eeeeee4d; padding: 16px;"
                                                      id="store-mokasher-input"
                                                      class="repeater"
                                                      action="{{route('sub_geha.store2_sub_geha_mokasher_input' , $mokasher->id)}}"
                                                      method="POST"
                                                      enctype="multipart/form-data">
                                                    @csrf

                                                    <input type="hidden" name="part" value="part_1">
                                                    <input type="hidden" name="year_id" value="{{$mokasher->mokasher_geha_inputs->year_id}}">
                                                    <input type="hidden" name="mokasher_id" value="{{$mokasher->id}}">
                                                    <input type="hidden" name="geha_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">

                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <label> رفع الأدله والشواهد - يمكن رفع اكثر من دليل </label>
                                                            <input type="file" accept="application/pdf" class="form-control" name="file1">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <label for="vivacity">اضافه نشاط </label>
                                                            <textarea class="form-control" name="vivacity1" id="vivacity" placeholder=" اضافه جميع الأنشطه  خلال  الفتره  " rows="5">@if(!empty($mokasher->mokasher_geha_inputs->vivacity1)){{ $mokasher->mokasher_geha_inputs->vivacity1 }}@endif</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="impediments"> المعوقات </label>
                                                            <textarea class="form-control" name="impediments1" id="impediments" rows="5" placeholder="المعوقات">@if(!empty($mokasher->mokasher_geha_inputs->impediments1)){{ $mokasher->mokasher_geha_inputs->impediments1 }}@endif</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="mb-2 text-center">
                                                        <div class="spinner-border text-primary m-1 d-none" role="status"><span
                                                                class="sr-only"></span></div>
                                                    </div>
                                                    <button type="submit" id="submit-button"
                                                            class="btn btn-primary w-md btn-lg">حفظ
                                                        المدخلات
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4> الأدله والشواهد الربع الأول </h4>
                                                        @if(!empty($mokasher->mokasher_geha_inputs->evidence1))
                                                            @php
                                                                $files  = json_decode($mokasher->mokasher_geha_inputs->evidence1) ;
                                                            @endphp
                                                            <table class="table table-bordered table-responsive table-striped">
                                                                <thead>
                                                                <th>#</th>
                                                                <th>تحميل الملفات</th>
                                                                <th>التحكم</th>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($files as $key => $file)
                                                                    <tr>
                                                                        <td>{{$loop->iteration}}</td>
                                                                        <td><a href="{{ asset(PUBLIC_PATH.'uploads/'.$file) }}"> {{$file}} <i class="fa fa-file"></i></a></td>
                                                                        <td>
                                                                            <form
                                                                                action="{{ route('sub_geha.delete.file', ['id' => $key , 'mokasher_id' => $mokasher->id]) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                @method('delete')
                                                                                <input type="hidden" name="id" value="{{$key}}">
                                                                                <input type="hidden" name="part" value="1">
                                                                                <button type="button" class="btn btn-danger btn-sm delete_btn_file">
                                                                                    حذف
                                                                                </button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        @else
                                                            <p class="text-danger"> * لا يوجد اى أدله او شواهد </p>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div id="part_2">
                                        <h3 class="font-size-17 mb-3">الربع الثانى </h3>
                                        <p>المطلو ب تنفيذه : <span class="badge badge-soft-primary font-size-17"> {{$mokasher->mokasher_geha_inputs->part_2}} </span></p>
                                        <div class="row">
                                            <div class="col-md-7">
                                                <form style=" background-color: #eeeeee4d; padding: 16px;"
                                                      id="store-mokasher-input"
                                                      class="repeater"
                                                      action="{{route('sub_geha.store2_sub_geha_mokasher_input' , $mokasher->id)}}"
                                                      method="POST"
                                                      enctype="multipart/form-data">
                                                    @csrf

                                                    <input type="hidden" name="year_id" value="{{$mokasher->mokasher_geha_inputs->year_id}}">
                                                    <input type="hidden" name="mokasher_id" value="{{$mokasher->id}}">
                                                    <input type="hidden" name="geha_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                                                    <input type="hidden" name="part" value="part_2">
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <label> رفع الأدله والشواهد - يمكن رفع اكثر من دليل </label>
                                                            <input type="file" class="form-control" accept="application/pdf" name="files2" multiple>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <label for="vivacity">اضافه نشاط </label>
                                                            <textarea class="form-control" name="vivacity2" id="vivacity" rows="5" placeholder="اضافه جميع الأنشطه  خلال  الفتره ">@if(!empty($mokasher->mokasher_geha_inputs->vivacity2)){{ $mokasher->mokasher_geha_inputs->vivacity2 }}@endif</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="impediments2"> المعوقات </label>
                                                            <textarea class="form-control" name="impediments2" id="impediments2" rows="5" placeholder="المعوقات">@if(!empty($mokasher->mokasher_geha_inputs->impediments2)){{ $mokasher->mokasher_geha_inputs->impediments2 }}@endif</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="mb-2 text-center">
                                                        <div class="spinner-border text-primary m-1 d-none" role="status"><span
                                                                class="sr-only"></span></div>
                                                    </div>
                                                    <button type="submit" id="submit-button"
                                                            class="btn btn-primary w-md btn-lg">حفظ
                                                        المدخلات
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4> الأدله والشواهد الربع الأول </h4>
                                                        @if(!empty($mokasher->mokasher_geha_inputs->evidence2))
                                                            @php
                                                                $files  = json_decode($mokasher->mokasher_geha_inputs->evidence2) ;
                                                            @endphp
                                                            <table class="table table-bordered table-responsive table-striped">
                                                                <thead>
                                                                <th>تحميل الملفات</th>
                                                                <th>التحكم</th>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($files as $key => $file)
                                                                    <tr>
                                                                        <td><a href="{{ asset(PUBLIC_PATH.'uploads/'.$file) }}"> {{$file}} <i class="fa fa-file"></i></a></td>
                                                                        <td>
                                                                            <form
                                                                                action="{{ route('sub_geha.delete.file', ['id' => $key , 'mokasher_id' => $mokasher->id]) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                @method('delete')
                                                                                <input type="hidden" name="id" value="{{$key}}">
                                                                                <input type="hidden" name="part" value="2">
                                                                                <button type="button" class="btn btn-danger btn-sm delete_btn_file">
                                                                                    حذف
                                                                                </button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        @else
                                                            <p class="text-danger"> * لا يوجد اى أدله او شواهد </p>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="part_3">
                                        <h3 class="font-size-17 mb-3">الربع الثالث </h3>
                                        <p>المطلو ب تنفيذه : <span class="badge badge-soft-primary font-size-17"> {{$mokasher->mokasher_geha_inputs->part_3}} </span></p>
                                        <div class="row">
                                            <div class="col-md-7">
                                                <form style=" background-color: #eeeeee4d; padding: 16px;"
                                                      id="store-mokasher-input"
                                                      class="repeater"
                                                      action="{{route('sub_geha.store2_sub_geha_mokasher_input' , $mokasher->id)}}"
                                                      method="POST"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                        <input type="hidden" name="year_id" value="{{$mokasher->mokasher_geha_inputs->year_id}}">
                                                        <input type="hidden" name="mokasher_id" value="{{$mokasher->id}}">

                                                        <input type="hidden" name="geha_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                                                        <input type="hidden" name="part" value="part_3">

                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <label> رفع الأدله والشواهد - يمكن رفع اكثر من دليل </label>
                                                            <input type="file" class="form-control" accept="application/pdf" name="files3" multiple>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <label for="vivacity3">اضافه نشاط </label>
                                                            <textarea class="form-control" name="vivacity3" id="vivacity" rows="5" placeholder="اضافه جميع الأنشطه  خلال  الفتره ">@if(!empty($mokasher->mokasher_geha_inputs->vivacity3)){{ $mokasher->mokasher_geha_inputs->vivacity3 }}@endif</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="impediments"> المعوقات </label>
                                                            <textarea class="form-control" name="impediments3" id="impediments3" rows="5" placeholder="المعوقات">@if(!empty($mokasher->mokasher_geha_inputs->impediments3)){{ $mokasher->mokasher_geha_inputs->impediments3 }}@endif</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="mb-2 text-center">
                                                        <div class="spinner-border text-primary m-1 d-none" role="status"><span
                                                                class="sr-only"></span></div>
                                                    </div>
                                                    <button type="submit" id="submit-button"
                                                            class="btn btn-primary w-md btn-lg">حفظ
                                                        المدخلات
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4> الأدله والشواهد الربع الثالث </h4>
                                                        @if(!empty($mokasher->mokasher_geha_inputs->evidence3))
                                                            @php
                                                                $files  = json_decode($mokasher->mokasher_geha_inputs->evidence3) ;
                                                            @endphp
                                                            <table class="table table-bordered table-responsive table-striped">
                                                                <thead>
                                                                <th>تحميل الملفات</th>
                                                                <th>التحكم</th>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($files as $key => $file)
                                                                    <tr>
                                                                       <td><a href="{{ asset(PUBLIC_PATH.'uploads/'.$file) }}"> {{$file}} <i class="fa fa-file"></i></a></td>
                                                                        <td>
                                                                            <form
                                                                                action="{{ route('sub_geha.delete.file', ['id' => $key , 'mokasher_id' => $mokasher->id]) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                @method('delete')
                                                                                <input type="hidden" name="id" value="{{$key}}">
                                                                                <input type="hidden" name="part" value="3">
                                                                                <button type="button" class="btn btn-danger btn-sm delete_btn_file">
                                                                                    حذف
                                                                                </button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        @else
                                                            <p class="text-danger"> * لا يوجد اى أدله او شواهد </p>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div id="part_4">
                                        <h3 class="font-size-17 mb-3">الربع الرابع </h3>
                                        <p>المطلو ب تنفيذه : <span class="badge badge-soft-primary font-size-17"> {{$mokasher->mokasher_geha_inputs->part_4}} </span></p>
                                        <div class="row">
                                            <div class="col-md-7">
                                                <form style=" background-color: #eeeeee4d; padding: 16px;"
                                                      id="store-mokasher-input"
                                                      class="repeater"
                                                      action="{{route('sub_geha.store2_sub_geha_mokasher_input' , $mokasher->id)}}"
                                                      method="POST"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="year_id" value="{{$mokasher->mokasher_geha_inputs->year_id}}">
                                                    <input type="hidden" name="mokasher_id" value="{{$mokasher->id}}">
                                                    <input type="hidden" name="geha_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                                                    <input type="hidden" name="part" value="part_4">

                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <label> رفع الأدله والشواهد - يمكن رفع اكثر من دليل </label>
                                                            <input type="file" accept="application/pdf" class="form-control" name="files4" multiple>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <label for="vivacity">اضافه نشاط </label>
                                                            <textarea class="form-control" name="vivacity4" id="vivacity" rows="5" placeholder="اضافه جميع الأنشطه  خلال  الفتره ">@if(!empty($mokasher->mokasher_geha_inputs->vivacity4)){{ $mokasher->mokasher_geha_inputs->vivacity4 }}@endif</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="impediments"> المعوقات </label>
                                                            <textarea class="form-control" name="impediments4" id="impediments" rows="5" placeholder="المعوقات">@if(!empty($mokasher->mokasher_geha_inputs->impediments4)){{ $mokasher->mokasher_geha_inputs->impediments4 }}@endif</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="mb-2 text-center">
                                                        <div class="spinner-border text-primary m-1 d-none" role="status"><span
                                                                class="sr-only"></span></div>
                                                    </div>
                                                    <button type="submit" id="submit-button"
                                                            class="btn btn-primary w-md btn-lg">حفظ
                                                        المدخلات
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4> الأدله والشواهد الربع الرابع </h4>
                                                        @if(!empty($mokasher->mokasher_geha_inputs->evidence4))
                                                            @php
                                                                $files  = json_decode($mokasher->mokasher_geha_inputs->evidence4) ;
                                                            @endphp
                                                            <table class="table table-bordered table-responsive table-striped">
                                                                <thead>
                                                                <th>تحميل الملفات</th>
                                                                <th>التحكم</th>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($files as $key => $file)
                                                                    <tr>
                                                                        <td><a href="{{ asset(PUBLIC_PATH.'uploads/'.$file) }}"> {{$file}} <i class="fa fa-file"></i></a></td>
                                                                        <td>
                                                                            <form
                                                                                action="{{ route('sub_geha.delete.file', ['id' => $key , 'mokasher_id' => $mokasher->id]) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                @method('delete')
                                                                                <input type="hidden" name="id" value="{{$key}}">
                                                                                <input type="hidden" name="part" value="4">
                                                                                <button type="button" class="btn btn-danger btn-sm delete_btn_file">
                                                                                    حذف
                                                                                </button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        @else
                                                            <p class="text-danger"> * لا يوجد اى أدله او شواهد </p>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script>
        $(document).ready(function () {
            $('.delete_btn_file').on('click', function () {
                // Display a confirmation prompt
                if (confirm('هل أنت متأكد أنك تريد حذف هذا الملف؟')) {
                    // Submit the closest form
                    $(this).closest('form').submit();
                }
            });
        });
    </script>
    <script>
        // jQuery script for automatic calculation
        $(document).ready(function () {
            // Select all input fields for the years
            var yearFields = $('[name^="year_"]');

            // Bind an input event to each year field
            yearFields.on('input', function () {
                calculateTotal();
            });

            // Function to calculate and update the total field
            function calculateTotal() {
                var total = 0;

                // Sum the values of all year fields
                yearFields.each(function () {
                    var value = parseInt($(this).val()) || 0;
                    total += value;
                });

                // Update the total field with the calculated sum
                $('#target').val(total);
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#parts').on('change', function () {
                var part_num = $(this).val();
                if (part_num == 1) {
                    $('#part_1').css('display', 'block');
                    $('#part_2').css('display', 'none');
                    $('#part_3').css('display', 'none');
                    $('#part_4').css('display', 'none');
                } else if (part_num == 2) {
                    $('#part_1').css('display', 'none');
                    $('#part_2').css('display', 'block');
                    $('#part_3').css('display', 'none');
                    $('#part_4').css('display', 'none');
                } else if (part_num == 3) {
                    $('#part_1').css('display', 'none');
                    $('#part_2').css('display', 'none');
                    $('#part_3').css('display', 'block');
                    $('#part_4').css('display', 'none');
                } else if (part_num == 4) {
                    $('#part_1').css('display', 'none');
                    $('#part_2').css('display', 'none');
                    $('#part_3').css('display', 'none');
                    $('#part_4').css('display', 'block');
                }
            });
        });

    </script>
    @include('admins.courses.scripts.detect-input-change')
    @include('admins.courses.scripts.store')
@endpush
