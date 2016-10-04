<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sector;
use App\User;

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
        $users = User::all();
        return view('sectors.index', compact('sectors', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('user_type_', '<>', 'V')->orderBy('name')->lists('name', 'id');
        $selectedUser = null;
        return view('sectors.create', compact('selectedUser', 'users'));
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
//            'user_id' => 'required',
        ];
        $this->validate($request, $rules); //dd($request->all());
        Sector::create($request->all());
        flash('El sector se creó con éxito.', 'success');
        return redirect('sectores');
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
        $sector = Sector::findOrFail($id);
//        $selectedUser = $sector->manager->id;
        $users = User::where('user_type_', '<>', 'V')->orderBy('name')->lists('name', 'id');
        return view('sectors.edit', compact('sector', 'selectedUser', 'users'));
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
//            'user_id' => 'required',
        ];
        $this->validate($request, $rules); //dd($request->all());
        $sector = Sector::findOrFail($id);
        $sector->update($request->all());
        flash('El sector se actualizó con éxito.', 'success');
        return redirect('sectores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sector::destroy($id);
        flash('El sector se eliminó con éxito.', 'success');
        return redirect('sectores');

    }
}
