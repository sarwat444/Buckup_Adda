
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
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
        .s_logo
        {
            width: 100%;
            height: 163px;
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
            <h3> تقرير متابعة  الغايات - 2024 </h3>
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
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>الغاية</th>
                        <th>الأداء (%)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($objectives))
                        @foreach ($objectives as $ob_key => $objective)
                            @php
                                $total = 0;
                                $ob_mokasher_count = 0;

                                if(!empty($objective->goals)) {
                                    foreach ($objective->goals as $goal) {
                                        if(!empty($goal->programs)) {
                                            foreach ($goal->programs as $program) {
                                                if(!empty($program->moksherat)) {
                                                    $ob_mokasher_count += $program->moksherat->count();
                                                    foreach ($program->moksherat as $mokasher) {
                                                        if(!empty($mokasher->mokasher_geha_inputs)) {
                                                            $total += $mokasher->mokasher_geha_inputs->percentage;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }

                                $performance = $ob_mokasher_count > 0 ? round($total / $ob_mokasher_count, 2) : 0;
                                if ($performance > 100) $performance = 100;

                                // Determine color
                                $color = '#f00'; // Red for <50
                                if ($performance >= 50 && $performance < 90) {
                                    $color = '#f8de26'; // Yellow
                                } elseif ($performance >= 90) {
                                    $color = '#00ff00'; // Green
                                }
                            @endphp

                            <tr>
                                <td>{{ $objective->objective }}</td>
                                <td style="background-color: {{ $color }}; color: #fff; font-weight: bold; text-align: center;">
                                    {{ $performance }}%
                                </td>
                            </tr>
                        @endforeach
                    @endif


                    </tbody>
                </table>
                @php
                    // حساب الإجمالي
                    $total_performance = 0;
                    $objectives_count = count($objectives);

                    foreach ($objectives as $objective) {
                        $total = 0;
                        $ob_mokasher_count = 0;

                        if(!empty($objective->goals)) {
                            foreach ($objective->goals as $goal) {
                                if(!empty($goal->programs)) {
                                    foreach ($goal->programs as $program) {
                                        if(!empty($program->moksherat)) {
                                            $ob_mokasher_count += $program->moksherat->count();
                                            foreach ($program->moksherat as $mokasher) {
                                                if(!empty($mokasher->mokasher_geha_inputs)) {
                                                    $total += $mokasher->mokasher_geha_inputs->percentage;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }

                        $performance = $ob_mokasher_count > 0 ? round($total / $ob_mokasher_count, 2) : 0;
                        $total_performance += $performance;
                    }

                    $overall_performance = $objectives_count > 0 ? round($total_performance / $objectives_count, 2) : 0;

                    // تحديد لون المؤشر
                    $overall_color = '#f00'; // أحمر لأقل من 50%
                    if ($overall_performance >= 50 && $overall_performance < 90) {
                        $overall_color = '#f8de26'; // أصفر
                    } elseif ($overall_performance >= 90) {
                        $overall_color = '#00ff00'; // أخضر
                    }
                @endphp

                        <!-- إضافة قسم الإجمالي -->
                <div class=" mt-4">
                    <div class="col-md-8 offset-md-2"> <!-- لجعل العرض أكثر تركيزاً -->
                        <div class="card" style="border: none; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                            <div class="card-header text-center" style="background-color: #f8f9fa; border-bottom: 2px solid {{ $overall_color }}; padding: 15px;">
                                <h3 style="font-size: 18px; margin: 0; color: #495057; font-weight: 600;">
                                    <i class="bx bx-stats" style="margin-left: 8px;"></i> النسبة الإجمالية لأداء الغايات
                                </h3>
                            </div>
                            <div class="card-body text-center" style="padding: 0;">
                                <div style="background-color: {{ $overall_color }}; padding: 25px; color: #fff; position: relative;">
                                    <h2 style="font-size: 36px; font-weight: 700; margin: 0; letter-spacing: 1px; color: #fff">
                                        {{ $overall_performance }}%
                                    </h2>
                                    <div style="position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 0; height: 0; border-left: 10px solid transparent; border-right: 10px solid transparent; border-top: 10px solid {{ $overall_color }};"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
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


