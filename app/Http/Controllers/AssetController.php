<?php

namespace App\Http\Controllers;

use App\Move;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Asset;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\URL;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assets = Asset::where('status', 'A')->orderBy('serial')->get();
        return view('assets.index', compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = \App\Type::orderBy('name')->get()->lists('name','id');
        $selectedType = null;
        return view('assets.create', compact('types', 'selectedType'));
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
            'fechaCompra'   => 'required|date',
            'marca'         => 'required',
            'modelo'        => 'required',
            'serial'        => 'required',
            'precio'        => 'numeric',
        ];
        $this->validate($request, $rules);
        $asset = new Asset();
        $asset->fechaCompra = $request->fechaCompra;
        $asset->marca = $request->marca;
        $asset->modelo = $request->modelo;
        $asset->serial = $request->serial;
        $asset->type_id = $request->type_id;
        $asset->precio = $request->precio;
        $asset->nota = $request->nota;
        $asset->status = 'A';
        $asset->user_id = Auth::user()->id;
        $asset->save();

        $info = 'Fecha de compra: '.$asset->fechaCompra.
            'Marca: '.$asset->marca.
            'Modelo: '.$asset->modelo.
            'Serial: '.$asset->serial.
            'Tipo: '.$asset->type->name.
            'Precio: '.$asset->precio.
            'Nota: '.$asset->nota;
        $move = new Move();
        $move->origen = User::where('username', 'compras')->first()->id;
        $move->destino = User::where('username', 'sistemas')->first()->id;
        $move->asset_id = $asset->id;
        $move->user_id = Auth::user()->id;
        $move->save(); 
        QrCode::format('png')->size(200)->generate($info, 'qr/'.$asset->id.'.png');
//        QrCode::format('png')->size(200)->generate(URL::to('/equipos/'.$asset->id), 'qr/'.$asset->id.'.png');

        flash('El equipo se creó con éxito.', 'success');
        return redirect('equipos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $asset = Asset::findOrFail($id);
        $moves = $asset->moves; 
        return view('assets.read', compact('asset', 'moves'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asset = Asset::findOrFail($id);
        $types = \App\Type::orderBy('name')->get()->lists('name','id');
        $selectedType = $asset->type_id;
        return view('assets.edit', compact('asset','types', 'selectedType'));
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
            'fechaCompra'   => 'required|date',
            'marca'         => 'required',
            'modelo'        => 'required',
            'serial'        => 'required',
            'precio'        => 'numeric',
        ];
        $this->validate($request, $rules);
        $asset = Asset::findOrFail($id);
        $asset->fechaCompra = $request->fechaCompra;
        $asset->marca = $request->marca;
        $asset->modelo = $request->modelo;
        $asset->serial = $request->serial;
        $asset->type_id = $request->type_id;
        $asset->precio = $request->precio;
        $asset->nota = $request->nota;
        $asset->status = 'A';
        $asset->save();

        flash('El equipo se actualizó con éxito.', 'success');
        return redirect('equipos');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(count(Move::where('asset_id', $id)->get()) > 0)
        {
            flash('No se puede eliminar un equipo que ha tenido movimientos. Envíelo al almacén de Dañados o Robados', 'danger');
        } else
        {
            Asset::destroy($id);
            flash('El equipo se eliminó con éxito.', 'success');
        }
        return redirect('equipos');
        //TODO: Revisar por qué no toma el softDelete
    }
}
