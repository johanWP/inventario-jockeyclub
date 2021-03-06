<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Type;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sector;
use App\User;
use Illuminate\Http\Response;
use App\Area;

class ApiController extends Controller
{
    /**
     * devuelve todos los sectores y las áreas que le pertenecen a cada uno
     * @param --
     * @return JSON
     */
    public function getSectors()
    {
        $result = array();
        $sectors = Sector::orderBy('name')->get();
        foreach ($sectors as $sector) {
            $areas = $sector->areas;
            foreach ($areas as $area) {
                $result[$sector->id][] = ['id' => $area->id, 'name' => $area->name];
            }
        }
        return $result;
    }

    /**
     * Devuelve todas las áreas con sus sectores
     */
    public function getAreas()
    {
        $result = array();
        $areas = Area::orderBy('name')->get();
        foreach ($areas as $area)
        {
            $sectors = $area->sectors;
            foreach ($sectors as $sector)
            {
                $result[$area->id][] = ['id' => $sector->id, 'name' => $sector->name];
            }
        }
        return $result;
    }

    /**
     * @param Integer $id
     * @return mixed
     */
    public function getAssets($id)
    {
        $user = User::findOrFail($id);
        return $user->inventario;
    }

    /**
     * @param $type_id
     * @return string
     */
    public function getNextSerial($type_id)
    {
        $nextId = (count(Asset::where('type_id', $type_id)->withTrashed()->get()) + 1);
        $nextId = str_pad($nextId, 5, '0', STR_PAD_LEFT);
        $nextSerial = Type::find($type_id)->prefix . '-' . $nextId;
        return $nextSerial;
    }

    /**
     * @param $user_id
     * @return array|Response
     */
    public function getUserDetails($user_id)
    {
        $data = array();
        $user = User::find($user_id);
        if ($user) {
            $data = [
                'name' => $user->name,
                'email' => $user->email,
                'ext' => $user->ext,
                'position' => $user->position
            ];
            return $data;
        } else {
            return response(['message' => 'UsuarioNoEncontrado'], 404);
        }
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function postUserDetails(Request $request )
    {
        $user = User::find( $request->user_id );
        if ( $user )
        {
            $rules = [
                'name'      => 'required|max:200',
                'position'  => 'string|max:100',
                'email'     => 'email',
                'ext'       => 'digits:4',
            ];

            // si falla la validación, el proceso aborta y devuelve error 422
            $this->validate($request, $rules);


            $user->name = $request->name;
            $user->email = $request->email;
            $user->position = $request->position;
            $user->ext = $request->ext;
            $user->save();
            return response(['message' => 'OK'], 200);
        } else
        {
            return response(['message' => 'UsuarioNoEncontrado'], 404);
        }
    }
}