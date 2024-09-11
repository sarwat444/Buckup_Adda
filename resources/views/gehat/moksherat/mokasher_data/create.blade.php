@extends('admins.layouts.app')
@push('title','أضافه مدخلات المؤشر ')
@push('styles')
    <link href="{{asset('/assets/admin/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body" style="text-align: right">
                    <h4 class="card-title mb-5"> أضافه موقف المؤشر </h4>
                    <form id="store-mokasher-input" class="repeater" action="{{route('dashboard.moksherat.store_mokaseerinput')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-5">
                            <input type="hidden" name="mokasher_id" value="{{$mokasher_id}}">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="type" class="form-label">النوع<span class="text-danger">*</span> </label>
                                    <select name="type" id="type" class="form-control " required>
                                        <option value="parcent"> نسبه </option>
                                        <option value="num">عدد  </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="type" class="form-label">المعادله<span class="text-danger">*</span> </label>
                                    <select name="type" id="type" class="form-control" required style="text-align: right;direction: rtl">
                                        <option value="parcent"> مجموع </option>
                                        <option value="num">معدل</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">الجهه المختصه</label>
                                    <select class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="أختر الجهه المختصه" style="text-align: right">
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}"> {{$user->geha}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <p class="text-primary"><span class="text-danger">*</span> برجاء كتابه أرقام صحيحه بدون كسور </p>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="mb-4">
                                    <label for="year_one" class="form-label">السنه الأولى </label>
                                    <input type="number" min="0" name="year_one" placeholder="السنه الأولى"  class="form-control" id="year_one">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-4">
                                    <label for="year_two" class="form-label">السنه الثانيه</label>
                                    <input type="number" min="0" name="year_two" placeholder="السنه الثانيه"  class="form-control" id="year_two">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="mb-4">
                                    <label for="year_three" class="form-label">السنه الثالثه</label>
                                    <input type="number" min="0"  name="year_three" placeholder="السنه الثالثه"  class="form-control" id="year_three">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="mb-4">
                                    <label for="year_four" class="form-label">السنه الرابعه</label>
                                    <input type="number" min="0"  name="year_four" placeholder="السنه الرابعه"  class="form-control" id="year_four">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-4">
                                    <label for="year_five" class="form-label">السنه الخامسه</label>
                                    <input type="number" min="0"  name="year_five" placeholder="السنه الخامسه"  class="form-control" id="year_five">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label for="target" class="form-label text-success bg-success" style="color: #fff !important;border-radius: 2px;" >المستهدف</label>
                                    <input type="number"  name="target" placeholder="اجمالى المستهدف"  class="form-control" id="target" readonly required>
                                </div>
                            </div>


                        </div>

                        <div class="mb-2 text-center">
                            <div class="spinner-border text-primary m-1 d-none" role="status"><span class="sr-only"></span></div>
                        </div>
                        <div>
                            <button type="submit" id="submit-button" class="btn btn-primary w-md btn-lg">حفظ المدخلات  </button>
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
