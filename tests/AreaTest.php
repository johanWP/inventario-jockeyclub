<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AreaTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * @var string $tabla Nombre de la tabla de Areas
     */
    protected $tabla = 'areas';

    /**
     * @var array $columns Los campos que debe tener la tabla
     */
    // Este array debe mantenerse consistente con $fillable en el Modelo Area
    protected $columns =
        [
            'name', 'description', 'email', 'office_id',
            'created_at', 'updated_at', 'deleted_at'
        ];
    

    public function __construct() {
//        $this->email = 'area_'.rand(1, 9999).'@mail.com';
    }

    /**
     * Test para verificar la existencia de la tabla Professionals para profesionales (cuidadores, jockeys, etc.).
     *
     * @return void
     */
    public function testTablaExiste()
    {
        $this->assertTrue(Schema::hasTable($this->tabla));
    }

    /**
     * Test para verificar los campos en la tabla
     * @return void
     */
    public function testCamposExisten()
    {
        for ($i=0; count($this->columns) > $i; $i++)
        {
            $this->assertTrue(Schema::hasColumn($this->tabla, $this->columns[$i]));
        }
    }
    public function testAddArea()
    {
        $johan = App\User::find(5);
        $this->actingAs($johan)
            ->visit('/areas/create')
            ->type('Area de Test', 'name')
            ->type('Esta es una descripción de pruebas', 'description')
            ->type('test_'.rand(1, 9999).'@mail.com', 'email')
            ->press('Incluir nueva área')
            ->see('El área se creó con éxito.');
    }

    public function testEditArea()
    {
        $johan = App\User::find(5);
        $area = App\Area::where('name', 'Area de Test')->first();
        $this->actingAs($johan)
            ->visit('/areas/'.$area->id.'/edit')
            ->type('Area de Test modificado', 'name')
            ->type('Esta es una descripción de pruebas modificado', 'description')
            ->type('test_'.rand(1, 9999).'@mail.com', 'email')
            ->press('Actualizar área')
            ->see('El área se actualizó con éxito.');
    }
    
}
