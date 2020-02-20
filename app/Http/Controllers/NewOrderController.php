<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Consumer;
use App\Business;
use App\Item;

class NewOrderController extends Controller
{
    public function newConsumer() {
      return view('newOrder.newConsumer');
    }

    public function saveConsumer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:25',
            'last_name' => 'required|max:50',
            'email' => 'required|email',
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

        $consumer = Consumer::create($request->all());
        $PosiblesBusiness = Business::where('zipcode',$consumer->zipcode)->get();
        session(['business'=>$PosiblesBusiness, 'consumer'=>$consumer]);
        return redirect()->route('restaurantes');
    }

    public function restaurantes() {
      return view('newOrder.restaurante');
    }

    public function restSelected(Request $request) {
      $validator = Validator::make($request->all(), [
          'business_id' => 'required'
      ]);
      if ($validator->fails()) {
        return back()
                    ->withErrors($validator)
                    ->withInput();
      }
      $products = Item::where('business_id', $request->business_id)->get();
      session(['products'=>$products]);
      return redirect()->route('carrito');
    }

    public function carrito() {
      return view('newOrder.shopping_cart');
    }
}
