<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Superuser;

class SuperuserController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        return view('superusers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'first_name' => 'required|max:25',
          'last_name' => 'required|max:50',
          'email' => 'required|email|unique:App\Superuser,email',
          'password' => 'required',
        ]);
        if ($validator->fails()) {
          return back()
                      ->withErrors($validator)
                      ->withInput();
        }
        $request->merge([
          'password' => Hash::make($request->password),
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        Superuser::create($request->all());

        return redirect()->route('superusers.index')
                        ->withSuccess('Superusuario creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('superusers.edit', ['superuser' => Superuser::findOrFail($id)]);
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
        $validator = Validator::make($request->all(), [
          'first_name' => 'required|max:25',
          'last_name' => 'required|max:50',
          'email' => 'required|email',
          'old_pass' => 'required'
        ]);
        if ($validator->fails()) {
          return back()
                      ->withErrors($validator)
                      ->withInput();
        }
        $superuser = Superuser::findOrFail($id);

        $oldPass = Hash::make($request->old_pass);
        if ($oldPass == $superuser->password) {
          $request->merge([
            'password' => Hash::make($request->password)
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
