<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Business;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $business = Business::all();
        $columns = Schema::getColumnListing('business');
        return view('business.index', ['business'=>$business, 'columns'=>$columns]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $columns = Schema::getColumnListing('business');
        return view('business.create', ['columns'=>$columns]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO: Cambiar
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
        return redirect()->route('business.index')
                        ->with('success', 'Business creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $columns = Schema::getColumnListing('business');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $columns = Schema::getColumnListing('business');
        return view('business.edit', ['business' => Business::findOrFail($id), 'columns' => $columns]);
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
        return redirect('/business/'.$id.'/edit')->with('status', 'Business actualizado correctamente!');
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
        return redirect()->route('business.index')
                        ->with('status','Business eliminado correctamente!');
    }
}
