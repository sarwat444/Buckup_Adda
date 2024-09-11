<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\programs\StoreProgramRequest;
use App\Http\Requests\Web\Admin\programs\UpdateProgramRequest;
use App\Models\Program;
use App\Models\Goal ;
use App\Traits\ResponseJson;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProgramController extends Controller
{
    use ResponseJson ;

    public function __construct(private readonly Program $programModel)
    {}

    public function show($goal_id =null ): \Illuminate\View\View
    {

        $goal  = Goal::find($goal_id) ;
        $programs = $this->programModel->withCount('moksherat')->where('goal_id' , $goal_id)->get() ;
        return view('admins.programs.index', compact('programs' ,  'goal_id' ,'goal' ));
    }
    public function create(): \Illuminate\View\View
    {
        return view('admins.programs.create');
    }

    public function store(StoreProgramRequest $storeProgramRequest): \Illuminate\Http\JsonResponse
    {
        $this->programModel->create($storeProgramRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => 'لقد تم أضافه البرنامج بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy(Program $program): \Illuminate\Http\RedirectResponse
    {
        $program->delete();
        return redirect()->route('dashboard.programs.show' ,$program->goal_id )->with('success', 'لقد تم  حذف البرنامج  بنجاح');
    }

    public function edit(Program $program): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson(['data' => $program], Response::HTTP_OK);
    }

    public function update(UpdateProgramRequest $updateProgramRequest, Program $program): \Illuminate\Http\RedirectResponse
    {
        $program->update($updateProgramRequest->validated());
        return redirect()->route('dashboard.programs.show' , $program->goal_id )->with('success', 'لقد تم  تعديل  البرنامج بنجاح');
    }
}
