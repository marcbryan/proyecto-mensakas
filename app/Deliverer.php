<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deliverer extends Model
{
    protected $guarded = array();

    public static function getTableColumns() {
      return ['id' => 'ID', 'first_name' => 'Nombre', 'last_name' => 'Apellidos', 'email' => 'Correo electrónico', 'status' => 'Estado', 'created_at' => 'Fecha creación', 'updated_at' => 'Fecha modificación'];
    }

    public static function getFilterKeys() {
      return ['first_name' => 'Nombre', 'last_name' => 'Apellidos', 'email' => 'Correo electrónico'];
    }
}
