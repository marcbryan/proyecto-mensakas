<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Superuser extends Model
{
    protected $guarded = array();

    public static function getTableColumns() {
      $columns = DB::select(DB::raw('SHOW COLUMNS FROM superusers'));
      return array_column($columns, 'Field');
    }

    public static function getFilterKeys() {
      return ['first_name' => 'Nombre', 'last_name' => 'Apellidos', 'email' => 'Correo electrónico'];
    }
}
