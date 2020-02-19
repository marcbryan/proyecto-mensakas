<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Deliverer;

class DelivererController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliverers = Deliverer::all();
        $columns = Deliverer::getTableColumns();
        return view('deliverers.index', ['deliverers'=>$deliverers, 'columns'=>$columns, 'keys'=>Deliverer::getFilterKeys()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('deliverers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[[
            'first_name' => 'required|max:25',
            'last_name' => 'required|max:50',
            'email' => 'required|email|unique:App\Deliverer,email',
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
        Deliverer::create($request->all());

        return redirect()->route('deliverers.index')
                        ->withSuccess('Deliverer creado correctamente.');
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
        return view('deliverers.edit', ['deliverer' => Deliverer::findOrFail($id)]);
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
        $validator = Validator::make($request->all(),[
            'first_name' => 'required|max:25',
            'last_name' => 'required|max:50',
            'email' => 'required|email|unique:App\Deliverer,email',
        ]);
        if ($validator->fails()) {
          return back()
                      ->withErrors($validator)
                      ->withInput();
        }
        $deliverer = Deliverer::findOrFail($id);

        $oldPass = Hash::make($request->old_pass);
        if ($oldPass == $deliverer->password) {
          $request->merge([
            'password' => Hash::make($request->password)
          ]);
          $deliverer->update($request->except(['old_pass']));
        } else {
          $deliverer->update($request->except(['password', 'old_pass']));
        }
        $deliverer->touch();
        return back()->withSuccess('Deliverer actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deliverer = Deliverer::findOrFail($id);
        $deliverer->delete();
        return redirect()->route('deliverers.index')
                        ->withSuccess('Deliverer eliminado correctamente!');
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
        $deliverers = Deliverer::where($request->column, 'LIKE', '%'.$request->value.'%')->get();
        $columns = Deliverer::getTableColumns();
        return view('deliverers.index', ['deliverers'=>$deliverers, 'columns'=>$columns, 'keys'=>Deliverer::getFilterKeys()]);
    }
}
