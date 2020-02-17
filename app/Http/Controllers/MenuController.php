<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Menu;
use App\Menu_Name;
use App\Business;

// TODO: Mostrar si hay errores al realizar una acción
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        $columns = Menu::getTableColumns();
        $columns[1] = 'Nombre del menú';
        array_splice($columns, 2, 0, 'Nombre del negocio');
        return view('menus.index', ['menus'=>$menus, 'columns'=>$columns, 'lang'=>'ES']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $columns = Menu::getTableColumns();
        $businesses = Business::all('id', 'name');
        return view('menus.create', ['columns'=>$columns, 'businesses'=>$businesses]);
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
            'name' => 'required',
            'business_id' => 'required',
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
            'lang' => 'ES',
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
    public function show($id)
    {
        $columns = Menu::getTableColumns();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // TODO: Cambiar valores
        $columns = Menu::getTableColumns();
        $menu = Menu::findOrFail($id);
        $menu_name = $menu->names()->where('lang', 'ES')->value('name');
        return view('menus.edit', ['menu' => $menu, 'columns' => $columns, 'menu_name' => $menu_name]);
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
            'menu_name' => 'required',
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
        $menu->names()->where('lang', 'ES')->update(['name' => $request->menu_name]);

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
                        ->withSuccess('Menu eliminado correctamente!');
    }
}
