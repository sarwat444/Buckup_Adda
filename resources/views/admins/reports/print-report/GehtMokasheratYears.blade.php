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
            <p> تاريخ التقرير : <?php echo date('d-m-Y'); ?></p>
        </div>
        <div class="table-responsive">

            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="width: 25px !important;">#</th>
                    <th style="width:100px !important;">الجهات المنفذه</th>
                    <th style="width: 300px !important;">المؤشر / الأداء </th>
                    <th>ملاحظات</th>
                </tr>
                </thead>
                <tbody>

                @forelse($results as $result)

                    @php
                        $geha_execution  = \App\Models\MokasherGehaInput::with('mokasher' ,'geha')->withCount('mokasher')->where('geha_id' , $result->geha_id)->get();
                        $total = 0 ;

                    @endphp
                    @if($result->mokasher->addedBy == 0 )
                    <tr>
                        <td  style="width: 25px !important;" >{{ $loop->iteration }}</td>
                        <td  style="width:100px !important;" >{{ $geha_execution->first()->geha->geha }}</td>
                        <td style="width: 300px !important;font-size: 12px !important;">
                            <table class="table table-responsive table-bordered">
                                <tbody>

                                @foreach($geha_execution as $key =>  $geha)
                                @if($key  == 60 )
                                @break
                                @endif
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


                                        <td style="width:260px; padding: 20px" ><br> {{ $geha->mokasher->name }} <br></td>
                                        <td style="width: 40px ;  font-size: 10px; padding: 20px">
                                            @if($performance < 50 )
                                                <span class="performance" style="background-color: #f00;margin: 10px  ">{{$performance}} %</span>
                                            @elseif($performance  >=  50 && $performance < 100 )
                                                <span class="performance" style="background-color: #f8de26;margin: 10px  ">{{round($performance)}} %</span>
                                            @elseif($performance  ==  100)
                                                <span class="performance" style="background-color: #00ff00;margin: 10px  ">{{round($performance)}} %</span>
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

</body>
</html>
