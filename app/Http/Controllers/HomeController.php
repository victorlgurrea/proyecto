<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {  
        $roles_user = DB::table('role_user')->where('user_id', auth()->user()->id)->get();

        $roles_array = [];
        foreach($roles_user  as $rol) {
            array_push($roles_array, Role::where('id', $rol->role_id)->first()->name);
        }
        
        return view('home', [
            'roles_array' => $roles_array,
            ]);
    }
}
