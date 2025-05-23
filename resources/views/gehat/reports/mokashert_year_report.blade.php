@extends('gehat.layouts.app')

@push('title','تقرير الربع سنوى للجهات')

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
        .performance
        {
            width: 51px;
            border: 6px;
            border-radius: 4px;
            padding: 5px;
            color: #fff;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">تقرير  السنوى للجهات </h4>

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
                    <form  method="post" action="{{route('gehat.get_users_reports_year')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label for="gehat"> {{\Illuminate\Support\Facades\Auth::user()->geha}} </label>
                                <input type="hidden"  class="form-control select2" name="geha"  value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                            </div>
                            <div class="col-md-6">
                                <label for="part"> أختر السنه </label>
                                <select required id="year_id" class="form-control" name="year_id">
                                    @foreach($years as $year)
                                        <option value="{{$year->id}}">  {{$year->year_name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mt-4">
                                <button class="btn btn-primary btn-block" style="width: 100%; margin-top: 2px;"><i class="bx bx-search"></i>  بحث </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if(!empty($results))
                        <a class="btn btn-primary mb-2" onclick="printReport('{{\Illuminate\Support\Facades\Auth::user()->id }}', '{{ $year_id }}' , '{{$kehta_id}}')"> <i class="bx bx-printer"></i> طباعه مؤشرات الأدارة </a>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الهدف</th>
                                    <th>البرنامج</th>
                                    <th>المؤشر</th>
                                    <th>الجهه</th>
                                    <th>المستهدف</th>
                                    <th>المنجز</th>
                                    <th>الأداء</th>
                                    <th>ملاحظات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($results as $result)
                                    @php
                                        if ($result->mostahdf == 0 && $result->rating > 0) {
                                            $performance = 100;
                                        } elseif ($result->mostahdf == 0) {
                                            $performance = 0;
                                        } else {
                                            $performance = ($result->rating / $result->mostahdf) * 100;
                                            if ($performance > 100) {
                                                $performance = 100;
                                            }
                                        }
                                    @endphp
                                    @if($result->mokasher->addedBy == 0)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-primary">{{ $result->mokasher->program->goal->goal }}</td>
                                            <td class="text-primary">{{ $result->mokasher->program->program }}</td>
                                            <td>{{ $result->mokasher->name }}</td>
                                            <td>{{ $result->geha->geha }}</td>
                                            <td>{{ $result->mostahdf }}</td>
                                            <td>{{ $result->rating }}</td>
                                            <td>
                                                @if($performance < 50)
                                                    <span class="performance" style="background-color: #f00">{{ round($performance) }} %</span>
                                                @elseif($performance >= 50 && $performance < 100)
                                                    <span class="performance" style="background-color: #f8de26">{{ round($performance) }} %</span>
                                                @elseif($performance == 100)
                                                    <span class="performance" style="background-color: #00ff00">{{ round($performance) }} %</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(!empty($result->note_part_1))
                                                    {{$result->note_part_1}}
                                                @elseif(!empty($result->note_part_2))
                                                    {{$result->note_part_2}}
                                                @elseif(!empty($result->note_part_3))
                                                    {{$result->note_part_3}}
                                                @elseif(!empty($result->note_part_4))
                                                    {{$result->note_part_4}}
                                                @else
                                                    <span class="badge badge-soft-danger"> لا يوجد ملاحظات</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach


                                </tbody>
                            </table>
                        </div>
                    @else
                        <span class="badge badge-soft-danger font-size-13">برجاء أختيار الجهه المطلوبه</span>
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
        function printReport(sub_geha, year_id) {
            window.location.href = '{{ route('gehat.print_users_years', ['sub_geha' => ':sub_geha', 'year_id' => ':year_id']) }}'
                .replace(':sub_geha', sub_geha)
                .replace(':year_id', year_id);
        }
    </script>
@endpush
