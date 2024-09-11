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
                <h4 class="mb-sm-0 font-size-18">تقرير أداء للجهات </h4>

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
                               href="{{ route('dashboard.mokasherat_files_report', ['kheta_id' => $year->kheta_id , 'year_id' => $year->id ]) }}"
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
                        <a class="btn btn-primary mb-2" onclick="printReport('{{ $kheta_id }}', '{{ $year_id }}')"> <i
                                class="bx bx-printer"></i> طباعه التقرير </a>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped ">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الجهات المنفذه</th>
                                    <th>المؤشر /  الأداء </th>
                                    <th>ملاحظات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($results as $result)

                                    @php
                                        $geha_execution  = \App\Models\MokasherGehaInput::with('mokasher' ,'geha')->withCount('mokasher')->where('geha_id' , $result->geha_id)->get();
                                        $total = 0 ;

                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $geha_execution->first()->geha->geha }}</td>
                                        <td>
                                            <table class="table table-responsive table-bordered">
                                                <tbody>

                                        @foreach($geha_execution as $geha)
                                            <tr>
                                            @php
                                                /* If Geha Abloded  Two Files  it return  1 else  if  uploaded  1 it returns .5 */
                                                 $filledCount = 0; // Variable to keep track of the number of filled evidence variables
                                                    for ($i = 1; $i <= 4; $i++) {
                                                        if (!empty($geha->{'evidence' . $i})) {
                                                            $filledCount++;
                                                        }
                                                    }
                                                    if ($filledCount >= 2) {
                                                        $total = 1;
                                                    }else if($filledCount == 1) {
                                                        $total = .50;
                                                    } else {
                                                        $total = 0;
                                                    }

                                            @endphp

                                            @php
                                                if($geha->mokasher_count > 0 )
                                                {
                                                  $performance = ($total/$geha->mokasher_count)*100 ;
                                                 }else
                                                 {
                                                     $performance = 0 ;
                                                 }
                                            @endphp


                                             <td>{{ $geha->mokasher->name }}</td>
                                                    <td>

                                                    @if($performance < 50 )
                                                        <span class="performance" style="background-color: #f00 ">{{$performance}} %</span>
                                                    @elseif($performance  >=  50 && $performance < 100 )
                                                        <span class="performance" style="background-color: #f8de26 ">{{round($performance)}} %</span>
                                                    @elseif($performance  ==  100)
                                                        <span class="performance" style="background-color: #00ff00 ">{{round($performance)}} %</span>
                                                    @endif
                                                    </td>
                                                </tr>
                                            @endforeach

                                                    </tbody>
                                            </table>

                                      </td>
                                            <td>
                                                @if(!empty($result->note))
                                                    {{$result->note}}
                                                @else
                                                    <span class="badge badge-soft-danger"> لا يوجد ملاحظات</span>
                                                @endif
                                            </td>
                                    </tr>

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
            window.location.href = '{{ route('dashboard.print_gehat_mokasherat', ['kheta_id' => ':kheta_id', 'year_id' => ':year_id']) }}'
                .replace(':kheta_id', kheta_id)
                .replace(':year_id', year_id);
        }
    </script>

@endpush
