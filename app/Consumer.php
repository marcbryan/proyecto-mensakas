<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consumer extends Model
{
    protected $guarded = array();

    public static function getTableColumns() {
      return ['id', 'first_name', 'last_name', 'email', 'address', 'zipcode', 'phone', 'status'];
    }

    public static function getFilterKeys() {
      return ['first_name' => 'Nombre', 'last_name' => 'Apellidos', 'email' => 'Correo electrónico', 'address' => 'Dirección', 'zipcode' => 'Código Postal', 'phone' => 'Teléfono'];
    }
}
