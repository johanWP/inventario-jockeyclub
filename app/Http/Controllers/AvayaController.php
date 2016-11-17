<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Activity;
use App\Phone;
use Illuminate\Database\QueryException;
use App\Jobs\ImportAvaya;

class AvayaController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Muestra el directorio telefónico
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $phones = Phone::all();
        return view('avaya.index', compact('phones'));
    }

    /**
     *Muestra el formulario de importación de .CSV
     */
    public function getFile()
    {
        return view('avaya.import');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function importAvaya(Request $request)
    {
        $myfile = Input::file('file');
        $name = Carbon::now()->secondsUntilEndOfDay() . '_' . $myfile->getClientOriginalName();
        $result = Storage::disk('local')->put($name, File::get($myfile));
        if ($result) {
            $total = $this->insertAvayaData($name, $request->location);
            flash('El archivo se subió con éxito y se está procesando.  ' .
                $total['total'] . ' contactos estarán disponibles pronto. ' . $total['error'] . ' tuvieron errores.',
                'info')
                ->important();

        } else {
            session()->flash('flash_message_danger', 'Ha ocurrido un error. Intentelo de nuevo más tarde o reporte el error.');
        }
        session()->flash('flash_message_important', true);
        return view('avaya.import');
    }

    /**
     * @param $filename
     * @return array
     */
    private function insertAvayaData($filename, $location)
    {
        $fullPath = storage_path() . '\\app\\' . $filename;
        if (($handle = fopen($fullPath, 'r')) !== FALSE) {
            $total = 0;
            $nuevos = 0;
            $modificados = 0;
            $error = 0;
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                try {
                    if ((int)$data[0]) {
                        $total++;
                        $this->dispatch(new ImportAvaya($data, $location));
                    } else {
                        $error++;
                        Activity::log('Importación de Avaya: ' . $data[0] . ' de ' . $data[4] . ' no es un número.');
                    }
                } catch (QueryException $e) {
                    $errorCode = $e->errorInfo[1];
                    if ($errorCode == 1062) {
                        dd('houston, we have a duplicate entry problem');
                    }
                }


            }
            fclose($handle);
        }
        $totales = array();
        $totales['total'] = $total;
        $totales['error'] = $error;
        return $totales;
    }
}
