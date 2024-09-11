<?php

namespace App\Http\Controllers\Web\Site;

use App\Http\Controllers\Controller;
use App\Models\Goal;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    public function __construct(private readonly Goal $goalModel)
    {}
    public  function  show($objective_id =null)
    {
        $goals = $this->goalModel->with('objective')->withCount('programs')->where('objective_id' , $objective_id )->get();
        return view('gehat.goals.index', compact('goals' , 'objective_id' ));
    }
}
