@extends('admins.layouts.app')
@push('title', __('admin-dashboard.Dashboard'))

<script src="{{asset(PUBLIC_PATH.'assets/admin/libs/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset(PUBLIC_PATH.'assets/admin/js/pages/apexcharts.init.js')}}"></script>

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18"> تقرير  متابعه أداء المؤشرات - تطور الأداء - المؤشرات    </h4>

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
        <div class="col-md-6">
            @foreach($mokashers_parts as $mokasher)
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 style="font-size: 14px;margin-bottom: 30px;">@if(!empty($mokasher->mokasher))
                                    {{$mokasher->mokasher->name}}
                                @endif</h3>
                            <div id="chart{{$mokasher->mokasher_id}}"></div>
                        </div>
                    </div>
                </div>
                <script>
                    var colors = [
                        @if(!empty($mokasher->part_1))
                            @if(round($mokasher->part_1) < 50 )
                            '#f00',
                        @elseif(round($mokasher->part_1)  >=  50 && round($mokasher->part_1) < 100 )
                            '#f8de26',
                        @elseif(round($mokasher->part_1)  ==  100)
                            '#00ff00',
                        @endif
                            @endif

                        @if(!empty($mokasher->part_2))
                                @if(round($mokasher->part_2) < 50 )
                                '#f00',
                                @elseif(round($mokasher->part_2)  >=  50 && round($mokasher->part_2) < 100 )
                                    '#f8de26',
                                @elseif(round($mokasher->part_2)  ==  100)
                                    '#00ff00',
                                @endif
                        @endif

                       @if(!empty($mokasher->part_3))
                        @if(round($mokasher->part_3) < 50 )
                           '#f00',
                        @elseif(round($mokasher->part_3)  >=  50 && round($mokasher->part_3) < 100 )
                            '#f8de26',
                        @elseif(round($mokasher->part_3)  ==  100)
                            '#00ff00',
                        @endif
                        @endif

                         @if(!empty($mokasher->part_4))
                         @if(round($mokasher->part_4) < 50 )
                            '#f00',
                        @elseif(round($mokasher->part_4)  >=  50 && round($mokasher->part_4) < 100 )
                            '#f8de26',
                        @elseif(round($mokasher->part_4)  ==  100)
                            '#00ff00',
                        @endif
                        @endif


                    ];
                    var options = {
                        series: [{
                            data: [{{round($mokasher->part_1) ?? 0}}, {{round($mokasher->part_2)  ?? 0 }}, {{round($mokasher->part_3) ?? 0}}, {{$mokasher->part_4 ?? 0}}]
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
                                'الربع الأول',
                                'الربع الثانى',
                                'الربع الثالث',
                                'الربع الرابع'
                            ],
                            labels: {
                                style: {
                                    colors: colors,
                                    fontSize: '12px'
                                }
                            }
                        }
                    };
                    var chart = new ApexCharts(document.querySelector("#chart{{$mokasher->mokasher_id}}"), options);
                    chart.render();
                </script>
            @endforeach
        </div>
        <div class="col-md-6">

            @foreach($mokashers_years as $mokasher)
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 style="font-size: 14px;margin-bottom: 30px;">@if(!empty($mokasher->mokasher))
                                    {{$mokasher->mokasher->name}}
                                @endif</h3>
                            <div id="year_chart{{$mokasher->mokasher_id}}"></div>
                        </div>
                    </div>
                </div>

            @php
                       $mokashers_years = \App\Models\MokasherGehaInput::with(['mokasher','ex_year' , 'mokasher.mokasher_execution_years'])
                        ->select(
                            'year_id',
                            DB::raw("(((SUM(rate_part_1) + SUM(rate_part_2) + SUM(rate_part_3) + SUM(rate_part_4)) / SUM(part_1 + part_2 + part_3 + part_4)) * 100) as total_per_year"),
                        )
                        ->where('mokasher_id', $mokasher->mokasher_id )
                        ->groupBy('year_id')
                        ->get();
            @endphp
                <script>

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
                        if (round($mokashers_year->total_per_year) < 50) {
                            $color = '#f00';
                        } elseif (round($mokashers_year->total_per_year) >= 50 && round($mokashers_year->total_per_year) < 100) {
                            $color = '#f8de26';
                        } elseif (round($mokashers_year->total_per_year) == 100) {
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
                                    {{ round($mokashers_year->total_per_year) }},
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
                    var chart = new ApexCharts(document.querySelector("#year_chart{{$mokasher->mokasher_id}}"), options);
                    chart.render();
                </script>
            @endforeach
        </div>

@endsection

