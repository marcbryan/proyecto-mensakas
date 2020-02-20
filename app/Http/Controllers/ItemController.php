<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use App\Item;
use App\Item_Name;
use App\ItemType_Name;
use App\Business;

class ItemController extends Controller
{
    private $lang = 'ES';

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
        $items = Item::all();
        $columns = Item::getTableColumns();
        return view('items.index', ['items'=>$items, 'columns'=>$columns, 'lang'=>$this->lang, 'keys'=>Item::getFilterKeys()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $columns = Item::getTableColumns();
        $businesses = Business::all('id', 'name');
        $types = ItemType_Name::where('lang', $this->lang)->get();
        return view('items.create', ['columns'=>$columns, 'businesses'=>$businesses, 'types'=>$types]);
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
            'name' => 'required|max:255',
            'business_id' => 'required',
            'price' => 'required|numeric|min:0.01',
            'type' => 'required',
            'image_url' => 'nullable|max:255|url'
        ]);
        if ($validator->fails()) {
          return back()
                      ->withErrors($validator)
                      ->withInput();
        }

        $item = Item::create($request->except(['name']));

        Item_Name::create([
            'name'=> $request->name,
            'item_id' => $item->id,
            'lang' => $this->lang,
        ]);

        return redirect()->route('items.index')
                        ->with('success', 'Producto creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $columns = Item::getTableColumns();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $columns = Item::getTableColumns();
        $item = Item::findOrFail($id);
        $item_name = $item->names()->where('lang', $this->lang)->value('name');
        $types = ItemType_Name::where('lang', $this->lang)->get();
        return view('items.edit', ['item' => $item, 'columns' => $columns, 'item_name' => $item_name, 'types' => $types]);
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
            'item_name' => 'required|max:255',
            'price' => 'required|numeric|min:0.01',
            'type' => 'required',
            'image_url' => 'nullable|max:255|url'
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
        $item = Item::findOrFail($id);
        $item->update($request->except(['item_name']));
        $item->names()->where('lang', $this->lang)->update(['name' => $request->item_name]);

        return back()->withSuccess('Producto actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return redirect()->route('items.index')
                        ->withSuccess('Producto eliminado correctamente!');
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
        if ($request->column == 'price') {
          $items = Item::where($request->column, 'LIKE', '%'.$request->value.'%')->get();
        }
        else if ($request->column == 'product_name') {
          $names = Item_Name::where('lang', $this->lang)->where('name', 'LIKE', '%'.$request->value.'%')->get();
          $items = new Collection();
          foreach ($names as $name) {
            $items->push($name->item);
          }
        }
        else if ($request->column == 'business_name') {
          $businesses = Business::where('name', 'LIKE', '%'.$request->value.'%')->get();
          $items = new Collection();
          foreach ($businesses as $business) {
            $found = Item::where('business_id', $business->id)->get();
            $items = $items->merge($found);
          }
        }
        else if ($request->column == 'type') {
          $types = ItemType_Name::where('lang', $this->lang)->where('name', 'LIKE', '%'.$request->value.'%')->get();
          $items = new Collection();
          foreach ($types as $type) {
            $found = Item::where($request->column, $type->type)->get();
            $items = $items->merge($found);
          }
        }
        $columns = Item::getTableColumns();
        return view('items.index', ['items'=>$items, 'columns'=>$columns, 'lang'=>$this->lang, 'keys'=>Item::getFilterKeys()]);
    }
}
