<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Consumer;

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
        $columns = Schema::getColumnListing('consumers');
        return view('consumers.index', ['consumers'=>$consumers, 'columns'=>$columns]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $columns = Schema::getColumnListing('consumers');
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
        $consumer = $request->all();
        $consumer->created_at = now();
        $consumer->updated_at = now();

        Consumer::create($consumer);

        // TODO: Cambiar texto hardcodeado
        return redirect()->route('consumers.index')
                        ->with('success', 'Consumer creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $columns = Schema::getColumnListing('consumers');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $columns = Schema::getColumnListing('consumers');
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
        return redirect('/consumers/'.$id.'/edit')->with('status', 'Consumer actualizado correctamente!');
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
                        ->with('status','Consumer eliminado correctamente!');
    }
}
