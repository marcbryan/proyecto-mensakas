<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Category;
use App\Category_Name;
use App\Business;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $columns = Category::getTableColumns();;
        array_splice($columns, 1, 0, 'Nombre de la categoría');
        return view('categories.index', ['categories'=>$categories, 'columns'=>$columns, 'lang'=>'ES']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $columns = Category::getTableColumns();
        return view('categories.create', ['columns'=>$columns]);
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
            'icon' => 'nullable|max:255|url',
            'color' => 'nullable'
        ]);
        if ($validator->fails()) {
          return back()
                      ->withErrors($validator)
                      ->withInput();
        }

        $category = Category::create($request->except(['name']));

        Category_Name::create([
            'name'=> $request->name,
            'category_id' => $category->id,
            'lang' => 'ES',
        ]);

        return redirect()->route('categories.index')
                        ->with('success', 'Categoría creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $columns = Category::getTableColumns();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $columns = Category::getTableColumns();
        $category = Category::findOrFail($id);
        $category_name = $category->names()->where('lang', 'ES')->value('name');
        return view('categories.edit', ['category' => $category, 'columns' => $columns, 'category_name' => $category_name]);
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
            'category_name' => 'required|max:255',
            'icon' => 'nullable|max:255|url',
            'color' => 'nullable|max:7'
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
        $category = Category::findOrFail($id);
        $category->update($request->except(['category_name']));
        $category->names()->where('lang', 'ES')->update(['name' => $request->category_name]);

        return back()->withSuccess('Categoría actualizada correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')
                        ->withSuccess('Categoría eliminada correctamente!');
    }
}
