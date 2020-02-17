<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Superuser;

// TODO: Mostrar errores
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
        $columns = Superuser::getTableColumns();
        return view('superusers.index', ['superusers'=>$superusers, 'columns'=>$columns, 'keys'=>Superuser::getFilterKeys()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $columns = Superuser::getTableColumns();
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
        $request->merge([
          'password' => hash('sha256', $request->password),
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        Superuser::create($request->all());

        // TODO: Cambiar texto hardcodeado
        return redirect()->route('superusers.index')
                        ->withSuccess('Superusuario creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $columns = Superuser::getTableColumns();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $columns = Superuser::getTableColumns();
        return view('superusers.edit', ['superuser' => Superuser::findOrFail($id), 'columns' => $columns]);
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
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ]);
        $superuser = Superuser::findOrFail($id);

        $oldPass = hash('sha256', $request->old_pass);
        if ($oldPass == $superuser->password) {
          $request->merge([
            'password' => hash('sha256', $request->password)
          ]);
          $superuser->update($request->except(['old_pass']));
        } else {
          $superuser->update($request->except(['password', 'old_pass']));
        }
        $superuser->touch();
        return back()->withSuccess('Superusuario actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $superuser = Superuser::findOrFail($id);
        $superuser->delete();
        return redirect()->route('superusers.index')
                        ->withSuccess('Superusuario eliminado correctamente!');
    }

    public function filter(Request $request) {
        $validator = Validator::make($request->all(),[
            'column' => 'required',
            'value' => 'required',
        ]);
        if ($validator->fails()) {
          return back()
                      ->withErrors($validator)
                      ->withInput();
        }
        $superusers = Superuser::where($request->column, 'LIKE', '%'.$request->value.'%')->get();
        $columns = Superuser::getTableColumns();
        return view('superusers.index', ['superusers'=>$superusers, 'columns'=>$columns, 'keys'=>Superuser::getFilterKeys()]);
    }
}
