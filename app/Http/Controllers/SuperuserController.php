<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Superuser;

class SuperuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $superusers = Superuser::all();
        $columns = Schema::getColumnListing('superusers');
        return view('superusers.index', ['superusers'=>$superusers, 'columns'=>$columns]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $columns = Schema::getColumnListing('superusers');
        return view('superusers.create', ['columns'=>$columns]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $superuser = $request->all();
        $superuser->password = hash('sha256', $superuser->password);
        $superuser->created_at = now();
        $superuser->updated_at = now();

        Superuser::create($superuser);//[$request->all(), ]);

        // TODO: Cambiar texto hardcodeado
        return redirect()->route('superusers.index')
                        ->with('success', 'Superusuario creado correctamente.');

        /*
        $superuser->hash = $request->hash;
        $superuser->first_name = $request->first_name;
        $superuser->last_name = $request->last_name;
        $superuser->email = $request->email;
        $superuser->password = $request->password;
        $superuser->remember_token = $request->remember_token;

        */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $columns = Schema::getColumnListing('superusers');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $columns = Schema::getColumnListing('superusers');
        return view('', ['superuser' => Superuser::findOrFail($id), 'columns' => $columns]);
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
        $superuser = Superuser::findOrFail($id);
        $superuser->hash = $request->hash;
        $superuser->first_name = $request->first_name;
        $superuser->last_name = $request->last_name;
        $superuser->email = $request->email;
        $superuser->password = $request->password;
        $superuser->remember_token = $request->remember_token;
        $superuser->save();
        return redirect('/post/'.$id.'/edit');
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
