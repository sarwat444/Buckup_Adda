@extends('admins.layouts.app')
@push('title', __('admin-dashboard.Dashboard'))
<script src="{{asset(PUBLIC_PATH.'assets/admin/libs/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset(PUBLIC_PATH.'assets/admin/js/pages/apexcharts.init.js')}}"></script>
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18"> تقرير  متابعه أداء المؤشرات - تطور الأداء  </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">  تقرير  متابعه أداء المؤشرات - تطور الأداء </a></li>
                        <li class="breadcrumb-item active">  التقارير  </li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        @if(!empty($objectives))
            @foreach ($objectives  as $objective)
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h3 style="font-size: 14px;margin-bottom: 30px;"><a href="{{route('dashboard.Histogram_goal_statastics',['kheta_id' => $kheta_id ,'objective_id' => $objective->id ])}}">{{ $objective->objective }}</a> </h3>
                            <div id="year_chart{{$objective->id}}"></div>
                        </div>
                    </div>
                </div>
                @php
                    $mokashers_years = \App\Models\MokasherGehaInput::with(['mokasher', 'ex_year', 'mokasher.mokasher_execution_years'])
                    ->whereHas('mokasher.program.goal.objective', function ($query) use ($objective) {
                        $query->where('id', $objective->id);
                    })
                    ->select('year_id',
                        DB::raw('(SUM(rate_part_1 + rate_part_2 + rate_part_3 + rate_part_4) / SUM(part_1 + part_2 + part_3 + part_4)) * 100 as percentage')
                    )
                    ->groupBy('year_id')
                    ->get();

                @endphp
                    <!--Start Colors -->
                @php
                    $colors = [];
                @endphp

                @foreach($Execution_years as $year)
                    @php
                        $found = false;
                    @endphp
                    @foreach($mokashers_years as $mokashers_year)
                        @if($mokashers_year->year_id == $year->id)
                            @php
                                $found = true;
                                $color = '';
                                if (round($mokashers_year->percentage)  / $objective->goals_count  < 50) {
                                    $color = '#f00';
                                } elseif (round($mokashers_year->percentage) / $objective->goals_count  >= 50 && round($mokashers_year->percentage)  / $objective->goals_count < 100) {
                                    $color = '#f8de26';
                                } elseif (round($mokashers_year->percentage) / $objective->goals_count  == 100) {
                                    $color = '#00ff00';
                                }
                                $colors[] = $color;
                            @endphp
                        @endif
                    @endforeach

                    @if (!$found)
                        @php
                            $colors[] = '#f00'; // Default color if year not found in $mokashers_years
                        @endphp
                    @endif
                @endforeach

                <script>

                    var colors = {!! json_encode($colors) !!};

                    var options = {
                        series: [{
                            data: [
                                @foreach($Execution_years as $year)
                                    @php
                                        $found = false;
                                    @endphp
                                    @foreach($mokashers_years as $mokashers_year)
                                    @if($mokashers_year->year_id == $year->id)
                                    {{ round(round($mokashers_year->percentage) / $objective->goals_count) }},
                                @php
                                    $found = true;
                                @endphp
                                    @endif
                                    @endforeach
                                    @if (!$found)
                                    0,
                                @endif
                                @endforeach
                            ]
                        }],
                        chart: {
                            height: 350,
                            type: 'bar',
                            events: {
                                click: function (chart, w, e) {
                                    // console.log(chart, w, e)
                                }
                            }
                        },
                        colors: colors, // Assign the colors array here
                        plotOptions: {
                            bar: {
                                columnWidth: '20%',
                                distributed: true,
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        legend: {
                            show: false
                        },
                        xaxis: {
                            categories: [
                                @foreach($Execution_years as $year)
                                    '{{$year->year_name}}',
                                @endforeach
                            ],
                            labels: {
                                style: {
                                    colors: colors,
                                    fontSize: '12px'
                                }
                            }
                        }
                    };
                    var chart = new ApexCharts(document.querySelector("#year_chart{{$objective->id}}"), options);
                    chart.render();
                </script>
    @endforeach
    @endif
@endsection

