@extends('admins.layouts.app')
@push('title','تقرير الربع سنوي الجهات')
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
                <h4 class="mb-sm-0 font-size-18">تقرير  الربع سنوى للجهات </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">التقارير</a></li>
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
                    <form  method="post" action="{{route('dashboard.quarter_year' ,  $kehta_id)}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label for="gehat"> الجهات </label>
                                <select required id="gehat" class="form-control select2" name="geha">
                                    <option disabled selected> ...... </option>
                                    @forelse($gehat as $geha)
                                        <option value="{{ $geha->id }}" @if(isset($selected_geha) && $geha->id == $selected_geha) selected @endif>{{ $geha->geha }}</option>
                                    @empty
                                        <option disabled selected>لا يوجد ادارات</option>
                                    @endforelse

                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="part"> أختر الربع السنوى </label>
                                <select required id="part" class="form-control" name="part">
                                    <option value="1"> الربع الأول </option>
                                    <option value="2"> الربع الثانى  </option>
                                    <option value="3"> الربع الثالث  </option>
                                    <option value="4"> الربع الرابع  </option>
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
                        <a class="btn btn-primary mb-2" onclick="printReport('{{ $selected_geha }}', '{{ $part }}' ,  '{{ $kehta_id }}')"> <i class="bx bx-printer"></i> طباعه التقرير </a>

                        <table class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>المؤشر</th>
                                    <th>الجهه</th>
                                    <th>المستهدف</th>
                                    <th>المنجز</th>
                                    <th>الأداء</th>
                                    <th>ملاحظات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($results as $result)

                                    @php
                                        if($result->mostahdf == 0 )
                                        {
                                           $performance = 0  ;
                                        }else
                                        {
                                                   $performance = ($result->rating/$result->mostahdf)*100 ;
                                         }
                                    @endphp

                                    @if($result->mokasher->addedBy == 0 )
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $result->mokasher->name }}</td>
                                                    <td> {{ $result->geha->geha }}</td>
                                                    <td>{{ $result->mostahdf }}</td> <!-- Adjust this according to your data structure -->
                                                    <td>{{ $result->rating }}</td> <!-- Adjust this according to your data structure -->
                                                    <td>
                                                        @if($performance < 50 )
                                                            <span class="performance" style="background-color: #f00 ">{{$performance}} %</span>
                                                        @elseif($performance  >=  50 && $performance < 100 )
                                                            <span class="performance" style="background-color: #f8de26 ">{{$performance}} %</span>
                                                        @elseif($performance  ==  100)
                                                            <span class="performance" style="background-color: #00ff00 ">{{$performance}} %</span>
                                                        @endif
                                                    </td>
                                                    <td> @if(!empty($result->note)){{$result->note}} @else  <span class="badge badge-soft-danger"> لا يوجد ملاحظات</span>@endif</td>
                                                </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No data available</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </table>
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
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Responsive examples -->
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/select2/js/select2.min.js')}}"></script>
    <!-- Datatable init js -->
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/datatables.init.js')}}"></script>

    <script>
        function printReport(geha, part , kehta_id) {
            window.location.href = '{{ route('dashboard.print_users_part', ['geha' => ':geha', 'part' => ':part' , 'kehta_id' => ':kehta_id']) }}'
                .replace(':geha', geha)
                .replace(':part', part)
                .replace(':kehta_id', kehta_id);
        }
    </script>


@endpush
