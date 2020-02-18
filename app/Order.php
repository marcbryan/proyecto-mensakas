<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $guarded = array();
    protected $table = "orders";

    public static function getTableColumns() {
      $columns = DB::select(DB::raw('SHOW COLUMNS FROM orders'));
      return array_column($columns, 'Field');
    }
}
