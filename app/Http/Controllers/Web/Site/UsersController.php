<?php

namespace App\Http\Controllers\Web\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\users\StoreUserRequest;
use App\Http\Requests\Web\Admin\users\UpdateUserRequest;
use App\Models\Execution_year;
use App\Models\Mangement;
use App\Models\Mokasher;
use App\Models\MokasherGehaInput;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\PDFService;
use App\Models\Kheta ;

class UsersController extends Controller
{
    public function __construct(private User $user, PDFService $pdfService)
    {

    }

    public function index()
    {
        $users = $this->user->where(['geha_id' => Auth::user()->id])->get();
        return view('gehat.users.index')->with(compact('users'));
    }

    public function create()
    {
        $mangements = Mangement::get();
        return view('gehat.users.create')->with(compact('mangements'));
    }

    public function store(StoreUserRequest $storeUserRequest): \Illuminate\Http\RedirectResponse
    {
        $userData = $storeUserRequest->safe()->except(['_token']);
        $userData['password'] = Hash::make($userData['password']);

        $this->user->create($userData);

        return redirect()->back()->with('success', 'تم أضافة الجهة بنجاح');
    }

    public function edit($id = null): \Illuminate\View\View
    {
        $user = User::with('mangemnet')->find($id);
        $mangements = Mangement::get();
        return view('gehat.users.edit-user')->with(compact('user', 'mangements'));
    }

    public function update(UpdateUserRequest $userRequest, $id): \Illuminate\Http\RedirectResponse
    {
        $user_data = User::find($id);
        $old_password = $user_data['password'];
        $is_manger = $userRequest->is_manger;

        $new_user_request = $userRequest->safe()->except(['_token']);
        if ($user_data) {
            if (!empty($new_user_request['password'])) {
                $new_user_request['password'] = Hash::make($new_user_request['password']);
            } else {
                $new_user_request['password'] = $old_password;
            }

            if (!empty($new_user_request['is_manger']) && $new_user_request['is_manger'] == 'on') {
                $new_user_request['is_manger'] = 1;
            } else {
                $new_user_request['is_manger'] = 0;
            }


            $user_data->update($new_user_request);
            return redirect()->back()->with('success', 'تم تعديل  بيانات الجهه بنجاح');
        } else {
            return redirect()->back()->with('error', 'الجهه ليست موجوده');
        }
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $user = $this->user->find($id);
        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'لقد تم حذف  الجهه بنجاح ');
        }
        return redirect()->back()->with('error', 'User Not Found ');
    }

    /** Report For Every Part - Report  #1  */
    public function get_users_reports(Request $request)
    {
        if ($request->isMethod('post')) {
            if (!empty($request->geha)) {
                $selected_geha = $request->geha;
                $part = $request->part;

                $results = MokasherGehaInput::with('mokasher', 'geha')
                    ->where('geha_id', $selected_geha)
                    ->selectRaw("*, part_{$part} as mostahdf, rate_part_{$part} as rating, note_part_{$part} as note")
                    ->get();
                return view('gehat.reports.mokashert_parts_report', compact('results', 'selected_geha', 'part'));
            }
        } else {
            return view('gehat.reports.mokashert_parts_report');
        }

    }


    /** Print Parts Report */


    /** Report For Every yesr - Report  #2  */
    public function get_users_reports_year(Request $request)
    {

        $sub_geha = $request->sub_geha;
        $year_id = $request->year_id;
        $gehat = $this->user->where('geha_id', Auth::user()->id)->get();
        $kehta_id = Auth::user()->kehta_id;
        $years = Execution_year::where('kheta_id', $kehta_id)->get();

        if ($request->isMethod('post')) {
            $results = MokasherGehaInput::with('mokasher', 'geha' , 'mokasher.program' , 'mokasher.program.goal' , 'mokasher.program.goal.objective')
                ->where(['geha_id' => $request->geha, 'year_id' => $request->year_id])
                ->selectRaw("*, (part_1 + part_2 + part_3 + part_4) AS mostahdf  , (rate_part_1 + rate_part_2 + rate_part_3 + rate_part_4) AS rating")
                ->get();

                return view('gehat.reports.mokashert_year_report', compact('results', 'gehat', 'sub_geha', 'year_id', 'years' , 'kehta_id'));
        } else {
            return view('gehat.reports.mokashert_year_report', compact('gehat', 'years', 'sub_geha', 'year_id'));
        }
    }

    /** Print Years Report */

    public function print_users_part($geha, $part)
    {
        $geha_name = User::where('id' , $geha)->first() ;

        $results = MokasherGehaInput::query()
            ->with(['mokasher', 'geha', 'mokasher.program', 'mokasher.program.goal', 'mokasher.program.goal.objective'])
            ->join('mokashers', 'mokashers.id', '=', 'mokasher_geha_inputs.mokasher_id')
            ->join('programs', 'programs.id', '=', 'mokashers.program_id')
            ->join('goals', 'goals.id', '=', 'programs.goal_id')
            ->join('objectives', 'objectives.id', '=', 'goals.objective_id')
            ->where('mokasher_geha_inputs.geha_id', $geha)
            ->selectRaw("
            mokasher_geha_inputs.*,
            part_{$part} as mostahdf,
            rate_part_{$part} as rating,
            note_part_{$part} as note
        ")
            ->orderBy('objectives.id')
            ->orderBy('goals.id')
            ->orderBy('programs.id')
            ->orderBy('mokashers.id')
            ->get();


        $selected_geha =  $geha ;

        return  view('admins.new_reports.users_part_years' , compact('results'  , 'selected_geha' , 'part'  , 'geha_name')) ;
    }


    public function print_users_years($geha, $year_id)
    {
        $results = MokasherGehaInput::with([
            'mokasher',
            'geha',
            'mokasher.program',
            'mokasher.program.goal',
            'mokasher.program.goal.objective'
        ])
            ->join('mokashers', 'mokashers.id', '=', 'mokasher_geha_inputs.mokasher_id')
            ->join('programs', 'programs.id', '=', 'mokashers.program_id')
            ->join('goals', 'goals.id', '=', 'programs.goal_id')
            ->join('objectives', 'objectives.id', '=', 'goals.objective_id')
            ->where(['geha_id' => $geha, 'year_id' => $year_id])
            ->selectRaw("mokasher_geha_inputs.*, (part_1 + part_2 + part_3 + part_4) AS mostahdf, (rate_part_1 + rate_part_2 + rate_part_3 + rate_part_4) AS rating")
            ->orderBy('objectives.id', 'asc')  // ترتيب الغايات
            ->orderBy('goals.id', 'asc')       // ترتيب الأهداف
            ->orderBy('programs.id', 'asc')    // ترتيب البرامج
            ->orderBy('mokashers.id', 'asc')   // ترتيب المؤشرات
            ->get();

        return view('gehat.new_reports.users_years', compact('results'));
        }

}
