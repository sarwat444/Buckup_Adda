<?php

namespace App\Http\Controllers\Web\gehat;

use App\Http\Controllers\Controller;
use App\Models\MokasherInput;
use Illuminate\Http\Request;
use App\Models\Mokasher;
use Auth ;

class MokasherController extends Controller
{

    public function index()
    {
        //
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function mokashrt_geha()
    {
      $geha_id = Auth::user()->id;
      $mokashert =  MokasherInput::where('users' , $geha_id)->get();
      return view('gehat.moksherat.index' , compact('mokashert')) ;
    }
    public  function create_mokashrt_geha_data($id =null)
    {
         $mokasher_data = Mokasher::with('mokasher_geha_inputs')->find($id) ;
         return view('gehat.moksherat.create_mokaseerinput', compact('mokasher_data'));
    }
}
