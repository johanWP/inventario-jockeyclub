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
        $area->name = 'Proveedores';
        $area->description = 'Esta es el área que le paga a los proveedores';
        $area->email = 'proveedores@jockeyclub.com.ar';
        $area->fax = '1122';
        $area->sector_id= 1;
        $area->save();

        $area = new Area();
        $area->name = 'Contabilidad';
        $area->description = 'Esta es el área que lleva los libros contables';
        $area->email = 'contabilidad@jockeyclub.com.ar';
        $area->fax = '1133';
        $area->sector_id= 1;
        $area->save();

        $area = new Area();
        $area->name = 'Desarrollo';
        $area->description = 'Esta es el área que hace las aplicaciones';
        $area->email = 'desarrollo@jockeyclub.com.ar';
        $area->fax = '1442';
        $area->sector_id= 2;
        $area->save();

        $area = new Area();
        $area->name = 'Técnica';
        $area->description = 'Esta es el área que instala los equipos';
        $area->email = 'tecnica@jockeyclub.com.ar';
        $area->fax = '1122';
        $area->sector_id= 2;
        $area->save();

        $area = new Area();
        $area->name = 'Presupuesto';
        $area->description = 'Esta es el área que hace el presupuesto anual';
        $area->email = 'presupuesto@jockeyclub.com.ar';
        $area->fax = '1975';
        $area->sector_id= 3;
        $area->save();

    }
}
