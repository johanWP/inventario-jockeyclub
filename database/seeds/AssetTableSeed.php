<?php

use Illuminate\Database\Seeder;

class AssetTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marca = ['Lexmark', 'Linksys', 'Samsung', 'LG', 'Cisco', 'Huawei'];
        $status = ['I', 'A', 'X', 'R'];  // Nunca asignado, Activo, Dañado, Robado
        $faker = Faker\Factory::create('es_AR');
        for($i=1; $i<=20; $i++)
        {
            $asset = new \App\Asset();
            $asset->serial = $faker->ean8;
            $asset->marca = $marca[rand(0,5)];
            $asset->modelo = $faker->secondaryAddress;
            $asset->fechaCompra = $faker->date();
            $asset->precio = $faker->randomFloat($nbMaxDecimals = 2, $min = 50);
            $asset->status = $status[rand(0,3)];
            $asset->nota = $faker->realText($maxNbChars = 200, $indexSize = 2);
            $asset->type_id = rand(0,6);
            $asset->user_id = rand(0,4);
            $asset->save();
        }

    }
}
