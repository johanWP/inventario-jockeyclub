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
        /**
        Usuarios que correspenden a almacenes virtuales
         */

        $user = new App\User();
        $user->name='Almacen de Sistemas';
        $user->username='sistemas';
        $user->email = 'sistemas@mail.com';
        $user->password = bcrypt('S0meRandomStringX');
        $user->position = 'Almacén de Sistemas';
        $user->area_id = 999;
        $user->save();

        $user = new App\User();
        $user->name='Compras';
        $user->username='compras';
        $user->email = 'compras@mail.com';
        $user->password = bcrypt('S0meRandomStringX');
        $user->position = 'Almacén de compras';
        $user->area_id = 999;
        $user->save();

        $user = new App\User();
        $user->name='Equipos Robados';
        $user->username='robados';
        $user->email = 'robados@mail.com';
        $user->password = bcrypt('S0meRandomStringX');
        $user->position = 'Almacén de articulos robados';
        $user->area_id = 999;
        $user->save();

        $user = new App\User();
        $user->name='Equipos Dañados';
        $user->username='dañados';
        $user->email = 'dañados@mail.com';
        $user->password = bcrypt('S0meRandomStringX');
        $user->position = 'Almacén de articulos dañados';
        $user->area_id = 999;
        $user->save();


        /**
        Usuarios reales
         */
        $role_user = App\Role::where('name', 'Usuario')->first();
        $user = new App\User();
        $user->name='Matt Murdock';
        $user->username='mmurdock';
        $user->email = 'Matt@mail.com';
        $user->password = bcrypt('123456');
        $user->position = 'Vigilante';
        $user->area_id = 1;
        $user->ext = '1234';
        $user->save();
        $user->roles()->attach($role_user);

//        $role_user = App\Role::where('name', 'Usuario')->first();
        $user = new User();
        $user->name='Danny Rand';
        $user->username='drand';
        $user->email = 'ironFist@mail.com';
        $user->password = bcrypt('123456');
        $user->position = 'Profesor de karate';
        $user->area_id = 3;
        $user->ext = '3456';
        $user->save();
        $user->roles()->attach($role_user);

        $role_prov =App\Role::where('name', 'Proveedor')->first();
        $prov = new User();
        $prov->name='Wilson Fisk';
        $prov->username='wfisk';
        $prov->email = 'kingpin@mail.com';
        $prov->password = bcrypt('123456');
        $prov->position = 'Kingpin';
        $prov->area_id = 1;
        $prov->ext = '1895';
        $prov->save();
        $prov->roles()->attach($role_prov);

        $role_analista =App\Role::where('name', 'Analista')->first();
        $analista = new User();
        $analista->name='Jessica Jones';
        $analista->username='jjones';
        $analista->email = 'jessie@mail.com';
        $analista->password = bcrypt('123456');
        $analista->position = 'Detective';
        $analista->area_id = 2;
        $analista->ext = '2358';
        $analista->save();
        $analista->roles()->attach($role_analista);

    }
}
