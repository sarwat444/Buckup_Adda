<?php

namespace App\Http\Controllers\Web\Site;

use App\Http\Controllers\Controller;
use App\Models\Objective;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ObjectiveController extends Controller
{
    public function __construct(private readonly Objective $objectiveModel)
    {}
    public function index(): \Illuminate\View\View
    {
        $kheta_id = Auth::user()->kehta_id ;
        $objectives = $this->objectiveModel->withCount('goals')->where('kheta_id' , $kheta_id )->get() ;
        return view('gehat.objectives.index', compact('objectives'));
    }
}
