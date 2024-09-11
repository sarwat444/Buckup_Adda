<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Category\UpdateCategoryRequest;
use App\Http\Requests\Web\Admin\Objectives\StoreObjectiveRequest;
use App\Http\Requests\Web\Admin\Objectives\UpdateObjectiveRequest;
use App\Models\Objective;
use App\Models\Kheta ;
use App\Traits\ResponseJson;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class objectivesController extends Controller
{
    use ResponseJson ;

    public function __construct(private readonly Objective $objectiveModel)
    {}
    public function show($kheta_id): \Illuminate\View\View
    {
        $kheta = Kheta::find($kheta_id) ;
        $objectives = $this->objectiveModel->withCount('goals')->where('kheta_id' , $kheta_id )->get() ;

        return view('admins.objectives.index', compact('objectives' , 'kheta_id' ,'kheta'));
    }
    public function create(): \Illuminate\View\View
    {
        return view('admins.objectives.create');
    }

    public function store(StoreObjectiveRequest $storeObjectiveRequest): \Illuminate\Http\JsonResponse
    {
        $this->objectiveModel->create($storeObjectiveRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => ' تم أضافه الغايه بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy(Objective $objective): \Illuminate\Http\RedirectResponse
    {
        $objective->delete();
        return redirect()->route('dashboard.objectives.show' , $objective->kheta_id)->with('success', ' تم  حذف الغايه  بنجاح');
    }

    public function edit(Objective $objective): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson(['data' => $objective], Response::HTTP_OK);
    }
    public function update(UpdateObjectiveRequest $updateObjectiveRequest, Objective $objective): \Illuminate\Http\RedirectResponse
    {
        $objective->update($updateObjectiveRequest->validated());
        return redirect()->route('dashboard.objectives.show' , $objective->kheta_id  )->with('success', ' تم  تعديل  الغايه بنجاح');
    }
}
