
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تقرير اجمالى مؤشرات الكليات</title>
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/css/bootstrap-rtl.min.css')}}"  rel="stylesheet" type="text/css" />
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/css/app.min.css')}}"   rel="stylesheet" type="text/css" />
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pace.min.js')}}"></script>
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/css/pace.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/css/custom-responsive.css')}}" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@500&display=swap" rel="stylesheet">
    <style>
        body , html
        {
            direction: rtl;
            text-align: right;
        }
        #print_report
        {
            width: 100%;
        }
        .color-box {
            width: 30px;
            height: 30px;
            border: 1px solid #000;
            display: inline-block;
        }
        .top-header h3
        {
            font-size: 15px;
        }
        .top-header .box-1
        {
            text-align: center;
            margin-top: 45px;
        }
        .top-header .box-1 h3 {
            font-size: 15px;
            margin-top: 13px;
            font-weight: bold;
        }
        .top-header .box-1 h4 {
            font-size: 14px;
            margin-top: 13px;
            font-weight: bold;
            color: #556ee6;
        }
        .box-2
        {
            text-align: center;
            margin-top: 100px;
        }
        .box-2 h1
        {
            font-size: 15px;
            margin-top: 13px;
            font-weight: bold;
        }
        .top-header .table{
            font-size: 13px;
            background-color: #fff;
        }
        .table-bordered {
            border: 1px solid #eff2f7;
            font-size: 13px;
        }
        .performance
        {
            background-color: #00ff00;
            color: #fff;
            padding: 5px;
            border-radius: 4px;
        }
        .s_logo
        {
            width: 100%;
            height: 163px;
        }
        @media print {
            #print_report
            {
                display: none;
            }
            @page {
                margin: 0 !important;
                size: A4;
                page-break-inside: avoid !important; /* Prevent element from breaking across pages */
                break-inside: avoid !important;
            }

            body {
                margin: 0 !important;
                padding: 0 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                size: A4 landscape; /* Set landscape mode */
                margin: 0 !important;

            }

            .container {
                margin: 0 !important;
            }

            .no-margin {
                margin: 0 !important;
            }

            .download_pdf {
                display: none;
            }

            .performance {
                width: 51px;
                border: 6px;
                border-radius: 4px;
                padding: 3px;
                color: #fff;
                font-size: 12px;
            }

            .print_report {
                width: 100%;
                margin: 0 auto;
            }
            table{
                width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <button class="btn btn-primary mb-2" id="print_report">
        <i class="bx bx-printer download_pdf" id=""></i> طباعه التقرير
    </button>
    <div class="row top-header">
        <div class="col-md-3 box-1">
            <img class="s_logo" src="{{asset(PUBLIC_PATH.'assets/site/images/s_logo.png')}}" height="100">
        </div>
        <div class="col-md-5 box-2">
            <h1>نظام أداء جامعة بنها </h1>
            <h3> تقرير متابعة الجهات - عام {{ $year->year_name }} </h3>
            <p><?php echo date('d-m-Y'); ?></p>
        </div>
        <div class="col-md-4">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>اللون</th>
                    <th>النسبة</th>
                    <th>التفسير</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><div class="color-box" style="background-color: #f00;"></div></td>
                    <td>أقل من 50%</td>
                    <td>ضعيف</td>
                </tr>
                <tr>
                    <td><div class="color-box" style="background-color: #f8de26;"></div></td>
                    <td>من 50% إلى أقل من 90%</td>
                    <td>متوسط</td>
                </tr>
                <tr>
                    <td><div class="color-box" style="background-color: #00ff00;"></div></td>
                    <td>من 90% إلى 100%</td>
                    <td>ممتاز</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        @if(!empty($results))

            <div class="table-responsive">
                <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>الجهات المنفذه</th>
                        <th>المؤشر</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($results as $result)
                        @php
                            $geha_execution  = \App\Models\MokasherGehaInput::with('mokasher' ,'geha')->withCount('mokasher')->where('geha_id' , $result->geha_id)->get();
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $geha_execution->first()->geha->geha }}</td>
                            <td>
                                @php
                                    $performance_sum = 0;
                                    $valid_items = 0;
                                @endphp

                                @foreach($geha_execution as $geha)
                                    @if($geha->mokasher->addedBy == 0)
                                        @php
                                         //   $mokashers_count = \App\Models\MokasherInput::whereJsonContains('users', (string) $geha->geha_id)->count();

                                              $mokashers_count =  \App\Models\MokasherGehaInput::where('geha_id' ,  $geha->geha_id)->count() ;
                                        @endphp
                                        @php
                                            $rating = $geha->rate_part_1 + $geha->rate_part_2 + $geha->rate_part_3 + $geha->rate_part_4;
                                            $total_parts = $geha->part_1 + $geha->part_2 + $geha->part_3 + $geha->part_4;

                                            if ($total_parts == 0) {
                                                $single_performance = 0;
                                            } else if ($rating > $total_parts) {
                                                $single_performance = 100;
                                            } else {
                                                $single_performance = ($rating / $total_parts) * 100;
                                                $single_performance = min($single_performance, 100);
                                            }


                                            $performance_sum += $single_performance;
                                            $valid_items++;

                                        @endphp
                                    @endif
                                @endforeach
                                @php
                                    $performance = $mokashers_count > 0 ? $performance_sum / $mokashers_count : 0;
                                @endphp

                                @if($performance < 50)
                                    <span class="performance" style="background-color: #f00">{{ round($performance) }} %</span>
                                @elseif($performance >= 50 && $performance < 100)
                                    <span class="performance" style="background-color: #f8de26">{{ round($performance) }} %</span>
                                @elseif($performance == 100)
                                    <span class="performance" style="background-color: #00ff00">{{ round($performance) }} %</span>
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
            <span class="badge badge-soft-danger font-size-13">برجاء أختيار السنه المطلوبه</span>
        @endif
    </div>
</div>
<script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/node-waves/waves.min.js')}}"></script>
<script>
    document.getElementById('print_report').addEventListener('click', function () {
        window.print();
    });
</script>
</body>
</html>


