@extends('admins.layouts.app')
@push('title', __('admin-dashboard.Dashboard'))
<script src="{{asset(PUBLIC_PATH.'assets/admin/libs/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset(PUBLIC_PATH.'assets/admin/js/pages/apexcharts.init.js')}}"></script>
@section('content')
    <div class="row mt-2">
        <div class="col-xl-6">
            <div class="d-flex flex-wrap gap-2 mb-2">
                @foreach($Execution_years as $year)
                    <a href="{{ route('dashboard.goal_statastics', ['kheta_id' => $year->kheta_id ,'objective_id' => $objective_id ,'year_id' => $year->id]) }}" class="btn  @if(!empty($year_id)) @if($year_id == $year->id) btn-success @else btn-primary  @endif  @else btn-primary @endif   waves-effect waves-light">{{ $year->year_name }}</a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row">
               @if(!empty($goals))
                @foreach ($goals  as  $key =>  $goal)
                    @php
                        $total = 0 ;
                        $programs_count  = $goal->programs_count ;
                        if(!empty($goal->programs))
                        {
                            foreach ($goal->programs as $program){
                                if(!empty($program->moksherat)){

                                    $mokashaert_count[] = $program->moksherat->count();

                                    foreach ($program->moksherat as $mokasher)
                                    {
                                        if(!empty($mokasher->mokasher_geha_inputs))
                                        {
                                               $total += $mokasher->mokasher_geha_inputs->percentage ;
                                        }
                                    }
                                }
                            }
                        }
                    @endphp
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('dashboard.program_statastics',['kheta_id'=>$kheta_id , 'goal_id' => $goal->id ,'year_id' => $year_id])}}">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-xs me-3">
                                                <span
                                                    class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18"><i
                                                        class="bx bx-copy-alt"></i></span>
                                    </div>
                                    <h5 class="font-size-14 mb-0">{{ $goal->goal }}</h5>
                                </div>
                                <div class="text-muted mt-2">
                                    <div id="radialBar-chart{{$goal->id}}"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <script>
                    var options = {
                        series: [
                            @if(!empty($programs_count) && $programs_count > 0 )
                                @if(!empty($mokashaert_count[$key]))
                                {{round(($total/$mokashaert_count[$key])/($programs_count))}}
                                @else
                                0
                            @endif
                                @else 0
                            @endif
                        ],
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
                        labels: ['قيمه الهدف  '],
                        colors:[
                            @if(!empty($programs_count) && $programs_count > 0 )
                                @if(!empty($mokashaert_count[$key]))
                                    @if(round(($total/$mokashaert_count[$key])/($programs_count)) < 50 )
                                    '#f00'
                                     @elseif(round(($total/$mokashaert_count[$key])/($programs_count))  >=  50 && round(($total/$mokashaert_count[$key])/($programs_count)) < 100 )
                                    '#f8de26'
                                     @elseif(round(($total/$mokashaert_count[$key])/($programs_count)) ==  100)
                                    '#00ff00'
                                   @endif
                                 @endif
                            @endif
                        ]
                    };
                    (chart = new ApexCharts(document.querySelector("#radialBar-chart{{$goal->id}}"), options)).render();
                </script>
            @endforeach
        @endif
    </div>
@endsection
@push('scripts')

@endpush


