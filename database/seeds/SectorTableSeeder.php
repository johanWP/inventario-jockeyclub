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
        $sector->name = 'Sistemas';
        $sector->description = 'Esta es una descripción de sistemas';
        $sector->email = 'sistemas@mail.com';
        $sector->office_id=1;
        $sector->save();
    }
}
