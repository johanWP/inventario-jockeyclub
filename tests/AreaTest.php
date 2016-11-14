<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AreaTest extends TestCase
{
//    use DatabaseTransactions;
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
            'name', 'description', 'email', 'fax', 'sector_id',
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
        $num = rand(1111, 9999);
        $this->actingAs($johan)
            ->visit('/areas/create')
            ->type('Area de Test ' . $num, 'name')
            ->type('Esta es una descripción de pruebas', 'description')
            ->type('area_'. $num . '@mail.com', 'email')
            ->type('1234'. $num, 'fax')
            ->select('1', 'sector_id')
            ->press('Incluir área')
            ->see('El área se creó con éxito.');
    }

    public function testEditArea()
    {
        $johan = App\User::find(5);
        $area = App\Area::orderBy('id', 'DESC')->first();
        $this->actingAs($johan)
            ->visit('/areas/'.$area->id.'/edit')
            ->type($area->name. ' modificada', 'name')
            ->type('Esta es una descripción de pruebas modificado', 'description')
            ->type($area->email . '.ar', 'email')
            ->type('1234'.rand(8888, 9999), 'fax')
            ->select('1', 'sector_id')
            ->press('Actualizar área')
            ->see('El área se actualizó con éxito.');
    }

}
