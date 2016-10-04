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
        $user->area_id = 1;
        $user->user_type = 'V';
        $user->save();

        $user = new App\User();
        $user->name='Compras';
        $user->username='compras';
        $user->email = 'compras@mail.com';
        $user->password = bcrypt('S0meRandomStringX');
        $user->position = 'Almacén de compras';
        $user->area_id = 1;
        $user->user_type = 'V';
        $user->save();

        $user = new App\User();
        $user->name='Equipos Robados';
        $user->username='robados';
        $user->email = 'robados@mail.com';
        $user->password = bcrypt('S0meRandomStringX');
        $user->position = 'Almacén de articulos robados';
        $user->area_id = 1;
        $user->user_type = 'V';
        $user->save();

        $user = new App\User();
        $user->name='Equipos Dañados';
        $user->username='dañados';
        $user->email = 'dañados@mail.com';
        $user->password = bcrypt('S0meRandomStringX');
        $user->position = 'Almacén de articulos dañados';
        $user->area_id = 1;
        $user->user_type = 'V';
        $user->save();


        /**
        Usuarios reales
         */
        $role_user = App\Role::where('name', 'Admin')->first();
        $user = new User();
        $user->name='Johan Marchán';
        $user->username='jmarchan';
        $user->email = 'jmarchan@jockeyclub.com.ar';
        $user->password = bcrypt('Diego2201');
        $user->position = 'Desarrollador Sr.';
        $user->area_id = 2;
        $user->ext = '';
        $user->save();
        $user->roles()->attach($role_user);

        $role_user = App\Role::where('name', 'Admin')->first();
        $user = new App\User();
        $user->name='Martín Beltramo';
        $user->username='mbeltramo';
        $user->email = 'mbeltramo@jockeyclub.com.ar';
        $user->password = bcrypt('123456');
        $user->position = 'Jefe de Aplicaciones';
        $user->area_id = 2;
        $user->ext = '';
        $user->save();
        $user->roles()->attach($role_user);

        $role_user = App\Role::where('name', 'Admin')->first();
        $user = new App\User();
        $user->name='Hector Centurión';
        $user->username='hcenturion';
        $user->email = 'hcenturion@jockeyclub.com.ar';
        $user->password = bcrypt('123456');
        $user->position = 'Jefe de Infraestructura';
        $user->area_id = 1;
        $user->ext = '';
        $user->save();
        $user->roles()->attach($role_user);
    }
}
