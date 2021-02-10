<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['string', 'max:255'],
            'phone' => ['string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('surname', 'asc')->get();
        foreach($users as $user){
            $roles_user = $user->roles->toArray();
            $roles = array_map(function($rol) { return $rol['name']; }, 
                $roles_user);
            $user->roles = implode(", ", $roles);
        }

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::orderBy('name','asc')->get();
        return view('users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $user =  User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        foreach($data['roles'] as $rol) {
            $user->roles()->attach(Role::where('name', $rol)->first());
        }

        $user->sendEmailVerificationNotification();
        
        return redirect()->route('users.index')->with('success',__('user_created_success'));
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
        $user = User::where('id', $id)->firstOrFail();
        $roles = Role::orderBy('name','desc')->get();
        $roles_user = DB::table('role_user')->where("user_id", $id)->get();
  
        $array_roles = [];
        foreach ($roles_user as $rol) {
            $rol_name = DB::table('roles')->where('id', $rol->role_id)->first();
            array_push($array_roles, $rol_name->name);
        }

        return view('users.edit',['user'=>$user, 'roles' => $roles, 'array_roles' => $array_roles]);
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
        $input = $request->all();
        $user = DB::table('users')->where('id', $id)->first();
      
        //controlamos que el usuario tengo roles asociados en la tabla pivote
        $count_roles = DB::table('role_user')->where("user_id", $id)->count();

        // si tiene roles asociadolos los eliminamos primero
        if($count_roles > 0) {
            $remove_roles_user = DB::table('role_user')->where("user_id", $id)->delete();
        }

        //le añadimos los roles que vengan ahora en el post en la tabla pivote
        if($remove_roles_user) {
            foreach($input['roles'] as $rol) {
                $rol = Role::where('name', $rol)->first();
                $insert_role = DB::table('role_user')->insert(['role_id' => $rol->id, 'user_id' => $user->id, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]);
            }
        }

        //Ahora actualizamos los datos del usuario 
        $affected_user = DB::table('users')->where('id', $user->id)->update([
            'name'    => $input['name'],
            'surname' => $input['surname'],
            'email'   => $input['email'],
            'phone'   => $input['phone'],
        ]);
        
        return ($affected_user) ? redirect()->route('users.index')->with('success',__('user_edited_success')) : redirect()->route('users.index')->with('error',__('user_edited_error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $input = $request->all();

        //controlamos que el usuario tengo roles asociados en la tabla pivote
        $count_roles = DB::table('role_user')->where("user_id", $input['id'])->count();

        // si tiene roles asociadolos los eliminamos primero
        if($count_roles > 0) {
            $remove_roles_user = DB::table('role_user')->where("user_id", $input['id'])->delete();
        }
        
        //Si tienes roles y da problemas eliminar sus roles en la tabla pivote return error eliminando usuario 
        if($count_roles > 0 && ! $remove_roles_user) {
            return redirect()->route('users.index')->with('error',__('roles_user_removed_error'));
        }

        $remove = DB::table('users')->where("id", $input['id'])->delete();

        return ($remove) ? redirect()->route('users.index')->with('success',__('user_removed_success')) : redirect()->route('users.index')->with('error',__('user_removed_error'));

    }

    public function delete($id)
    {

        $user_id = User::where('id', $id)->first()->id;
        $user_name = User::where('id', $id)->first()->name;
        $user_surname = User::where('id', $id)->first()->surname;

        $visible = 'visible';
        $message =  '';


        return view('partials.delete_modal', [
            'rute' => 'users.destroy',
            'id'   => $user_id,
            'name' => $user_name . " " . $user_surname,
            'visible' => $visible,
            'message' => $message,
        ]);
        
    }
}
