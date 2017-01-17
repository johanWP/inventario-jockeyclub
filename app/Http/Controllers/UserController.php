<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Area;
use DB;
use Intervention\Image\Facades\Image;
use App\User;
use App\Sector;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('user_type', '<>','V')->orderBy('name')->get();
        $areas = Area::orderBy('name');

        return view('users.index', compact('users', 'areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sectors = Sector::lists('name', 'id');
        $selectedSector = null;
        $areas = Area::lists('name', 'id');;
        $selectedArea = null;
        return view('users.create', compact('areas','sectors', 'selectedArea', 'selectedSector'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'username'  => 'required|unique:users|max:100',
            'name'      => 'required|unique:users|max:200',
            'position'  => 'string|max:100',
            'email'     => 'email',
            'area_id'   => 'required',
            'ext'       => 'digits:4',
            'image'     => 'mimes:png'
        ];
        $this->validate($request, $rules);
        if($request->image)
        {
            $imageName = $request->username . '.' .
                $request->file('image')->getClientOriginalExtension();

            $path = public_path('img/userImages/'.$request->username.'.jpg');
            Image::make( $request->file('image')->getRealPath() )
                ->fit(250, 250)
                ->encode('jpg', 75)
                ->save($path)
                ->destroy();
        }


        User::create($request->all());
        flash('El usuario se creó con éxito.', 'success');
        return redirect('usuarios');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $type_id ='';
        return view('users.read', compact('user', 'type_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $selectedSector = $user->area->sector->id;
        $sectors = Sector::lists('name', 'id');
        $areas = Area::where('sector_id', $selectedSector)->get()->pluck('name', 'id');
        return view('users.edit', compact('areas','sectors', 'selectedArea', 'selectedSector', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'username'  => 'required|max:100',
            'name'      => 'required|max:200',
            'position'  => 'string|max:100',
            'email'     => 'email',
            'area_id'   => 'required',
            'ext'       => 'digits:4',
            'image'     => 'mimes:jpeg,jpg,bmp,png'
        ];
        $this->validate($request, $rules);
        if($request->image)
        {
            $imageName = $request->username . '.' .
                $request->file('image')->getClientOriginalExtension();

            $path = public_path('img/userImages/'.$request->username.'.jpg');
            Image::make( $request->file('image')->getRealPath() )
                ->fit(250, 250)
                ->encode('jpg', 75)
                ->save($path)
                ->destroy();
        }
        $user = User::findOrFail($id);
        $user->update($request->all());
        flash('El usuario se actualizó con éxito.', 'success');
        return redirect('usuarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if(count($user->assets()) > 0)
        {
            flash('El usuario posee equipos asignados.  Reubique los equipos e intentelo de nuevo.', 'danger');
        } else
        {
            $user->delete();
            flash('El usuario se borró con éxito.', 'success');
        }
        return redirect('usuarios');
    }

    /**
     * Devuele la vista con el formulario para importar usuarios desde archivo .CSV
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showImportForm()
    {
        return view('users.import');
    }

    /**
     * Sube el archivo .csv de usuarios e importa Sectores, Áreas y Usuarios
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function importUsers(Request $request)
    {
        $myfile = Input::file('file');
        $filename = Carbon::now()->secondsUntilEndOfDay() . '_' . $myfile->getClientOriginalName();
        $result = Storage::disk('local')->put($filename, File::get($myfile));
        if ($result) {
            $insert = $this->insertImportedUsers($filename);
            if(is_numeric($insert))
            {
                flash('Se insertaron ' . $insert . ' registros.', 'success');
            } else {
                flash($insert, 'danger')->important();
            }

        } else {
            flash('Ha ocurrido un error al subir el archivo. 
                    Intentelo de nuevo más tarde o reporte el error.', 'danger')->important();
        }

        return redirect('/usuarios');
    }

    /**
     * Recibe el nombre del archivo subido a /storage/app
     * devuelve un mensaje de error o el número de usuarios
     * @param $filename
     * @return null|string
     */
    private function insertImportedUsers($filename)
    {
        $msg = null;
        $fullPath = storage_path() . '\\app\\' . $filename;
        if (($handle = fopen($fullPath, 'r')) !== FALSE)
        {
            $total = 0;
            $sectorActual = new Sector();
            $areaActual = new Area();
            while (($data = fgetcsv($handle, 1000, ';')) !== FALSE)
            {
                try
                {
                    $sector     = ucwords(strtolower(trim(utf8_encode($data[0]))));
                    $area       = ucwords(strtolower(trim(utf8_encode($data[1]))));
                    $cargo      = ucwords(strtolower(trim(utf8_encode($data[2]))));
                    $apellido   = ucwords(strtolower(trim(utf8_encode($data[3]))));
                    $nombre     = ucwords(strtolower(trim(utf8_encode($data[4]))));
                    $ext        = $data[5];
                    $email      = $data[6];
                    $emailArea  = $data[7];

                    if ($sector <> $sectorActual->name)
                    {
                        $sectorActual = Sector::firstOrNew(['name' => $sector]);
                        $sectorActual->save();
                    }

                    if ($area <> $areaActual->name)
                    {
                        $areaActual = Area::firstOrNew(['name' => $area]);
                        $areaActual->sector_id = $sectorActual->id;
                        $areaActual->email = $emailArea;
                        $areaActual->save();
                    }

                    if(!empty($email))
                    {
                        $user = User::firstOrNew(['name' => $nombre, 'last_name' => $apellido]);
                        $user->username = $nombre[0] . $apellido;
                        $user->email = $email;
                        $user->position = ucwords(strtolower($cargo));
                        $user->ext = $ext;
                        $user->user_type = 'U';
                        $user->password = bcrypt('secret');
                        $user->area_id = $areaActual->id;
                        $user->save();
                        $total++;
                    }


                } catch (QueryException $e) {
                    $errorCode = $e->errorInfo[1];
                    if ($errorCode == 1062) {
                        $msg = 'Registro duplicado: ' . $user->name . ' ' . $user->last_name;
                    } else {
                        $msg ='Ocurrió un error al importar los usuarios';
                    }

                }
            }
            fclose($handle);
        }

        empty($msg) ?  $result = $total : $result = $msg;
        return $msg;
    }

}
