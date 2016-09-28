<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

         $this->call(RoleTableSeeder::class);
         $this->call(OfficesTableSeeder::class);
         $this->call(SectorTableSeeder::class);
         $this->call(AreaTableSeeder::class);
         $this->call(UserTableSeeder::class);
         $this->call(TypeTableSeed::class);
         //$this->call(AssetTableSeed::class);

        Model::reguard();
    }
}
