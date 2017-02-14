<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sector;
use App\Area;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectors = Sector::orderBy('name')->get(); 
        return view('sectors.index', compact('sectors'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $area = Area::orderby('name')->get()->pluck('name', 'id');
        $selectedArea = null;
        return view('sectors.create', compact('area', 'selectedArea'));
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
            'name' => 'required|unique:areas|max:100',
            'description' => 'string|max:100',
            'email' => 'email',
        ];
        $this->validate($request, $rules);
        Sector::create($request->all());
        flash('El sector se creó con éxito.', 'success');
        return redirect('/sectores');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sector = Sector::findOrFail($id);
        $areas = $sector->areas;
        return view('sectors.read', compact('areas', 'sector'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $area = Area::orderby('name')->get()->pluck('name', 'id');
        $selectedArea = null;
        $sector = Sector::findOrFail($id);
        return view('sectors.edit', compact('area', 'selectedArea', 'sector'));
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
            'name' => 'required|unique:areas|max:100',
            'description' => 'string|max:100',
            'email' => 'email',
        ];
        $this->validate($request, $rules);
        $sector = Sector::findOrFail($id);
        $sector->update($request->all());
        flash('El sector se actualizó con éxito.', 'success');
        return redirect('/sectores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sector = Sector::find($id);
        if($sector->users->count() > 0)
        {
            flash('No se puede borrar un sector con usuarios asociados', 'danger');
            return redirect()->back();
        }
        $sector->delete();
        flash('El sector se eliminó con éxito.', 'success');
        return redirect('/sectores');

    }
}
