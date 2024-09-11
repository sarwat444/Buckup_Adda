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

    /** Print Parts Report */


    /** Report For Every yesr - Report  #2  */
    public function get_users_reports_year(Request $request)
    {

        $sub_geha = $request->sub_geha;
        $year_id = $request->year_id;

        $gehat = $this->user->where('geha_id', Auth::user()->id)->get();
        $kheta_id = Auth::user()->kehta_id;
        $years = Execution_year::where('kheta_id', $kheta_id)->get();

        if ($request->isMethod('post')) {
            if (!empty($request->sub_geha)) {
                $selected_geha = $request->sub_geha;

                $results = MokasherGehaInput::with('mokasher', 'sub_geha')
                    ->where('geha_id', Auth::user()->id)
                    ->where(['sub_geha_id' => $request->sub_geha, 'year_id' => $request->year_id])
                    ->selectRaw("*, (part_1 + part_2 + part_3 + part_4) AS mostahdf  , (rate_part_1 + rate_part_2 + rate_part_3 + rate_part_4) AS rating")
                    ->get();

                return view('gehat.reports.mokashert_year_report', compact('results', 'gehat', 'sub_geha', 'year_id', 'years'));
            }
        } else {
            return view('gehat.reports.mokashert_year_report', compact('gehat', 'years', 'sub_geha', 'year_id'));
        }
    }

    /** Print Years Report */

    public function print_users_part($sub_geha, $part)
    {

        $gehat = User::where('geha_id', Auth::user()->id)->get();
        $kheta = Kheta::where('id' ,  Auth::user()->kehta_id)->first() ;
        $results = MokasherGehaInput::with('mokasher', 'sub_geha')
            ->where('sub_geha_id', $sub_geha)
            ->selectRaw("* ,part_{$part} as mostahdf , rate_part_{$part} as rating , note_part_{$part} as note")
            ->get();

        $data = [
            'results' => $results,
            'gehat' => $gehat,
            'kheta_name' => $kheta->name,
            'kehta_image' =>  $kheta->image ,
            'selected_geha' => $sub_geha,
            'report_name' => 'تقرير جهات ربع سنوى ' ,
        ];

        // Generate PDF using TCPDF
        $pdfService = new PDFService();
        $pdfService->generateMokasherPartsPDF($data, 'mokashert_parts.pdf');
    }


    public function print_users_years($sub_geha, $year_id)
    {
        $gehat = User::where('geha_id', Auth::user()->id)->get();
        $kheta = Kheta::where('id' ,  Auth::user()->kehta_id)->first() ;
        $results = MokasherGehaInput::with('mokasher', 'sub_geha')
            ->where('geha_id', Auth::user()->id)
            ->where(['sub_geha_id' => $sub_geha, 'year_id' => $year_id])
            ->selectRaw("*, (part_1 + part_2 + part_3 + part_4) AS mostahdf  , (rate_part_1 + rate_part_2 + rate_part_3 + rate_part_4) AS rating")
            ->get();

        $data = [
            'results' => $results,
            'gehat' => $gehat,
            'kheta_name' => $kheta->name,
            'kehta_image' =>  $kheta->image ,
            'report_name' => 'تقرير جهات  السنوى ' ,
            'selected_geha' => $sub_geha,
        ];

        // Generate PDF using TCPDF
        $pdfService = new PDFService();
        $pdfService->generateMokasherYearsPDF($data, 'mokashert_years.pdf');
    }


}
