<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $guarded = array();
    protected $table = "orders";

    public static function getTableColumns() {
      $cols = DB::select(DB::raw('SHOW COLUMNS FROM orders'));
      array_pop($cols);
      $cols = array_column($cols, 'Field');
      $translations = ['ID', 'ID cliente', 'Nombre del negocio', 'ID del deliverer', 'Estado', 'JSON', 'Fecha creación'];
      $columns = array();
      foreach ($cols as $i=>$col) {
        $columns[$col] = $translations[$i];
      }
      return $columns;
    }

    public function business()
    {
      return $this->belongsTo('App\Business');
    }

    public static function getFilterKeys() {
      return ['user_id' => 'ID cliente', 'business_name' => 'Nombre del negocio', 'deliverer_id' => 'ID deliverer'];
    }
}
