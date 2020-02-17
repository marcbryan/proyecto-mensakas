<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Deliverer extends Model
{
    protected $guarded = array();

    public static function getTableColumns() {
      $columns = DB::select(DB::raw('SHOW COLUMNS FROM deliverers'));
      return array_column($columns, 'Field');
    }
}
