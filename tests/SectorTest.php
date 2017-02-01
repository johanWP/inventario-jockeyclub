<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SectorTest extends TestCase
{
//    use DatabaseTransactions;
    /**
     * @var string $tabla Nombre de la tabla de Movimientos
     */
    protected $tabla = 'sectors';

    /**
     * @var array $columns Los campos que debe tener la tabla
     */
    // Este array debe mantenerse consistente con $fillable en el Modelo Move
    protected $columns =
        [
            'name', 'description', 'email', 'fax', 'area_id',
            'created_at', 'updated_at', 'deleted_at'
        ];

    /**
     * Test para verificar la existencia de la tabla Sectors para sectores (Sistemas, RRHH, etc.).
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

    public function testAddSector()
    {
        $johan = App\User::find(5);
        $num = rand(1111, 9999);
        $this->actingAs($johan)
            ->visit('/sectores/create')
            ->type('Sector de Test ' . $num, 'name')
            ->type('Esta es una descripción de pruebas', 'description')
            ->type('area_'. $num . '@mail.com', 'email')
            ->type('1234'. $num, 'fax')
            ->select('10', 'area_id')
            ->press('Incluir sector')
            ->see('El sector se creó con éxito.');
    }

    public function testEditSector()
    {
        $johan = App\User::find(5);
        $sector = App\Area::orderBy('id', 'DESC')->first();
        $this->actingAs($johan)
            ->visit('/sectores/'.$sector->id.'/edit')
            ->type($sector->name. ' modificada', 'name')
            ->type('Esta es una descripción de pruebas modificado', 'description')
            ->type($sector->email . '.ar', 'email')
            ->type('1234'.rand(8888, 9999), 'fax')
            ->select('10', 'area_id')
            ->press('Actualizar sector')
            ->see('El sector se actualizó con éxito.');
    }
    
/*
    public function testDeleteSector()
    {
        $johan = App\User::find(5);
        $sector = App\Sector::where('name', 'like','Sector de Test%')->first();
        $this->actingAs($johan)
            ->visit('/sectores/')
            ->press('btn_'.$sector->id)
            ->press('Borrar')
            ->see('El sector se eliminó con éxito.');

    }
    */
}
