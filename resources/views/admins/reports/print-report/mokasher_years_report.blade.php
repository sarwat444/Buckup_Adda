<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Include Bootstrap CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100..900&display=swap" rel="stylesheet">
    <!-- Include custom CSS with font -->
    <style>
        body {
            font-family: 'aealarabiya';
            direction: rtl;
            font-weight: 400;
            font-size: 11px !important;
        }

        /* Add custom styles for the table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px; /* Add margin to the bottom of the table */
        }

        th, td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: right;
        }

        th {
            background-color: #f2f2f2;
        }

        .performance {
            padding: 4px 8px;
            border-radius: 4px;
            color: #fff;
        }

        .performance[style*="background-color: #f00"] {
            background-color: #f00; /* Red */
        }

        .performance[style*="background-color: #f8de26"] {
            background-color: #f8de26; /* Yellow */
        }

        .performance[style*="background-color: #00ff00"] {
            background-color: #00ff00; /* Green */
        }

        .logos {
            margin: 0 10px; /* Add margin between items */
            width: 200px;
        }

        .logos .image
        {
            width:100px ;
            float: left;
            display: inline-block;
        }

        .logos img {
            height: 50px;
            width: 50px;
            margin-bottom: -15px;
        }

        .logos h4 {
            font-size: 14px;
            padding: 0;
        }

        tbody  tr  td{

            font-weight: 500;
            font-size: 12px;
        }
        .table-responsive
        {
            margin-top: 200px !important;
        }
        td{
            padding: 20px;
        }
    </style>
</head>
<body>
@if(!empty($results))
    <div class="Report_Date">
        <h4> الجهه :  {{ $results[0]->geha->geha }}</h4>
        <p> تاريخ التقرير : <?php echo date('d-m-Y'); ?></p>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
        <tr >
            <th>الهدف</th>
            <th>البرنامج</th>
            <th>المؤشر</th>
            <th >المستهدف</th>
            <th >المنجز</th>
            <th >الأداء</th>
            <th >ملاحظات</th>
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
                    <td class="text-primary">{{ $result->mokasher->program->goal->goal }}</td>
                    <td class="text-primary">{{ $result->mokasher->program->program }}</td>
                    <td>{{ $result->mokasher->name }}</td>
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
@else
    <span class="badge badge-soft-danger font-size-13">برجاء اختيار الجهة المطلوبة</span>
@endif
</body>
</html>
