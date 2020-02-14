<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use App\Menu;
use App\Menu_Name;
use App\Business;

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
        $columns = Schema::getColumnListing('menus');
        return view('menus.index', ['menus'=>$menus, 'columns'=>$columns, 'lang'=>'ES']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $columns = Schema::getColumnListing('menus');
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
            'text' => 'required',
            'business_id' => 'required',
        ]);
        if ($validator->fails()) {
          return redirect('menus/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        $request->merge(['sort' => 1]);
        $menu = Menu::create($request->except(['text']));

        Menu_Name::create([
            'text'=> $request->text,
            'menu_id' => $menu->id,
            'lang' => 'ES',
        ]);

        // TODO: Cambiar texto hardcodeado
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
        $columns = Schema::getColumnListing('menus');
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
        $columns = Schema::getColumnListing('menus');
        $menu = Menu::findOrFail($id);
        $menu_name = $menu->names()->where('lang', 'ES')->value('text');
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
        // TODO: Cambiar valores
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ]);
        $menu = Menu::findOrFail($id);

        $oldPass = hash('sha256', $request->old_pass);
        if ($oldPass == $menu->password) {
          $request->merge([
            'password' => hash('sha256', $request->password)
          ]);
          $menu->update($request->except(['old_pass']));
        } else {
          $menu->update($request->except(['password', 'old_pass']));
        }
        $menu->touch();
        return redirect('/menus/'.$id.'/edit')->with('status', 'Menu actualizado correctamente!');
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
                        ->with('status','Menu eliminado correctamente!');
    }
}
