<?php

use Illuminate\Database\Seeder;
use App\Sector;

class SectorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sector = new Sector();
        $sector->name = 'Administración';
        $sector->description = 'Esta es una descripción';
        $sector->email = 'adm@mail.com';
        $sector->office_id=1;
//        $sector->user_id=1;
        $sector->save();
        
        $sector = new Sector();
        $sector->name = 'Sistemas';
        $sector->description = 'Esta es una descripción de sistemas';
        $sector->email = 'sistemas@mail.com';
        $sector->office_id=1;
//        $sector->user_id=3;
        $sector->save();

        $sector = new Sector();
        $sector->name = 'Finanzas';
        $sector->description = 'Esta es una descripción finanzas';
        $sector->email = 'money@mail.com';
        $sector->office_id=1;
//        $sector->user_id=4;
        $sector->save();

    }
}
