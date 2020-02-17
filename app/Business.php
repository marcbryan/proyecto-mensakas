<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Business extends Model
{
    protected $table = "businesses";
    protected $guarded = array();

    public static function getTableColumns() {
      $columns = DB::select(DB::raw('SHOW COLUMNS FROM businesses'));
      return array_column($columns, 'Field');
    }

    public function menus() {
      return $this->hasMany('App\Menu');
    }
}
