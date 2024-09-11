@extends('sub_geha.layouts.app')
@push('title','أضافه مدخلات المؤشر ')
@push('styles')
    <link href="{{asset('/assets/admin/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body" style="text-align: right">
                    <h4 class="card-title mb-3"> أضافه مدخلات المؤشر </h4>
                    <form id="store-mokasher-input" class="repeater"
                          action="{{route('sub_geha.store_sub_geha_mokasher_input' , $mokasher->id)}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="mokasher_id" value="{{$mokasher->id}}">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label>المستهدف</label>
                                <input type="text" readonly class="form-control mb-4" name="target"
                                       value="@if(!empty($mokasher->mokasher_geha_inputs)) {{intval($mokasher->mokasher_geha_inputs->target)}} @endif">
                                <input type="hidden" name="geha_id"
                                       value="{{\Illuminate\Support\Facades\Auth::user()->id}}" class="form-control">
                                <div class="row">
                                    <label>المنجز </label>
                                    <div class="col-md-3">
                                        <input type="text" name="part_1" placeholder="الربع الأول"
                                               class="form-control" pattern="[0-9]*"
                                               value="@if(!empty($mokasher->mokasher_geha_inputs)){{ $mokasher->mokasher_geha_inputs->part_1 }}@endif">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="part_2" placeholder="الربع الثانى"
                                               class="form-control" pattern="[0-9]*"
                                               value="@if(!empty($mokasher->mokasher_geha_inputs)){{ $mokasher->mokasher_geha_inputs->part_2 }}@endif">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="part_3" placeholder="الربع الثالث"
                                               class="form-control" pattern="[0-9]*"
                                               value="@if(!empty($mokasher->mokasher_geha_inputs)){{ $mokasher->mokasher_geha_inputs->part_3 }}@endif">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="part_4" placeholder="الربع الرابع"
                                               class="form-control" pattern="[0-9]*"
                                               value="@if(!empty($mokasher->mokasher_geha_inputs)){{ $mokasher->mokasher_geha_inputs->part_4 }}@endif">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label> رفع الأدله والشواهد - يمكن رفع اكثر من دليل </label>
                                <input type="file" class="form-control" name="files[]" multiple>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="vivacity">اضافه نشاط </label>
                                <textarea class="form-control" name="vivacity" id="vivacity" rows="5"
                                          placeholder="اضافه جميع الأنشطه  خلال  الفتره ">@if(!empty($mokasher->mokasher_geha_inputs->vivacity))
                                        {{ $mokasher->mokasher_geha_inputs->vivacity }}
                                    @endif</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="impediments"> المعوقات </label>
                                <textarea class="form-control" name="impediments" id="impediments" rows="5"
                                          placeholder="المعوقات">@if(!empty($mokasher->mokasher_geha_inputs->impediments))
                                        {{ $mokasher->mokasher_geha_inputs->impediments }}
                                    @endif</textarea>
                            </div>
                        </div>
                        <div class="mb-2 text-center">
                            <div class="spinner-border text-primary m-1 d-none" role="status"><span
                                    class="sr-only"></span></div>
                        </div>
                        <button type="submit" id="submit-button" class="btn btn-primary w-md btn-lg">حفظ المدخلات
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row mb-3">
                <div class="card">
                    <div class="card-body">
                        <h4> الأدله والشواهد </h4>

                            @if(!empty($mokasher->mokasher_geha_inputs->files))
                                @php
                                    $files  = json_decode($mokasher->mokasher_geha_inputs->files) ;
                                @endphp
                                <table class="table table-bordered table-responsive table-striped">
                                    <thead>
                                    <th>تحميل الملفات</th>
                                    <th>التحكم</th>
                                    </thead>
                                    <tbody>
                                    @foreach($files as $key => $file)
                                        <tr>
                                            <td><a href="{{ asset($file) }}">ملف # {{ $key + 1 }} <i
                                                        class="fa fa-file"></i></a></td>
                                            <td>
                                                <form
                                                    action="{{ route('sub_geha.delete.file', ['id' => $key , 'mokasher_id' => $mokasher->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="id" value="{{$key}}">
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
@endsection
@push('scripts')
    <script src="{{asset('/assets/admin/libs/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('/assets/admin/js/pages/form-advanced.init.js')}}"></script>
    <script src="{{asset('/assets/admin/libs/jquery.repeater/jquery.repeater.min.js')}}"></script>
    <script src="{{asset('/assets/admin/js/pages/form-repeater.int.js')}}"></script>
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
    @include('admins.courses.scripts.detect-input-change')
    @include('admins.courses.scripts.store')
@endpush
