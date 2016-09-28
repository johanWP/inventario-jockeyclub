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
        $type->name = 'Access Point Wi-Fi';
        $type->prefix = 'AP';
        $type->save();

        $type = new \App\Type();
        $type->name = 'Impresora';
        $type->prefix = 'IMP';
        $type->save();

        $type = new \App\Type();
        $type->name = 'PC';
        $type->prefix = 'PC';
        $type->save();

        $type = new \App\Type();
        $type->name = 'Monitor';
        $type->prefix = 'MON';
        $type->save();

        $type = new \App\Type();
        $type->name = 'Switch';
        $type->prefix = 'SW';
        $type->save();

        $type = new \App\Type();
        $type->name = 'Server';
        $type->prefix = 'SVR';
        $type->save();

        $type = new \App\Type();
        $type->name = 'Notebook';
        $type->prefix = 'NTB';
        $type->save();

        $type = new \App\Type();
        $type->name = 'Teléfono';
        $type->prefix = 'TEL';
        $type->save();

    }
}
