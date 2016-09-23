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
        $role_user = new Role();
        $role_user->name = 'Usuario';
        $role_user->description = 'Un usuario sin aprobación';
        $role_user->save();

        $role_analista = new Role();
        $role_analista->name = 'Analista';
        $role_analista->description = 'Un analista de proveedores';
        $role_analista->save();

        $role_prov = new Role();
        $role_prov->name = 'Proveedor';
        $role_prov->description = 'Un Proveedor externo';
        $role_prov->save();

        $role_admin = new Role();
        $role_admin->name = 'Admin';
        $role_admin->description = 'Un Administrador';
        $role_admin->save();
    }
}
