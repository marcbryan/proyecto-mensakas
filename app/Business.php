<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $table = "businesses";
    protected $guarded = array();

    public static function getTableColumns() {
      return ['id' => 'ID', 'name' => 'Nombre', 'email' => 'Correo electrónico', 'address' => 'Dirección', 'zipcode' => 'Código postal', 'phone' => 'Teléfono', 'status' => 'Estado'];
    }

    public static function getFilterKeys() {
      return ['name' => 'Nombre', 'email' => 'Correo electrónico', 'zipcode' => 'Código postal', 'phone' => 'Teléfono'];
    }

    public function menus() {
      return $this->hasMany('App\Menu');
    }

    public function orders() {
      return $this->hasMany('App\Order');
    }
}
