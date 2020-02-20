<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Consumer;
use App\Business;

class ConsumerController extends Controller
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
        $consumers = Consumer::all();
        $columns = Consumer::getTableColumns();
        return view('consumers.index', ['consumers'=>$consumers, 'columns'=>$columns, 'keys'=>Consumer::getFilterKeys()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('consumers.create');
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
            'email' => 'required|email|unique:App\Consumer,email',
            'address' => 'required|max:255',
            'zipcode' => 'required|digits:5',
            'phone' => 'required|integer|digits:9'
        ]);
        if ($validator->fails()) {
          return back()
                      ->withErrors($validator)
                      ->withInput();
        }
        $request->merge([
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        Consumer::create($request->all());

        return redirect()->route('consumers.index')
                        ->withSuccess('Cliente creado correctamente.');
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
        return view('consumers.edit', ['consumer' => Consumer::findOrFail($id)]);
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
            'email' => 'required|email|unique:App\Consumer,email',
            'address' => 'required|max:255',
            'zipcode' => 'required|digits:5',
            'phone' => 'required|integer|digits:9'
        ]);
        if ($validator->fails()) {
          return back()
                      ->withErrors($validator)
                      ->withInput();
        }
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
        $consumers = Consumer::where($request->column, 'LIKE', '%'.$request->value.'%')->get();
        $columns = Consumer::getTableColumns();
        return view('consumers.index', ['consumers'=>$consumers, 'columns'=>$columns, 'keys'=>Consumer::getFilterKeys()]);
    }
}
