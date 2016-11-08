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

    public function getAssets($id)
    {
        $user = User::findOrFail($id);
        return $user->inventario;
    }

    public function getNextSerial($type_id)
    {
        $nextId = (count(Asset::where('type_id', $type_id)->withTrashed()->get()) + 1);
        $nextSerial = Type::find($type_id)->prefix . '-' . $nextId;
        return $nextSerial;
    }

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

    public function postUserDetails( Request $request )
    {
        $user = User::find( $request->user_id );
        if ( $user )
        {
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