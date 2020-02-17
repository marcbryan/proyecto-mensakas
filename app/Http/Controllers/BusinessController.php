<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;

// TODO: Mostrar errores
class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $businesses = Business::all();
        $columns = Business::getTableColumns();
        return view('businesses.index', ['businesses'=>$businesses, 'columns'=>$columns]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $columns = Business::getTableColumns();
        return view('businesses.create', ['columns'=>$columns]);
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
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'zipcode' => 'required',
        ]);
        $request->merge([
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        Business::create($request->all());

        // TODO: Cambiar texto hardcodeado
        return redirect()->route('businesses.index')
                        ->withSuccess('Negocio creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $columns = Business::getTableColumns();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $columns = Business::getTableColumns();
        return view('businesses.edit', ['business' => Business::findOrFail($id), 'columns' => $columns]);
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
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'zipcode' => 'required',
        ]);
        $business = Business::findOrFail($id);

        $business->update($request->all());
        $business->touch();
        return back()->withSuccess('Negocio actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $business = Business::findOrFail($id);
        $business->delete();
        return redirect()->route('businesses.index')
                        ->withSuccess('Negocio eliminado correctamente!');
    }
}
