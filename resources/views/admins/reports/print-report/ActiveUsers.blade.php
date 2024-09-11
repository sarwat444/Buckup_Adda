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
            padding: 8px;
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
    </style>
</head>
<body>

@if(!empty($results))
    <div class="Report_Date" >
        <h4 style="color: #083152 !important;font-size: 15px; ">{{$report_name}}</h4>
        <p> تاريخ التقرير : <?php echo date('d-m-Y'); ?></p>
        <p> من -  {{$start}} </p>
        <p> الى - {{$end}}  </p>
    </div>

    <div class="table-responsive">
        <table id="datatable" class="table table-bordered table-striped">
            <thead>
                <tr style="background-color: #eeee;padding: 20px">
                    <th style="padding: 15px;padding: 15px;color:#fff;">#</th>
                    <th style="padding: 15px;padding: 15px;color:#fff;">الجهه</th>
                    <th style="padding: 15px;padding: 15px;color:#fff;">أخر ظهور</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $user)
                    <tr>
                        <td style="padding: 15px !important;">{{ $loop->iteration }}</td>
                        <td style="padding: 15px !important;">{{$user->geha}}</td>
                        <td style="padding: 15px !important;">{{ \Carbon\Carbon::parse($user->last_seen)->locale('ar')->diffForHumans() }}</td>
                    </tr>
                 @endforeach
            </tbody>
        </table>
    </div>
@endif
</body>
</html>
