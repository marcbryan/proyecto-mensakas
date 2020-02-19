<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consumer extends Model
{
    protected $guarded = array();

    public static function getTableColumns() {
      return ['id' => 'ID', 'first_name' => 'Nombre', 'last_name' => 'Apellidos', 'email' => 'Correo electrónico', 'address' => 'Dirección', 'zipcode' => 'Código postal', 'phone' => 'Teléfono', 'status' => 'Estado'];
    }

    public static function getFilterKeys() {
      return ['first_name' => 'Nombre', 'last_name' => 'Apellidos', 'email' => 'Correo electrónico', 'address' => 'Dirección', 'zipcode' => 'Código Postal', 'phone' => 'Teléfono'];
    }
}
