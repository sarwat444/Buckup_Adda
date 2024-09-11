@extends('admins.layouts.app')

@push('title','تقرير أداء الجهات')

@push('styles')
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <!-- DataTables -->
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <!-- Responsive datatable examples -->
    <link
        href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
        rel="stylesheet" type="text/css"/>
    <style>
        .performance {
            width: 51px;
            border: 6px;
            border-radius: 4px;
            padding: 3px;
            color: #fff;
            font-size: 12px;
        }
        .gehat div {
            margin-bottom: 30px;
        }

    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18"> متابعه مؤشرات الوزاره   </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);"> التقارير </a></li>
                        <li class="breadcrumb-item active">لوحه التحكم</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="font-size-15 mb-3"> أختر السنه </h3>
                    <div class="buttons d-flex mb-3" style="border-bottom: 1px solid #eee; padding-bottom: 22px;">
                        @foreach($years as $year)
                            <a data-id="{{$year->id}}"
                               href="{{ route('dashboard.mokasherat_wezara', ['kheta_id' => $year->kheta_id , 'year_id' => $year->id ]) }}"
                               class="me-2 btn @if($year_id == $year->id) btn-success @else btn-primary  @endif   waves-effect waves-light">{{ $year->year_name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if(!empty($results))
                        <a class="btn btn-primary mb-2" onclick="printReport('{{ $kheta_id }}', '{{ $year_id }}')"> <i class="bx bx-printer"></i> طباعه التقرير </a>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الجهات المنفذه</th>
                                    <th>المؤشر</th>
                                    <th>ملاحظات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($results as $result)
                                    @php
                                        $geha_execution  = \App\Models\MokasherGehaInput::with('mokasher' ,'geha')->withCount('mokasher')->where('geha_id' , $result->geha_id)->get();
                                    @endphp
                                    @php
                                        $types = json_decode($geha_execution->first()->mokasher->type);
                                    @endphp
                                    @if(in_array(0, $types))
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td rowspan="{{ $geha_execution->count() }}">{{ $geha_execution->first()->geha->geha }}</td>
                                        <td>
                                            @foreach($geha_execution as $geha)
                                                <div style="margin-bottom: 17px;font-size: 14px;">
                                                    @php
                                                      $performance = ($geha->rate_part_1 + $geha->rate_part_2 + $geha->rate_part_3 + $geha->rate_part_4) / ($geha->part_1 + $geha->part_2 + $geha->part_3 + $geha->part_4) * 100;
                                                    @endphp
                                                    <div class="mb-2">
                                                        @if(!empty($geha->mokasher->type))
                                                            @php
                                                                $types = json_decode($geha->mokasher->type) ;
                                                            @endphp
                                                              @if(in_array(0, $types))
                                                                                {{ $geha->mokasher->name }}
                                                                                @if($performance < 50 )
                                                                                    <span class="performance" style="background-color: #f00 ">{{$performance}} %</span>
                                                                                @elseif($performance  >=  50 && $performance < 100 )
                                                                                    <span class="performance" style="background-color: #f8de26 ">{{round($performance)}} %</span>
                                                                                @elseif($performance  ==  100)
                                                                                    <span class="performance" style="background-color: #00ff00 ">{{round($performance)}} %</span>
                                                                                @endif
                                                                   @endif
                                                        @endif
                                                </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if(!empty($result->note))
                                                {{$result->note}}
                                            @else
                                                <span class="badge badge-soft-danger"> لا يوجد ملاحظات</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No data available</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    @else
                        <span class="badge badge-soft-danger font-size-13">برجاء أختيار السنه  المطلوبه</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/sweet-alerts.init.js')}}"></script>
    <!-- Required datatable js -->
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script
        src="{{asset(PUBLIC_PATH.'assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Responsive examples -->
    <script
        src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script
        src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/select2/js/select2.min.js')}}"></script>
    <!-- Datatable init js -->
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/datatables.init.js')}}"></script>


    <script>
        function printReport(kheta_id, year_id) {
            window.location.href = '{{ route('dashboard.print_mokasherat_wezara', ['kheta_id' => ':kheta_id', 'year_id' => ':year_id']) }}'
                .replace(':kheta_id', kheta_id)
                .replace(':year_id', year_id);
        }
    </script>


@endpush
