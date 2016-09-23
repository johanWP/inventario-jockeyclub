<?php

use Illuminate\Database\Seeder;

class OfficesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gerencia = new \App\Office();
        $gerencia->name = 'Gerencia de Administración';
        $gerencia->description = 'Esta es la gerencia para la que trabajamos';
        $gerencia->created_at = date("Y-m-d H:i:s");
        $gerencia->updated_at = date("Y-m-d H:i:s");

        $gerencia->save();
    }
}
