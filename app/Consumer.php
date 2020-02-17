<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Consumer extends Model
{
    protected $guarded = array();

    public static function getTableColumns() {
      $columns = DB::select(DB::raw('SHOW COLUMNS FROM consumers'));
      return array_column($columns, 'Field');
    }
}
