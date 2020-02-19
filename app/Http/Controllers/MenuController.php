<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use App\Menu;
use App\Menu_Name;
use App\Business;

class MenuController extends Controller
{
    private $lang = 'ES';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        $columns = Menu::getTableColumns();
        return view('menus.index', ['menus'=>$menus, 'columns'=>$columns, 'lang'=>$this->lang, 'keys'=>Menu::getFilterKeys()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $businesses = Business::all('id', 'name');
        return view('menus.create', ['businesses'=>$businesses]);
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
            'price' => 'required|numeric|min:0.01'
        ]);
        if ($validator->fails()) {
          return back()
                      ->withErrors($validator)
                      ->withInput();
        }
        $request->merge(['sort' => 1]);
        $menu = Menu::create($request->except(['name']));

        Menu_Name::create([
            'name'=> $request->name,
            'menu_id' => $menu->id,
            'lang' => $this->lang,
        ]);

        return redirect()->route('menus.index')
                        ->with('success', 'Menú creado correctamente.');
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
        $menu = Menu::findOrFail($id);
        $menu_name = $menu->names()->where('lang', $this->lang)->value('name');
        return view('menus.edit', ['menu' => $menu, 'menu_name' => $menu_name]);
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
            'menu_name' => 'required|max:255',
            'price' => 'required|numeric|min:0.01'
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
        $menu = Menu::findOrFail($id);
        $menu->update($request->except(['menu_name']));
        $menu->names()->where('lang', $this->lang)->update(['name' => $request->menu_name]);

        return back()->withSuccess('Menú actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return redirect()->route('menus.index')
                        ->withSuccess('Menú eliminado correctamente!');
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
          $menus = Menu::where($request->column, 'LIKE', '%'.$request->value.'%')->get();
        }
        else if ($request->column == 'menu_name') {
          $names = Menu_Name::where('lang', $this->lang)->where('name', 'LIKE', '%'.$request->value.'%')->get();
          $menus = new Collection();
          foreach ($names as $name) {
            $menus->push($name->menu);
          }
        }
        else if ($request->column == 'business_name') {
          $businesses = Business::where('name', 'LIKE', '%'.$request->value.'%')->get();
          $menus = new Collection();
          foreach ($businesses as $business) {
            $found = Menu::where('business_id', $business->id)->get();
            $menus = $menus->merge($found);
          }
        }

        $columns = Menu::getTableColumns();
        return view('menus.index', ['menus'=>$menus, 'columns'=>$columns, 'lang'=>$this->lang, 'keys'=>Menu::getFilterKeys()]);
    }
}
