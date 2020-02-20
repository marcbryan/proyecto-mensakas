<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    public $timestamps = false;
    protected $guarded = array();

    public static function getTableColumns() {
      $cols = DB::select(DB::raw('SHOW COLUMNS FROM categories'));
      array_pop($cols);
      $cols = array_column($cols, 'Field');
      array_splice($cols, 1, 0, 'name');
      $translations = ['ID', 'Nombre de la categoría', 'Icono', 'Color', 'Estado'];
      $columns = array();
      foreach ($cols as $i=>$col) {
        $columns[$col] = $translations[$i];
      }
      return $columns;
    }

    public function names()
    {
      return $this->hasMany('App\Category_Name');
    }

    public function nameIn($lang)
    {
      return $this->names()->where('lang', $lang)->value('name');
    }

    public static function getFilterKeys() {
      return ['name' => 'Nombre de la categoría'];
    }
}
