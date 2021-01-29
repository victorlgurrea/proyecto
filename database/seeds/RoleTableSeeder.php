<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'Administrador';
        $role->save();
        
        $role = new Role();
        $role->name = 'Usuario';
        $role->save();

        $role = new Role();
        $role->name = 'Distribuidor';
        $role->save();

        $role = new Role();
        $role->name = 'Cliente';
        $role->save();

        $role = new Role();
        $role->name = 'Gerente';
        $role->save();

        $role = new Role();
        $role->name = 'Sede';
        $role->save();

        $role = new Role();
        $role->name = 'Encargado';
        $role->save();
    }
}
