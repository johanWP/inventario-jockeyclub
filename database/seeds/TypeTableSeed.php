<?php

use Illuminate\Database\Seeder;

class TypeTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = new \App\Type();
        $type->name = 'Router Wi-Fi';
        $type->save();

        $type = new \App\Type();
        $type->name = 'Impresora';
        $type->save();
        $type = new \App\Type();
        $type->name = 'PC';
        $type->save();
        $type = new \App\Type();
        $type->name = 'Laptop';
        $type->save();
        $type = new \App\Type();
        $type->name = 'Mouse';
        $type->save();
        $type = new \App\Type();
        $type->name = 'Televisor';
        $type->save();
        $type = new \App\Type();
        $type->name = 'Teclado';
        $type->save();
    }
}
