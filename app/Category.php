<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    public $timestamps = false;
    protected $guarded = array();

    public static function getTableColumns() {
      $columns = DB::select(DB::raw('SHOW COLUMNS FROM categories'));
      return array_column($columns, 'Field');
    }

    public function names()
    {
      return $this->hasMany('App\Category_Name');
    }

    public function nameIn($lang)
    {
      return $this->names()->where('lang', $lang)->value('name');
    }
}
