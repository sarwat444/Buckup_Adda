@extends('gehat.layouts.app')
@push('title','أضافه مدخلات المؤشر ')
@push('styles')
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body" style="text-align: right">
                    <h4 class="card-title mb-4">{{ $mokasher->name }}</h4>
                    <h4 class="card-title mb-4 font-size-13 text-primary">  : توجيه المؤشر </h4>

                    <form id="store-mokasher-input" class="repeater" action="{{route('gehat.redirect_mokasher' ,  $mokasher_id )}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                         @if(!empty($selected_year))
                                @if(!empty($selected_year_value))
                                    <label>المستهدف فى سنه {{ $selected_year->year_name }}   </label>
                                    <input name="target" type="number"
                                        @if($mokasher->addedBy == 0 && !empty( $selected_year_value->value))
                                            value="{{ $selected_year_value->value }}" readonly
                                        @elseif($mokasher->addedBy == 0 && (empty( $selected_year_value->value) ||  $selected_year_value->value == 0))
                                            @if(!empty($mokasher->mokasher_geha_inputs))
                                              value="{{ $mokasher->mokasher_geha_inputs->target }}"
                                            @endif
                                        @endif
                                        class="form-control">
                                    <input type="hidden" name="year_id" value="{{ $selected_year_value->year_id }}">
                                @else
                                    <label>المستهدف فى سنه {{ $selected_year->year_name }}</label>
                                    <input class="form-control" type="number" name="target">
                                    <input type="hidden" name="year_id" value="{{ $selected_year->id }}">
                                @endif
                            @else
                                <span class="text-danger">* لم يتم تحديد السنه المستهدفه </span>
                            @endif



                            </div>
                            <div class="col-md-4">
                                <input type="hidden" name="mokasher_id" value="{{$mokasher_id}}">
                                <div class="mb-3">
                                    <label class="form-label">الجهه المختصه</label>
                                    <select class=" form-control" name="sub_geha_id" data-placeholder="أختر الجهه المختصه" style="text-align: right" required>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}"
                                                    @if(!empty($mokasher->mokasher_geha_inputs))
                                                        @if($mokasher->mokasher_geha_inputs->sub_geha_id == $user->id ) selected @endif
                                                @endif
                                            > {{$user->geha}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">

                        </div>

                        <label class="text-primary">المنجز  خلال الفتره</label>
                        @if(!empty($mokasher->mokasher_geha_inputs))
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <input type="number" name="part_1" class="form-control" value="{{$mokasher->mokasher_geha_inputs->part_1}}" placeholder="الربع الأول">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="part_2" class="form-control" value="{{$mokasher->mokasher_geha_inputs->part_2}}" placeholder="الربع الثانى">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="part_3" class="form-control" value="{{$mokasher->mokasher_geha_inputs->part_3}}" placeholder="الربع الثالث">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="part_4" class="form-control" value="{{$mokasher->mokasher_geha_inputs->part_4}}" placeholder="الربع الرابع">
                                </div>
                            </div>
                        @else
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <input type="number" name="part_1" class="form-control" placeholder="الربع الأول">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="part_2" class="form-control"  placeholder="الربع الثانى">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="part_3" class="form-control" placeholder="الربع الثالث">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="part_4" class="form-control" placeholder="الربع الرابع">
                                </div>
                            </div>
                        @endif

                        <div class="mb-2 text-center">
                            <div class="spinner-border text-primary m-1 d-none" role="status"><span class="sr-only"></span></div>
                        </div>
                        <div>
                            <button type="submit" id="submit-button" class="btn btn-primary w-md btn-lg">توجيه</button>
                        </div>
                    </form>
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
        $(document).ready(function() {
            // Function to calculate total input value
            function calculateTotal() {
                var total = 0;
                // Loop through each input field
                $('input[name^="part_"]').each(function() {
                    // Parse input value as float and add to total
                    total += parseFloat($(this).val()) || 0;
                });
                return total;
            }
            // Function to check if total exceeds target
            function checkTotal() {
                var total = calculateTotal();
                var target = parseFloat($('input[name="target"]').val()) || 0;
                if (total > target) {
                    // If total exceeds or equals target, show error message
                    alert("لابد مجموع الاربع لايتعدى المستهدف ");
                    return false; // Prevent form submission
                }
                return true; // Allow form submission
            }

            // Optionally, you can check total on form submission
            $('form').submit(function() {
                return checkTotal(); // Check total before form submission
            });
        });
    </script>
    @include('admins.courses.scripts.detect-input-change')
    @include('admins.courses.scripts.store')
@endpush
