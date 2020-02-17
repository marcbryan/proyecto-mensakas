<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    public $timestamps = false;
    protected $guarded = array();

    public static function getTableColumns() {
      $columns = DB::select(DB::raw('SHOW COLUMNS FROM items'));
      return array_column($columns, 'Field');
    }

    public function names()
    {
      return $this->hasMany('App\Item_Name');
    }

    public function nameIn($lang)
    {
      return $this->names()->where('lang', $lang)->value('name');
    }

    public function typeIn($lang)
    {
      return ItemType_Name::where('type', $this->type)->where('lang', $lang)->value('name');
    }

    public function business()
    {
      return $this->belongsTo('App\Business');
    }
}
