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

class ImportController extends Controller
{
    public function __construct()
    {

    }

    public function avaya()
    {
        return view('import.avaya');
    }

    public function importAvaya(Request $request)
    {
        $myfile = Input::file('file');
//
        $name = Carbon::now()->secondsUntilEndOfDay() . '_' . $myfile->getClientOriginalName();
        $result = Storage::disk('local')->put($name, File::get($myfile));
        if ($result) {
//            session()->flash('flash_message', 'Se importaron correctamente los artículos nuevos.');
            $total = $this->insertAvayaData($name);
            flash('El archivo se subió con éxito y se está procesando.  '.
                $total['total'] .' contactos estarán disponibles pronto. '. $total['error'] . ' tuvieron errores.',
                'info')
                ->important();

        } else {
            session()->flash('flash_message_danger', 'Ha ocurrido un error. Intentelo de nuevo más tarde o reporte el error.');
        }
        session()->flash('flash_message_important', true);
        return view('/import/avaya');
    }

    private function insertAvayaData($filename)
    {
        $fullPath = storage_path() . '\\app\\' . $filename;
        if ( ($handle = fopen($fullPath, 'r') ) !== FALSE) {
            $total = 0; $nuevos = 0; $modificados = 0; $error = 0;
            while ( ($data = fgetcsv($handle, 1000, ',') ) !== FALSE)
            {
                try
                {
                    if ( (int)$data[0] ) {
                        $total++;
                        $phone = Phone::firstOrNew(['number' => $data[0]]);
                        $phone->place = $data[4];
                        $phone->save();
                    } else {
                        $error++;
                        Activity::log('Importación de Avaya: ' . $data[0] . ' de ' . $data[4] . ' no es un número.');
                    }
                } catch (QueryException $e)
                {
                    $errorCode = $e->errorInfo[1];
                    if($errorCode == 1062){
                        dd('houston, we have a duplicate entry problem');
                    }
                }


            }
            fclose($handle);
        }
        $totales = array();
        $totales['total'] = $total; $totales['error'] = $error;
        return $totales;
    }

    private function insertOrUpdateAvayaRecord(Array $data)
    {
        $phone = Phone::where('number', $data[0])->first();
        if( $phone != null )
        {
            $phone = new Phone();
            $phone->number = $data[0];
            $phone->place = $data[4];
            $phone->save();
        } else {
            $phone->place = $data[4];
        }
    }

}
