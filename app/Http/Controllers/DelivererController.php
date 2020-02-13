<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
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
        $columns = Schema::getColumnListing('deliverers');
        return view('deliverers.index', ['deliverers'=>$deliverers, 'columns'=>$columns]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $columns = Schema::getColumnListing('deliverers');
        return view('deliverers.create', ['columns'=>$columns]);
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
        $deliverer = $request->all();
        $deliverer->password = hash('sha256', $request->password);
        $deliverer->created_at = now();
        $deliverer->updated_at = now();

        Deliverer::create($deliverer);

        // TODO: Cambiar texto hardcodeado
        return redirect()->route('deliverers.index')
                        ->with('success', 'Deliverer creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $columns = Schema::getColumnListing('deliverers');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $columns = Schema::getColumnListing('deliverers');
        return view('deliverers.edit', ['deliverer' => Deliverer::findOrFail($id), 'columns' => $columns]);
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
        $deliverer = Deliverer::findOrFail($id);

        $oldPass = hash('sha256', $request->old_pass);
        if ($oldPass == $deliverer->password) {
          $request->merge([
            'password' => hash('sha256', $request->password)
          ]);
          $deliverer->update($request->except(['old_pass']));
        } else {
          $deliverer->update($request->except(['password', 'old_pass']));
        }
        $deliverer->touch();
        return redirect('/deliverers/'.$id.'/edit')->with('status', 'Deliverer actualizado correctamente!');
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
                        ->with('status','Deliverer eliminado correctamente!');
    }
}
