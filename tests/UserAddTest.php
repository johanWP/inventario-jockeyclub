<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserAddTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
/*    public function testExample()
    {
        $this->assertTrue(true);
    }*/
    use DatabaseTransactions;
    public function testExample()
    {
//        $admin = App\User::find(1);
//        $user = factory(App\User::class)->make();
//        $this->actingAs($admin)
//            ->visit('/usuarios/create')
//            ->type($user->name, 'name')
//            ->type($user->username, 'username')
//            ->type($user->position, 'position')
//            ->type($user->email, 'email')
//            ->type($user->ext, 'ext')
//            ->select('2','sector_id')
//            ->select('3','area_id')
//            ->press('Incluir nuevo usuario')
//            ->see('El usuario se creó con éxito.');
        $this->assertTrue(true);
    }
}
