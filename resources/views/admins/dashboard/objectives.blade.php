@extends('admins.layouts.app')
@push('title', __('admin-dashboard.Dashboard'))
<script src="{{ asset(PUBLIC_PATH . 'assets/admin/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset(PUBLIC_PATH . 'assets/admin/js/pages/apexcharts.init.js') }}"></script>

@section('content')
    <a class="btn btn-primary" href="{{ route('dashboard.print_Histogram_kheta_objectives_dashboard', ['kheta_id' => $kheta_id, 'year_id' => $year_id]) }}">
        <i class="bx bx-printer"></i> طباعه التقرير
    </a>

    <div class="row mt-2">
        <div class="col-xl-6">
            <div class="d-flex flex-wrap gap-2 mb-2">
                @foreach ($Execution_years as $year)
                    <a data-id="{{ $year->id }}"
                       href="{{ route('dashboard.objectivesDashboard', ['year_id' => $year->id, 'kheta_id' => $year->kheta_id]) }}"
                       class="btn @if($year_id == $year->id) btn-success @else btn-primary @endif waves-effect waves-light">
                        {{ $year->year_name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row">
        @php
            $total_performance = 0;
            $objectives_count = 0;
        @endphp

        @if(!empty($objectives))
            @foreach ($objectives as $ob_key => $objective)
                @php
                    $goals_count = $objective->goals_count;
                    $total = 0;
                    $ob_mokasher_count = 0;
                @endphp

                @if(!empty($objective->goals))
                    @foreach ($objective->goals as $goal)
                        @if(!empty($goal->programs))
                            @foreach ($goal->programs as $program)
                                @if(!empty($program->moksherat))
                                    @php $ob_mokasher_count += $program->moksherat->count(); @endphp
                                    @foreach ($program->moksherat as $mokasher)
                                        @if(!empty($mokasher->mokasher_geha_inputs))
                                            @php $total += $mokasher->mokasher_geha_inputs->percentage; @endphp
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                @endif

                @php
                    $performance = $ob_mokasher_count > 0 ? round($total / $ob_mokasher_count, 2) : 0;
                    if ($performance > 100) $performance = 100;

                    $total_performance += $performance;
                    $objectives_count++;
                @endphp

                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('dashboard.goal_statastics', ['kheta_id' => $kheta_id, 'objective_id' => $objective->id, 'year_id' => $year_id]) }}">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                            <i class="bx bx-copy-alt"></i>
                                        </span>
                                    </div>
                                    <h5 class="font-size-14 mb-0">{{ $objective->objective }}</h5>
                                </div>
                                <div class="text-muted mt-2">
                                    <div id="radialBar-chart{{ $objective->id }}"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <script>
                    var options = {
                        series: [{{ $performance }}],
                        chart: {
                            height: 200,
                            type: 'radialBar',
                        },
                        plotOptions: {
                            radialBar: {
                                hollow: {
                                    size: '70%',
                                }
                            },
                        },
                        labels: ['قيمه الغايه'],
                        colors: [
                            @if ($performance < 50)
                                '#f00'
                            @elseif($performance >= 50 && $performance < 100)
                                '#f8de26'
                            @else
                                '#00ff00'
                            @endif
                        ]
                    };
                    (chart = new ApexCharts(document.querySelector("#radialBar-chart{{ $objective->id }}"), options)).render();
                </script>
            @endforeach
        @endif
    </div>

    @if($objectives_count > 0)
        <div class="mt-4">
            <div class="alert alert-info text-center">
                <strong>النسبة الإجمالية للغايات:</strong>
                {{ round($total_performance / $objectives_count, 2) }}%
            </div>
        </div>
    @endif
@endsection

@push('scripts')
@endpush
