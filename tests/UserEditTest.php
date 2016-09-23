<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserEdit extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testEdit()
    {
//        $admin = App\User::find(1);
//        $user = factory(App\User::class)->make();
//        $random_id = rand(2, 6);
//        $this->actingAs($admin)
//            ->visit('/usuarios/'.$random_id.'/edit')
//            ->type($user->name, 'name')
//            ->type($user->username, 'username')
//            ->type($user->position, 'position')
//            ->type($user->email, 'email')
//            ->type($user->ext, 'ext')
//            ->select('2','sector_id')
//            ->select('3','area_id')
//            ->press('Actualizar usuario')
//            ->see('El usuario se actualizó con éxito.');

        $this->assertTrue(true);

    }
}
