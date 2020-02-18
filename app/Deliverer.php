<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deliverer extends Model
{
    protected $guarded = array();

    public static function getTableColumns() {
      return ['id', 'first_name', 'last_name', 'email', 'status', 'created_at', 'updated_at'];
    }

    public static function getFilterKeys() {
      return ['first_name' => 'Nombre', 'last_name' => 'Apellidos', 'email' => 'Correo electrónico'];
    }
}
