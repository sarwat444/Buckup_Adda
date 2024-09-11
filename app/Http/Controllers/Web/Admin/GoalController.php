<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Goals\StoreGoolRequest;
use App\Http\Requests\Web\Admin\Goals\UpdateGoolRequest;
use App\Models\Goal;
use App\Traits\ResponseJson;
use Illuminate\Http\Request;
use App\Models\Objective ;
use Symfony\Component\HttpFoundation\Response;

class GoalController extends Controller
{
    use ResponseJson ;
    public function __construct(private readonly Goal $goalModel)
    {}
    public  function  show($objective_id =null)
    {
        $objective = Objective::find($objective_id);
        $goals = $this->goalModel->withCount('programs')->where('objective_id' , $objective_id )->get();
        return view('admins.goals.index', compact('goals' , 'objective_id' , 'objective'));
    }
    public function create(): \Illuminate\View\View
    {
        return view('admins.goals.create');
    }
    public function store(StoreGoolRequest $storeGoolRequest): \Illuminate\Http\JsonResponse
    {
        $this->goalModel->create($storeGoolRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => ' تم أضافه الهدف بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy(Goal $goal): \Illuminate\Http\RedirectResponse
    {
        $goal->delete();
        return redirect()->route('dashboard.goals.show' , $goal['objective_id'])->with('success', ' تم  حذف الهدف  بنجاح');
    }

    public function edit(Goal $goal): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson(['data' => $goal], Response::HTTP_OK);
    }

    public function update(UpdateGoolRequest $updateGoalRequest, Goal $goal): \Illuminate\Http\RedirectResponse
    {
        $goal->update($updateGoalRequest->validated());
        return redirect()->route('dashboard.goals.show' ,$goal->objective_id )->with('success', ' تم  تعديل  الهدف بنجاح');
    }
}
