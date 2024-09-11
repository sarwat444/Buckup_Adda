<?php

namespace App\Http\Controllers\Web\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        abort_if(\Cart::isEmpty(), 404);
        $items = \Cart::getContent();
        return view('site.checkout.index', compact('items'));
    }


    public function store()
    {
        foreach (\Cart::getContent() as $item) {
            auth()->user()->enrollments()->create([
                'course_id' => $item->id,
            ]);
        }

        \Cart::clear();
        session()->flash('success', 'Your Order Has Been Placed Successfully !');
        return redirect()->route('site.home');
    }
}
