<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Business;
use App\Business_TimeTable;

class BusinessController extends Controller
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
        $businesses = Business::all();
        $columns = Business::getTableColumns();
        return view('businesses.index', ['businesses'=>$businesses, 'columns'=>$columns, 'keys'=>Business::getFilterKeys()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $columns = Business::getTableColumns();
        $days = ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'];
        return view('businesses.create', ['columns'=>$columns, 'days'=>$days]);
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
            'name' => 'required|max:40',
            'address' => 'required|max:200',
            'phone' => 'required|integer|digits:9',
            'email' => 'required|email|unique:App\Business,email',
            'zipcode' => 'required|digits:5',
            'open' => 'required',
            'close' => 'required|after:open'
        ]);
        $days = array();
        $except = ['open', 'close'];
        for ($i=1; $i <= 7; $i++) {
          if ($request->has('weekday-'.$i)) {
            array_push($days, $i);
            array_push($except, 'weekday-'.$i);
          }
        }
        if ($validator->fails() || count($days) == 0) {
          if (count($days) == 0) {
            $validator->errors()->add('weekday', 'No has seleccionado ningún día de la semana.');
          }
          return back()
                      ->withErrors($validator)
                      ->withInput();
        }
        $request->merge([
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        $business = Business::create($request->except($except));
        foreach ($days as $day) {
          Business_TimeTable::create(['business_id'=>$business->id, 'day'=>$day, 'open'=>$request->open, 'close'=>$request->close]);
        }

        return redirect()->route('businesses.index')
                        ->withSuccess('Negocio creado correctamente.');
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:40',
            'address' => 'required|max:200',
            'phone' => 'required|integer|digits:9',
            'email' => 'required|email|unique:App\Business,email',
            'zipcode' => 'required|digits:5',
        ]);
        if ($validator->fails()) {
          return back()
                      ->withErrors($validator)
                      ->withInput();
        }
        if ($request->has('status')) {
          $request->merge(['status' => 1]);
        } else {
          $request->merge(['status' => 0]);
        }
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
      $businesses = Business::where($request->column, 'LIKE', '%'.$request->value.'%')->get();
      $columns = Business::getTableColumns();
      return view('businesses.index', ['businesses'=>$businesses, 'columns'=>$columns, 'keys'=>Business::getFilterKeys()]);
    }
}
