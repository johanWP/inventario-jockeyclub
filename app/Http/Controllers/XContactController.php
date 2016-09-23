<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Area;
use App\Contact;
use DB;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();
        $areas = DB::table('areas')->orderBy('name')->paginate(10);
        return view('users.index', compact('contacts', 'areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::lists('name', 'id');
        $selectedArea = null;
        return view('users.create', compact('areas', 'selectedArea'));    
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
            'position' => 'required|string|max:100',
            'email' => 'email',
            'area_id' => 'required',
            'ext' => 'digits:4',
        ];
        $this->validate($request, $rules);
        Contact::create($request->all());
        flash('El contacto se creó con éxito.', 'success');
        return redirect('contactos');
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
        $contact = Contact::findOrFail($id);
        $selectedArea = $contact->area->id;
        $areas = Area::lists('name', 'id');
        return view('users.edit', compact('contact', 'selectedArea', 'areas'));
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
        $contact = Contact::findOrFail($id);
        $contact->update($request->all());
        flash('El contacto se actualizó con éxito.', 'success');
        return redirect('contactos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        flash('El contacto se borró con éxito.', 'success');
        return redirect('contactos');
    }
}
