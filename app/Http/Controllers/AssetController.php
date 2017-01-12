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
        $types = \App\Type::orderBy('name')->get()->pluck('name','id');
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
        try {
            $origen_por_defecto = User::where('username', 'compras')->first()->id;
            $destino_por_defecto = User::where('username', 'sistemas')->first()->id;
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
            $asset->proveedor = $request->proveedor;
            $asset->orden_compra = $request->orden_compra;
            $asset->type_id = $request->type_id;
            $asset->precio = $request->precio;
            $asset->nota = $request->nota;
            $asset->status = 'A';
            $asset->user_id = Auth::user()->id;
            $asset->usuario_actual = $destino_por_defecto;
            $asset->save();

            $move = $this->CrearMovimiento($origen_por_defecto, $destino_por_defecto, $asset->id, $asset->user_id);

            flash('El equipo se creó con éxito.', 'success');

        } catch (\Illuminate\Database\QueryException $e) {
            flash('El serial ' . $request->serial . 'está duplicado.', 'error');
            return back()->withInput();
        }
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
        $types = \App\Type::orderBy('name')->get()->pluck('name','id');
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
            'proveedor'     => 'string',
            'orden_compra'  => 'string',
            'modelo'        => 'required',
            'serial'        => 'required',
            'precio'        => 'numeric',
        ];
        $this->validate($request, $rules);
        $asset = Asset::findOrFail($id);
        $asset->fechaCompra = $request->fechaCompra;
        $asset->marca = $request->marca;
        $asset->proveedor = $request->proveedor;
        $asset->orden_compra = $request->orden_compra;
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
        if(count(Move::where('asset_id', $id)->get()) > 1)
        {
            flash('No se puede eliminar un equipo que ha tenido movimientos. Envíelo al almacén de Dañados o Robados', 'danger');
        } else
        {
            Asset::destroy($id);
            flash('El equipo se eliminó con éxito. <a href="#">Deshacer</a>', 'warning');
        }
        return redirect('equipos');
    }

    private function CrearMovimiento($origen, $destino, $asset_id, $user_id)
    {
        $move = new Move();
        $move->origen = $origen;
        $move->destino = $destino;
        $move->asset_id = $asset_id;
        $move->user_id = $user_id;
        $result = $move->save();
        return $result;
    }

    private function CrearCodigoQr($asset)
    {
        $path= 'qr/'.$asset->id.'.png';
        $info = 'Fecha de compra: '.$asset->fechaCompra.'\n'.
            'Marca: '.$asset->marca.'\n'.
            'Modelo: '.$asset->model.'\n'.
            'Serial: '.$asset->seria.'\n'.
            'Proveedor: '.$asset->proveedor.'\n'.
            'Precio: '.$asset->precio.'\n'.
            'Nota: '.$asset->nota.'\n';

        return QrCode::format('png')->size(200)->generate($info, $path);

    }
}
