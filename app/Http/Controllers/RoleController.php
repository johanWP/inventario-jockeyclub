<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name')->get();
        $roles = Role::all();

        return view('pages.rolesAdmin', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::where('username', $request['username'])->first();
        $user->roles()->detach();
        $roles = Role::all();
        foreach($roles as $role) {
            if ($request[$role->name]) {
                $user->roles()->attach($role);
            }
        }

//        if ($request['role_usuario']) {
//            $user->roles()->attach(Role::where('name', 'Usuario')->first());
//        }
//        if ($request['role_prov']) {
//            $user->roles()->attach(Role::where('name', 'Proveedor')->first());
//        }
//        if ($request['role_admin']) {
//            $user->roles()->attach(Role::where('name', 'Admin')->first());
//        }
//        if ($request['role_analista']) {
//            $user->roles()->attach(Role::where('name', 'Analista')->first());
//        }

        return redirect()->back();
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
