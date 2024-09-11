<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SetLanguageController extends Controller
{
    public function __invoke(Request $request, $lang): \Illuminate\Http\RedirectResponse
    {
        $request->session()->put('locale', $lang);
        return redirect()->back()->with(['success' => 'Language changed successfully']);
    }
}
