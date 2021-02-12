<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partner;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::all();
        return view('partners.index', ['partners' => $partners]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('partners.create');
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
  
        Partner::create($request->all());
   
        return redirect()->route('partners.index')->with('success',__('success_new_partner'));
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
     * @param  App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner)
    {
        return view('partners.edit',compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Partner  $sector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => 'required',
        ]);
  
        $partner->update($request->all());
  
        return redirect()->route('partners.index')->with('success',__('success_edit_type_partner'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();
  
        return redirect()->route('partners.index')->with('success',__('success_remove_type_partner'));
    }

    public function delete($id)
    {
        $partner_id = Partner::where('id', $id)->first()->id;
        $partner_name = Partner::where('id', $id)->first()->name;
        $visible = "";
       
        return view('partials.delete_modal', [
            'rute' => 'partners.destroy',
            'id'   => $partner_id,
            'name' => $partner_name,
            'visible' => $visible,
            'message' => '',
        ]);
        
    }
}
