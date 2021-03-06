<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Events\MovimientoDeNotebook;
use App\Move;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MoveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $moves = Move::orderBy('id', 'desc')->get();
        return view('moves.index', compact('moves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $selectedOrigen = null;
        $selectedDestino = null;

        $usuarios = User::orderBy('last_name')->get();
        foreach($usuarios as $user)
        {
            if($user->user_type == 'V')
            {
                $users[$user->id] = $user->name;
            } else {

                $users[$user->id] = $user->last_name .', ' . $user->name;
            }
        }

        $selectedAsset = null;
        $assets = \App\Asset::orderBy('serial')->pluck('serial', 'id');
        return view('moves.create', compact('users', 'selectedOrigen','selectedDestino', 'assets', 'selectedAsset'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        foreach($request->asset_id as $asset_id)
        {
            $move = new Move();
            $move->origen = $request->origen;
            $move->destino = $request->destino;
            $move->asset_id = $asset_id;  //
            $move->user_id = Auth::user()->id;
            $move->save();
            
            $asset = Asset::find($asset_id);
            $asset->usuario_actual = $request->destino;
            $asset->save();

            // si el movimiento es sobre una notebook
            if ($asset->type_id == '7')
            {
                event(new MovimientoDeNotebook($asset));
            }
        }
        flash('El movimiento se registró con éxito.', 'success');
        return redirect('movimientos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
