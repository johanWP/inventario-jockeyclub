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
            'position'  => 'required|string|max:100',
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
        $areas = Area::where('sector_id', $selectedSector)->get()->lists('name', 'id');
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
            'position'  => 'required|string|max:100',
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
}
