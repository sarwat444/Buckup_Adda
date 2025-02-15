
@if(!empty($results))
    <div class="Report_Date">
        <p> تاريخ التقرير : <?php echo date('d-m-Y'); ?></p>
    </div>
    <div class="table-responsive" >
        <table class="table table-striped table-striped">
            <thead class="table-head">
            <tr>
                <th style="width: 25px !important;">#</th>
                <th style="width:100px !important;">الجهات المنفذه </th>
                <th style="width: 300px !important;">المؤشر</th>
                <th>ملاحظات</th>
            </tr>
            </thead>
            <tbody>
            @forelse($results as $result)
                @if(!empty($part))
                    @php
                        $geha_execution = \App\Models\MokasherGehaInput::with('mokasher', 'geha')->withCount('mokasher')->where('geha_id', $result->geha_id)->get();
                    @endphp
                    @if($result->mokasher->addedBy == 0 )
                    <tr>
                        <td style="width: 25px !important;">{{ $loop->iteration }}</td>
                        <td style="width: 300px !important;">{{ $result->mokasher->name }}</td>
                        <td style="width: 100px !important;">
                            @foreach($geha_execution as $geha)
                                @php
                                    if($geha->{"part_".$part} > 0 ) {
                                        $performance = ($geha->{"rate_part_".$part}) / ($geha->{"part_".$part}) * 100;
                                    } else {
                                        $performance = 0;
                                    }
                                @endphp
                                {{ $geha->geha->geha }}
                                @if($performance < 50)
                                    <span class="performance" style="background-color: #f00">{{ round($performance) }} %</span>
                                @elseif($performance >= 50 && $performance < 100)
                                    <span class="performance" style="background-color: #f8de26">{{ round($performance) }} %</span>
                                @elseif($performance == 100)
                                    <span class="performance" style="background-color: #00ff00">{{ round($performance) }} %</span>
                                @endif
                            <br>
                            @endforeach
                        </td>
                        <td>
                            @if(!empty($result->note))
                                {{ $result->note }}
                            @else
                                <span class="badge badge-soft-danger">لا يوجد ملاحظات</span>
                            @endif
                        </td>
                    </tr>
                    @endif
                @else
                    @php
                        $geha_execution = \App\Models\MokasherGehaInput::with('mokasher', 'geha')->withCount('mokasher')->where('geha_id', $result->geha_id)->get();
                    @endphp
                    @php
                        $types = json_decode($geha_execution->first()->mokasher->type);
                    @endphp
                    @if(in_array(0, $types))
                        @if($result->mokasher->addedBy == 0 )
                        <tr>
                            <td style="width: 25px !important;">{{ $loop->iteration }}</td>
                            <td style="width: 100px !important;" rowspan="{{ $geha_execution->count() }}">{{ $geha_execution->first()->geha->geha }}</td>
                            <td style="width: 300px !important;">
                                @foreach($geha_execution as $geha)
                                    @php
                                        $performance = ($geha->rate_part_1 + $geha->rate_part_2 + $geha->rate_part_3 + $geha->rate_part_4) / ($geha->part_1 + $geha->part_2 + $geha->part_3 + $geha->part_4) * 100;
                                    @endphp
                                    @if(!empty($geha->mokasher->type))
                                        @php
                                            $types = json_decode($geha->mokasher->type);
                                        @endphp
                                        @if(in_array(0, $types))
                                            {{ $geha->mokasher->name }}
                                            @if($performance < 50)
                                                <span class="performance" style="background-color: #f00 ">{{ $performance }} %</span>
                                            @elseif($performance >= 50 && $performance < 100)
                                                <span class="performance" style="background-color: #f8de26 ">{{ round($performance) }} %</span>
                                            @elseif($performance == 100)
                                                <span class="performance" style="background-color: #00ff00 ">{{ round($performance) }} %</span>
                                            @endif
                                        @endif
                                    @endif
                                    <br>
                                @endforeach
                            </td>
                            <td>
                                @if(!empty($result->note))
                                    {{ $result->note }}
                                @else
                                    <span class="badge badge-soft-danger">لا يوجد ملاحظات</span>
                                @endif
                            </td>
                        </tr>
                        @endif
                    @endif
                @endif
            @empty
            @endforelse

            </tbody>
        </table>
    </div>
@else
    <span class="badge badge-soft-danger font-size-13">برجاء أختيار السنه  المطلوبه</span>
@endif