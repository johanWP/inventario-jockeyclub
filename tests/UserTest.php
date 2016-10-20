<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * @var string $tabla Nombre de la tabla de Areas
     */
    protected $tabla = 'users';

    /**
     * @var array $columns Los campos que debe tener la tabla
     */
    // Este array debe mantenerse consistente con $fillable en el Modelo Area
    protected $columns =
        [
            'name', 'email', 'password', 'username', 'position', 'area_id', 'ext',
            'created_at', 'updated_at', 'deleted_at'
        ];

    /**
     * Test para verificar la existencia de la tabla Professionals para profesionales (cuidadores, jockeys, etc.).
     *
     * @return void
     */
    public function testTablaExiste()
    {
        $this->assertTrue(Schema::hasTable($this->tabla));
    }

    public function testAddUser()
    {
        $johan = App\User::find(5);
        $ran = rand(1000, 9999);
        $this->actingAs($johan)
            ->visit('/usuarios/create')
            ->type('Usuario test', 'name')
            ->type('test_user_'.$ran, 'username')
            ->type('Cargo test', 'position')
            ->type('user_email_'.$ran.'@mail.com', 'email')
            ->type($ran, 'ext')
            ->select('1','area_id')
            ->press('Incluir nuevo usuario')
            ->see('El usuario se creó con éxito.');

    }
}
