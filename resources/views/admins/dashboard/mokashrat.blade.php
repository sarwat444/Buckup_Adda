@extends('admins.layouts.app')
@push('title', __('admin-dashboard.Dashboard'))
<script src="{{asset(PUBLIC_PATH.'assets/admin/libs/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset(PUBLIC_PATH.'assets/admin/js/pages/apexcharts.init.js')}}"></script>

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">المؤشرات </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">المؤشرات</a></li>
                        <li class="breadcrumb-item active">  البرامج  </li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-xl-6">
            <div class="d-flex flex-wrap gap-2 mb-3">
                @foreach($Execution_years as $year)
                    <a href="{{route('dashboard.mokashrat_statastics' ,['kheta_id'=>$kheta_id , 'program_id'=>$program_id , 'year_id' => $year->id]  )}}" class="btn @if($year_id == $year->id) btn-success @else btn-primary  @endif  waves-effect waves-light">{{$year->year_name}}</a>
                @endforeach
            </div>

            <div class="buttons d-flex mb-2">
                <a href="{{route('dashboard.mokashrat_statastics' ,['kheta_id'=>$kheta_id , 'program_id'=>$program_id , 'year_id' => $year_id , 'part' => 1])}}"  class="btn @if(!empty($part))@if($part == 1 ) btn-success @else btn-primary  @endif @else btn-primary  @endif btn-sm" style="margin-left: 5px">الربع الأول</a>
                <a  href="{{route('dashboard.mokashrat_statastics' ,['kheta_id'=>$kheta_id , 'program_id'=>$program_id , 'year_id' => $year_id, 'part' => 2])}}"  class="btn @if(!empty($part))@if($part == 2 ) btn-success @else btn-primary  @endif @else btn-primary  @endif btn-sm" style="margin-left: 5px">الربع الثانى </a>
                <a href="{{route('dashboard.mokashrat_statastics' ,['kheta_id'=>$kheta_id , 'program_id'=>$program_id , 'year_id' => $year_id , 'part' => 3])}}"  class="btn @if(!empty($part))@if($part == 3 ) btn-success @else btn-primary  @endif @else btn-primary  @endif btn-sm" style="margin-left: 5px">الربع الثالث </a>
                <a  href="{{route('dashboard.mokashrat_statastics' ,['kheta_id'=>$kheta_id , 'program_id'=>$program_id , 'year_id' =>$year_id , 'part' => 4])}}"  class="btn @if(!empty($part))@if($part == 4 ) btn-success @else btn-primary  @endif @else btn-primary  @endif btn-sm" style="margin-left: 5px">الربع الرابع </a>
            </div>

        </div>
    </div>

    <div class="row">
        @if(!empty($mokashers))
            @foreach ($mokashers  as $mokasher)
                <div class="col-sm-3 text-center" >
                    <div class="card">
                        <div class="card-body mokasher_chart">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-xs me-3">
                                                <span
                                                    class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18"><i
                                                        class="bx bx-copy-alt"></i></span>
                                    </div>
                                    <h5 class="font-size-14 mb-0">{{ $mokasher->name }}</h5>
                                </div>
                                 <div id="radialBar-chart{{$mokasher->id}}"></div>
                        </div>
                    </div>
                </div>
                <script>
                    var options = {
                        series: [@if(!empty($mokasher->mokasher_geha_inputs)){{round($mokasher->mokasher_geha_inputs->percentage)}} @else 0 @endif],
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
                        labels: ['قيمه المؤشر '],
                        colors:[
                                @if(!empty($mokasher->mokasher_geha_inputs))
                                 @if(round($mokasher->mokasher_geha_inputs->percentage) < 50 )
                                 '#f00'
                                  @elseif(round($mokasher->mokasher_geha_inputs->percentage)  >=  50 && round($mokasher->mokasher_geha_inputs->percentage) < 100 )
                                 '#f8de26'
                                  @elseif(round($mokasher->mokasher_geha_inputs->percentage)  ==  100)
                                 '#00ff00'
                                 @endif
                              @endif
                        ]
                    };
                    (chart = new ApexCharts(document.querySelector("#radialBar-chart{{$mokasher->id}}"), options)).render();
                </script>
            @endforeach
        @endif
    </div>
@endsection
@push('scripts')
@endpush


