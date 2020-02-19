<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Consumer;

// TODO: Mostrar errores
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        $columns = Order::getTableColumns();
        return view('orders.index', ['orders'=>$orders, 'columns'=>$columns]);
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
    public function show($id)
    {
        $columns = Order::getTableColumns();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $columns = Order::getTableColumns();
        return view('orders.edit', ['order' => Order::findOrFail($id), 'columns' => $columns]);
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
            'status' => 'required',
        ]);
        $order = Order::findOrFail($id);
        $order->update($request->all());
        $order->touch();
        return back()->withSuccess('Pedido actualizado correctamente!');
    }

    /*public function storeAndSaveConsumerID(Request $request)
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
        return redirect()->route('newOrder.pedido');
    }
*/
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {}
}
