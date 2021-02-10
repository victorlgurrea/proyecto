<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
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
  
        Role::create($request->all());
   
        return redirect()->route('roles.index')->with('success',__('role_created_success'));
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
    public function edit(int $id)
    {
        $rol = Role::FindOrFail($id);
        return view('roles.edit',compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'id' => 'required'
        ]);

        $input = $request->all();

        $affected = DB::table('roles')->where('id', $input['id'])->update(['name' => $input['name']]);
  
        return ($affected) ? redirect()->route('roles.index')->with('success',__('role_updated_success')) : redirect()->route('roles.index')->with('error',__('error_rol_updated'));
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $resquest = $request->all();

        $remove = DB::table('roles')->where("id", $request->id)->delete();
        
        
        return ($remove) ? redirect()->route('roles.index')->with('success',__('role_removed_success')) : redirect()->route('roles.index')->with('error',__('role_removed_error'));
    
    }

    public function delete($id)
    {
        $role_id = Role::where('id', $id)->first()->id;
        $role_name = Role::where('id', $id)->first()->name;
       
        $roles_user = DB::table('role_user')->where('role_id', $role_id)->count();
        
        $visible = ($roles_user > 0 ) ? 'invisible' : '';
        $message = ($roles_user > 0 ) ? __('role_info_dependence') : '';


        return view('partials.delete_modal', [
            'rute' => 'roles.destroy',
            'id'   => $role_id,
            'name' => $role_name,
            'visible' => $visible,
            'message' => $message,
        ]);
        
    }
}
