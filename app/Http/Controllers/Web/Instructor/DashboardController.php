<?php

namespace App\Http\Controllers\Web\Instructor;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        return view('instructors.dashboard.index');
    }
}
