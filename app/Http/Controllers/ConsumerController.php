<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Consumer;

// TODO: Mostrar errores
class ConsumerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consumers = Consumer::all();
        $columns = Consumer::getTableColumns();
        return view('consumers.index', ['consumers'=>$consumers, 'columns'=>$columns]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $columns = Consumer::getTableColumns();
        return view('consumers.create', ['columns'=>$columns]);
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
            'address' => 'required',
            'zipcode' => 'required',
            'phone' => 'required'
        ]);
        $request->merge([
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        Consumer::create($request->all());

        // TODO: Cambiar texto hardcodeado
        return redirect()->route('consumers.index')
                        ->withSuccess('Cliente creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $columns = Consumer::getTableColumns();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $columns = Consumer::getTableColumns();
        return view('consumers.edit', ['consumer' => Consumer::findOrFail($id), 'columns' => $columns]);
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
            'address' => 'required',
            'zipcode' => 'required',
            'phone' => 'required'
        ]);
        $consumer = Consumer::findOrFail($id);

        $consumer->update($request->all());
        $consumer->touch();
        return back()->withSuccess('Cliente actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $consumer = Consumer::findOrFail($id);
        $consumer->delete();
        return redirect()->route('consumers.index')
                        ->withSuccess('Cliente eliminado correctamente!');
    }
}
