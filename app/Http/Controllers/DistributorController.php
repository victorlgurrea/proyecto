<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Distributor;

class DistributorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distributors = Distributor::all();
        return view('distributors.index', ['distributors' => $distributors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('distributors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
  
        Distributor::create($request->all());
   
        return redirect()->route('distributors.index')->with('success',__('success_new_distributor'));
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
     * @param  App\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function edit(Distributor $distributor)
    {
        return view('distributors.edit',compact('distributor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Distributor $distributor)
    {
        $request->validate([
            'name' => 'required',
        ]);
  
        $distributor->update($request->all());
  
        return redirect()->route('distributors.index')->with('success',__('success_edit_dealer'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Distributor $distributor)
    {
        $distributor->delete();
        
        return redirect()->route('distributors.index')->with('success',__('success_remove_type_distributor'));
    }

    public function delete($id)
    {
        $distributor_id = Distributor::where('id', $id)->first()->id;
        $distributor_name = Distributor::where('id', $id)->first()->name;
        $visible = "";
       
        return view('partials.delete_modal', [
            'rute' => 'distributors.destroy',
            'id'   => $distributor_id,
            'name' => $distributor_name,
            'visible' => $visible,
            'message' => '',
        ]);
    }
}
