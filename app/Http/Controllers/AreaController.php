<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Sector;
use App\Area;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::orderBy('name')->get();
        return view('areas.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('areas.create');
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
            'description' => 'string|max:255',
            'email' => 'email',
            'fax' => 'digits:8',
        ];
        $this->validate($request, $rules);
        Area::create($request->all());
        flash('El área se creó con éxito.', 'success');
        return redirect('/areas');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $area = Area::findOrFail($id);
        $sectores = Sector::where('area_id', $area->id)->get();
        return view('areas.read', compact('area', 'sectores'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $area = Area::findOrFail($id);
//        $sector = Sector::orderby('name')->get()->pluck('name', 'id');
//        $selectedSector = $area->sector->id;
        return view('areas.edit', compact('area'));
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
            'name' => 'required|max:100',
            'description' => 'string|max:255',
            'email' => 'email',
            'fax' => 'digits:8',
        ];
        $this->validate($request, $rules);
        $area = Area::findOrFail($id);
        $area->update($request->all());
        flash('El área se actualizó con éxito.', 'success');
        return redirect('/areas');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();
        flash('El área se borró con éxito.', 'success');
        return redirect('/areas');
    }

}
