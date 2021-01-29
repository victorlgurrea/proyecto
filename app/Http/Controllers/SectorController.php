<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sector;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectors = Sector::paginate(10);

        return view('sectors.index', compact('sectors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sectors.create');
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
  
        Sector::create($request->all());
   
        return redirect()->route('sectors.index')->with('success','Sector creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function show(Sector $sector)
    {
        return view('sectors.show',compact('sector'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function edit(Sector $sector)
    {
        return view('sectors.edit',compact('sector'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sector $sector)
    {
        $request->validate([
            'name' => 'required',
        ]);
  
        $sector->update($request->all());
  
        return redirect()->route('sectors.index')->with('success','Sector actualizado correctamente');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sector $sector)
    {
        $sector->delete();
  
        return redirect()->route('sectors.index')->with('success','Sector eliminado correctamente');
    
    }

    public function delete($id)
    {
        $sector_id = Sector::where('id', $id)->first()->id;
        $sector_name = Sector::where('id', $id)->first()->name;
       
        return view('partials.delete_modal', [
            'rute' => "route('sectors.destroy', " . $sector_id. ")", 
            'name' => $sector_name,
        ]);
        
    }
}
