<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use App\Order;
use App\Deliverer;
use App\Business;

class OrderController extends Controller
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
        $orders = Order::all();
        $columns = Order::getTableColumns();
        return view('orders.index', ['orders'=>$orders, 'columns'=>$columns, 'keys'=>Order::getFilterKeys()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {}

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
        $deliverers = Deliverer::all();
        $columns = Order::getTableColumns();
        return view('orders.edit', ['order' => Order::findOrFail($id), 'deliverers' => $deliverers, 'columns' => $columns]);
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
            'deliverer_id' => 'integer',
            'status' => 'required|integer'
        ]);
        if ($validator->fails()) {
          return back()
                      ->withErrors($validator)
                      ->withInput();
        }
        $order = Order::findOrFail($id);
        $order->update($request->all());
        $order->touch();
        return back()->withSuccess('Pedido actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {}

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
      if ($request->column == 'business_name') {
        $businesses = Business::where('name', 'LIKE', '%'.$request->value.'%')->get();
        $orders = new Collection();
        foreach ($businesses as $business) {
          $found = Order::where('business_id', $business->id)->get();
          $orders = $orders->merge($found);
        }
      } else {
        $orders = Order::where($request->column, $request->value)->get();
      }
      $columns = Order::getTableColumns();
      return view('orders.index', ['orders'=>$orders, 'columns'=>$columns, 'keys'=>Order::getFilterKeys()]);
    }
}
