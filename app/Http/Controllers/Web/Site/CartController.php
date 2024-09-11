<?php

namespace App\Http\Controllers\Web\Site;

use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Traits\ResponseJson;
use App\Models\Course;

class CartController extends Controller
{

    use ResponseJson;

    /**
     * dd(\Cart::getTotal());
     * dd(\Cart::getTotalQuantity());
     * */


    public function index()
    {
        $cartItems = \Cart::getContent();
        return view('cart', compact('cartItems'));
    }


    /**
     * @throws AuthorizationException
     */
    public function store(Course $course)
    {
        $this->authorize('enroll', $course);
        if (\Cart::get($course->id)) {
            return $this->responseJson([
                'type' => 'error',
                'message' => 'Item Cart Already Added !'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        \Cart::add(['id' => $course->id, 'name' => $course->name, 'price' => $course->price, 'quantity' => 1 , 'attributes' => ['image' => $course->getFirstMedia('courses')->getUrl('courses_thumb')]]);
        return $this->responseJson([
            'type' => 'success',
            'message' => 'Item Cart Add Successfully!'
        ], Response::HTTP_CREATED);
    }


    public function destroy(Course $course): \Illuminate\Http\RedirectResponse
    {
        \Cart::remove($course->id);
        session()->flash('success', 'Item Cart Remove Successfully !');
        return redirect()->back();
    }

    public function clearAllCart()
    {
        \Cart::clear();
        session()->flash('success', 'All Item Cart Clear Successfully !');
    }
}
