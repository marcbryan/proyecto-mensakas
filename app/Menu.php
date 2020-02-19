<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $timestamps = false;
    protected $guarded = array();

    public static function getTableColumns() {
      return ['id' => 'ID', 'name' => 'Nombre del menú', 'business_id' => 'Nombre del negocio', 'price' => 'Precio', 'status' => 'Estado'];
    }

    public function names()
    {
      return $this->hasMany('App\Menu_Name');
    }

    public function nameIn($lang)
    {
      return $this->names()->where('lang', $lang)->value('name');
    }

    public function business()
    {
      return $this->belongsTo('App\Business');
    }

    public static function getFilterKeys() {
      return ['menu_name' => 'Nombre del menú', 'business_name' => 'Nombre del negocio', 'price' => 'Precio'];
    }
}
