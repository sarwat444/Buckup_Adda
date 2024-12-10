<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\mokashers\StoreMokasherRequest;
use App\Http\Requests\Web\Admin\mokashers\UpdateMokasherRequest;
use App\Http\Requests\Web\Admin\users\StoremokasharatInputs;
use App\Models\Execution_year;
use App\Models\Kheta;
use App\Models\Mokasher;
use App\Models\MokasherInput;
use App\Models\Program;
use App\Models\User;
use App\Models\MokasherGehaInput ;
use App\Traits\ResponseJson;
use Illuminate\Http\Request;
use App\Models\MokasherExecutionYear ;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Services\PDFService;

class MokasherController extends Controller
{
    use ResponseJson ;

    public function __construct(private readonly Mokasher $mokasherModel)
    {}
    public function show($program_id =null ): \Illuminate\View\View
    {
        $program = Program::find($program_id) ;
        $mokashert = $this->mokasherModel->with('addedBy_fun')->where(['program_id' => $program_id , 'addedBy' => 0 ])->get() ;
        return view('admins.moksherat.index', compact('mokashert' ,  'program_id' , 'program'));
    }

    public function create(): \Illuminate\View\View
    {
        return view('admins.moksherat.create');
    }

    public function store(StoreMokasherRequest $StoreMokasherRequest): \Illuminate\Http\JsonResponse
    {

        $mokasher = new Mokasher() ;
        $mokasher->name = $StoreMokasherRequest->name ;
        $mokasher->type = json_encode($StoreMokasherRequest->type);
        $mokasher->program_id = $StoreMokasherRequest->program_id ;
        $mokasher->save() ;
        // Return a JSON response indicating success
        return $this->responseJson(['type' => 'success', 'message' => 'تم أضافه المؤشر بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy($mokasher_id = null): \Illuminate\Http\RedirectResponse
    {
        $found_mokaser = Mokasher::find($mokasher_id) ;
        $program_id = $found_mokaser->program_id ;
        $found_mokaser->delete();
        return redirect()->route('dashboard.moksherat.show',$program_id )->with('success', ' تم  حذف المؤشر  بنجاح');
    }

    public function edit($id = null)
    {
        $mokasher = Mokasher::find($id) ;
        return view('admins.moksherat.edit' , compact('mokasher'));
    }

    public function update(UpdateMokasherRequest $UpdateMokasherRequest): \Illuminate\Http\RedirectResponse
    {
        $mokasher = Mokasher::find($UpdateMokasherRequest->id)  ;
        $mokasher->update($UpdateMokasherRequest->validated());
        return redirect()->route('dashboard.moksherat.show',$UpdateMokasherRequest->program_id)->with('success', ' تم  تعديل  المؤشر بنجاح');
    }
    public function mokaseerinput($mokasher_id)
    {
        $mokasher = Mokasher::with('mokasher_inputs', 'mokasher_geha_inputs' , 'program' , 'program.goal.Objective.kheta')->find($mokasher_id) ;
        $kheta_id = $mokasher->program->goal->Objective->kheta->id ;
        $users = User::where('is_manger' , 1)->get() ;
        $mokasher = Mokasher::with('mokasher_inputs', 'mokasher_geha_inputs' , 'program' , 'program.goal.Objective.kheta')->find($mokasher_id) ;
        $kheta_id = $mokasher->program->goal->Objective->kheta->id ;

        $excuction_years = Execution_year::with(['MokasherExcutionYears' => function ($query) use ($mokasher_id) {
            $query->where('mokasher_id', $mokasher_id);
        }])->where('kheta_id', $kheta_id)->get();

        $users = User::where(['is_manger' =>  1 ,'kehta_id' => $kheta_id ])->get() ;

        return view('admins.moksherat.create_mokaseerinput' , compact('mokasher' ,'users' ,'mokasher_id' , 'excuction_years'));

    }
    public function store_mokaseerinput(StoremokasharatInputs $StoremokasharatInputs)
    {

        $mokasher_data = MokasherInput::updateOrCreate(
            ['mokasher_id' => $StoremokasharatInputs->mokasher_id],
            [
                'users' => json_encode($StoremokasharatInputs->users),
                'equation' => $StoremokasharatInputs->equation,
                'type' => $StoremokasharatInputs->type,
            ]
        );

        if(!empty($StoremokasharatInputs->ids)) {
            foreach ($StoremokasharatInputs->ids as $Key => $id) {
                    MokasherExecutionYear::updateOrCreate([
                        'mokasher_id' => $StoremokasharatInputs->mokasher_id,
                        'year_id' => $id ,
                    ],
                    [
                        'value' => $StoremokasharatInputs->years[$Key]
                    ]
                );
            }
        }
        // Redirect back or return a response
        return redirect()->back()->with('success', 'تم أضافة بيانات المؤشر بنجاح');
    }


    // تقرير الربع سنوي للجهات
    public function quarter_year(Request $request , $kehta_id)
    {
        $gehat = User::where(['is_manger'=> 1 , 'kehta_id' => $kehta_id])->get();
        if ($request->isMethod('post')) {
            if (!empty($request->geha)) {
                $selected_geha = $request->geha;
                $part = $request->part;

                $results = MokasherGehaInput::with('mokasher', 'geha')
                    ->where('geha_id', $request->geha)
                    ->selectRaw("* ,part_{$request->part} as mostahdf , rate_part_{$request->part} as rating , note_part_{$request->part} as note")
                    ->get();
                return view('admins.reports.quarter_year', compact('results', 'gehat', 'selected_geha', 'part' ,'kehta_id'));
            }
        } else {
            return view('admins.reports.quarter_year', compact('gehat' ,'kehta_id'));
        }
    }

    public function get_users_reports_year(Request $request , $kehta_id )
    {
        $geha = $request->geha;
        $year_id = $request->year_id;
        $gehat = User::where(['is_manger'=> 1 , 'kehta_id' => $kehta_id])->get();
        $years = Execution_year::where('kheta_id', $kehta_id)->get();

        if ($request->isMethod('post')) {
            if (!empty($request->geha)) {
                $selected_geha = $request->geha;
                $results = MokasherGehaInput::with('mokasher', 'geha' , 'mokasher.program' , 'mokasher.program.goal' , 'mokasher.program.goal.objective')
                    ->where(['geha_id' => $request->geha, 'year_id' => $request->year_id])
                    ->selectRaw("*, (part_1 + part_2 + part_3 + part_4) AS mostahdf  , (rate_part_1 + rate_part_2 + rate_part_3 + rate_part_4) AS rating")
                    ->get();

                return view('admins.reports.mokashert_year_report', compact('results', 'gehat', 'geha', 'year_id', 'years' ,'kehta_id' ,'selected_geha'));
            }
        } else {
            return view('admins.reports.mokashert_year_report', compact('gehat', 'years', 'geha', 'year_id' ,'kehta_id'));
        }
    }


    public function get_users_reports(Request $request)
    {

        $gehat = $this->user->where('geha_id', Auth::user()->id)->get();
        if ($request->isMethod('post')) {
            if (!empty($request->sub_geha)) {

                $selected_geha = $request->sub_geha;
                $part = $request->part;

                $results = MokasherGehaInput::with('mokasher', 'sub_geha')
                    ->where('sub_geha_id', $request->sub_geha)
                    ->selectRaw("* ,part_{$request->part} as mostahdf , rate_part_{$request->part} as rating , note_part_{$request->part} as note")
                    ->get();

                return view('gehat.reports.mokashert_parts_report', compact('results', 'gehat', 'selected_geha', 'part'));
            }
        } else {
            return view('gehat.reports.mokashert_parts_report', compact('gehat'));
        }
    }

    public function print_users_part($geha, $part , $kehta_id)
    {

        $gehat = User::where(['is_manger'=> 1 , 'kehta_id' => $kehta_id])->get();
        $kheta = Kheta::where('id' ,  $kehta_id)->first() ;
        $results = MokasherGehaInput::with('mokasher', 'geha')
            ->where('geha_id', $geha)
            ->selectRaw("* ,part_{$part} as mostahdf , rate_part_{$part} as rating , note_part_{$part} as note")
            ->get();


        $data = [
            'results' => $results,
            'gehat' => $gehat,
            'kheta_name' => $kheta->name,
            'kehta_image' =>  $kheta->image ,
            'selected_geha' => $geha,
            'report_name' => 'تقرير جهات ربع سنوى ' ,
        ];

        // Generate PDF using TCPDF
        $pdfService = new PDFService();
        $pdfService->generateMokasherPartsPDF2($data, 'mokashert_parts.pdf');
    }


    public function print_users_years($geha, $year_id , $kehta_id)
    {
        $gehat = User::where(['is_manger'=> 1 , 'kehta_id' => $kehta_id])->get();
        $kheta = Kheta::where('id' ,  $kehta_id)->first() ;

        $results = MokasherGehaInput::with('mokasher', 'geha' , 'mokasher.program' , 'mokasher.program.goal' , 'mokasher.program.goal.objective')
            ->where(['geha_id' => $geha, 'year_id' =>$year_id])
            ->selectRaw("*, (part_1 + part_2 + part_3 + part_4) AS mostahdf  , (rate_part_1 + rate_part_2 + rate_part_3 + rate_part_4) AS rating")
            ->get();
        $data = [
            'results' => $results,
            'gehat' => $gehat,
            'kheta_name' => $kheta->name,
            'kehta_image' =>  $kheta->image ,
            'report_name' => 'تقرير جهات  السنوى ' ,
            'selected_geha' => $geha,
        ];

        // Generate PDF using TCPDF
        $pdfService = new PDFService();
        $pdfService->generateMokasherYearsPDF2($data, 'mokashert_years.pdf');
    }

}
