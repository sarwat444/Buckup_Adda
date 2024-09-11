@extends('admins.layouts.app')
@push('title', 'أضافه مدخلات المؤشر ')
@push('styles')
    <link href="{{ asset(PUBLIC_PATH . '/assets/admin/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ $mokasher->name }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);"> {{ $mokasher->name }} </a></li>
                        <li class="breadcrumb-item active"> المؤشرات </li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body" style="text-align: right">
                    <h4 class="card-title mb-3"> أضافه مدخلات المؤشر </h4>
                    <form id="store-mokasher-input" class="repeater"
                        action="{{ route('dashboard.moksherat.store_mokaseerinput') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-2">
                            <input type="hidden" name="mokasher_id" value="{{ $mokasher_id }}">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="type" class="form-label">النوع<span class="text-danger">*</span>
                                    </label>
                                    <select name="type" id="type" class="form-control" required
                                        onchange="updateLabelAndValidation()">
                                        <option value="parcent"
                                            @if (!empty($mokasher->mokasher_inputs)) @if ($mokasher->mokasher_inputs->type == 'parcent') selected @endif
                                            @endif > نسبه </option>
                                        <option value="num"
                                            @if (!empty($mokasher->mokasher_inputs)) @if ($mokasher->mokasher_inputs->type == 'num') selected @endif
                                            @endif>عدد </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="equation" class="form-label">المعادله<span class="text-danger">*</span>
                                    </label>
                                    <select name="equation" id="equation" class="form-control" required
                                        style="text-align: right;direction: rtl">
                                        <option value="total"
                                            @if (!empty($mokasher->mokasher_inputs)) @if ($mokasher->mokasher_inputs->equation == 'total') selected @endif
                                            @endif> مجموع </option>
                                        <option value="moadal"
                                            @if (!empty($mokasher->mokasher_inputs)) @if ($mokasher->mokasher_inputs->equation == 'moadal') selected @endif
                                            @endif>معدل</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">الجهه المختصه</label>
                                     <div  style="float: left">
                                     <input type="checkbox" id="checkbox">
                                     <span>الكل</span>
                                    </div>
                                    <select id="e1" class="select2 form-control select2-multiple" name="users[]"
                                        multiple="multiple" data-placeholder="أختر الجهه المختصه" style="text-align: right">
                                        @php
                                            $selected_users = [];
                                            if (!empty($mokasher->mokasher_inputs->users)) {
                                                $selected_users = json_decode($mokasher->mokasher_inputs->users);
                                            }
                                        @endphp
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                @if (in_array($user->id, $selected_users)) selected @endif>
                                                {{ $user->geha }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>
                        <p class="text-primary"><span class="text-danger">*</span> برجاء كتابه أرقام صحيحه بدون كسور </p>
                        <label class="mb-3" style="font-weight: bold ; ">المطلوب انجازه فى السنوات التاليه : </label>
                        <div class="row">
                            @forelse($excuction_years as $key => $ex_year)
                                <div class="col-md-2">
                                    <div class="mb-4">
                                        <label for="ex{{ $key }}" class="form-label">

                                            {{ $ex_year->year_name }}
                                            @if (!empty($mokasher->mokasher_inputs))
                                            <span id="unitLabel" class="text-primary">{{ $mokasher->mokasher_inputs->type == 'parcent' ? '%' : '' }}</span>
                                        @endif
                                        </label>
                                        <input type="hidden" name="ids[]" value="{{ $ex_year->id }}">
                                        <input type="number" min="0" id="ex{{ $key }}" name="years[]"
                                            placeholder="المستهدف"
                                            value="{{ !empty($ex_year->MokasherExcutionYears) ? $ex_year->MokasherExcutionYears->value : 0 }}"
                                            class="form-control">

                                    </div>
                                </div>
                            @empty
                                لم يتم تحدي سنوات للخطة
                            @endforelse
                        </div>
                        <div class="mb-2 text-center">
                            <div class="spinner-border text-primary m-1 d-none" role="status"><span class="sr-only"></span>
                            </div>
                        </div>
                        <div>
                            <button type="submit" id="submit-button" class="btn btn-primary w-md">حفظ المدخلات </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset(PUBLIC_PATH . '/assets/admin/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset(PUBLIC_PATH . '/assets/admin/js/pages/form-advanced.init.js') }}"></script>
    <script src="{{ asset(PUBLIC_PATH . '/assets/admin/libs/jquery.repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset(PUBLIC_PATH . '/assets/admin/js/pages/form-repeater.int.js') }}"></script>
    <script>
        // jQuery script for automatic calculation
        $(document).ready(function() {
            // Select all input fields for the years
            var yearFields = $('[name^="year_"]');

            // Bind an input event to each year field
            yearFields.on('input', function() {
                calculateTotal();
            });

            // Function to calculate and update the total field
            function calculateTotal() {
                var total = 0;

                // Sum the values of all year fields
                yearFields.each(function() {
                    var value = parseInt($(this).val()) || 0;
                    total += value;
                });

                // Update the total field with the calculated sum
                $('#target').val(total);
            }
        });
    </script>
    <script>
        $("#checkbox").click(function() {
            if ($("#checkbox").is(':checked')) {
                $("#e1 > option").prop("selected", "selected");
                $("#e1").trigger("change");
            } else {
                $("#e1 > option").removeAttr("selected");
                $("#e1").trigger("change");
            }
        });

        $("#button").click(function() {
            alert($("#e1").val());
        });
    </script>
    <script>
        function updateLabelAndValidation() {
            var selectBox = document.getElementById("type");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
            var unitLabel = document.getElementById("unitLabel");
            var targetLabel = document.getElementById("targetLabel");

            if (selectedValue == 'parcent') {
                unitLabel.textContent = '%';
                document.querySelectorAll('input[type="number"]').forEach(function(input) {
                    input.setAttribute('max', 100);
                });
                targetLabel.textContent = "المطلوب انجازه في السنوات التالية:";
            } else {
                unitLabel.textContent = '';
                document.querySelectorAll('input[type="number"]').forEach(function(input) {
                    input.removeAttribute('max');
                });
                targetLabel.textContent = "المطلوب انجازه في السنوات:";
            }
        }
    </script>
    @include('admins.courses.scripts.detect-input-change')
    @include('admins.courses.scripts.store')
@endpush
