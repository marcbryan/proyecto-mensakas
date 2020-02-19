<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    public $timestamps = false;
    protected $guarded = array();

    public static function getTableColumns() {
      $cols = DB::select(DB::raw('SHOW COLUMNS FROM items'));
      $cols = array_column($cols, 'Field');
      array_splice($cols, 2, 0, 'name');
      $translations = ['ID', 'Nombre del producto', 'Nombre del negocio', 'Precio', 'Estado', 'Tipo', 'Tiene extras?', 'Enlace imagen'];
      $columns = array();
      foreach ($cols as $i=>$col) {
        $columns[$col] = $translations[$i];
      }
      return $columns;
    }

    public function names()
    {
      return $this->hasMany('App\Item_Name');
    }

    public function nameIn($lang)
    {
      return $this->names()->where('lang', $lang)->value('name');
    }

    public function typeIn($lang)
    {
      return ItemType_Name::where('type', $this->type)->where('lang', $lang)->value('name');
    }

    public function business()
    {
      return $this->belongsTo('App\Business');
    }

    public static function getFilterKeys() {
      return ['product_name' => 'Nombre del producto', 'business_name' => 'Nombre del negocio', 'price' => 'Precio', 'type' => 'Tipo'];
    }
}
