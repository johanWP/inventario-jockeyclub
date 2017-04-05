<?php

use Illuminate\Database\Seeder;
use App\Area;

class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $area = new Area();
        $area->name = 'Infraestructura';
        $area->description = 'Esta es el área que instala los equipos';
        $area->email = 'tecnica@jockeyclub.com.ar';
        $area->fax = '';
        $area->sector_id= 1;
        $area->save();

        $area = new Area();
        $area->name = 'Aplicaciones';
        $area->description = 'Esta es el área que hace los programas';
        $area->email = 'presupuesto@jockeyclub.com.ar';
        $area->fax = '';
        $area->sector_id= 1;
        $area->save();

    }
}
