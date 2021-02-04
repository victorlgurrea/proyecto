<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name', 'Usuario')->first();
        $role_admin = Role::where('name', 'Administrador')->first();
        
        $user = new User();
        $user->name = 'Usuario';
        $user->surname = 'Prueba';
        $user->phone = '666666666';
        $user->email = 'usuarioprueba@example.com';
        $user->email_verified_at = date("Y-m-d H:i:s");
        $user->password = bcrypt('123456');
        $user->save();
        $user->roles()->attach($role_user);
        
        $user = new User();
        $user->name = 'Administrador';
        $user->surname = 'Prueba';
        $user->phone = '777777777';
        $user->email = 'administradorprueba@example.com';
        $user->email_verified_at = date("Y-m-d H:i:s");
        $user->password = bcrypt('123456');
        $user->save();
        $user->roles()->attach($role_admin);

    }
}
