<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item_Name extends Model
{
    public $timestamps = false;
    protected $table = "item_names";
    protected $guarded = array();

    public function item()
    {
        return $this->belongsTo('App\Item');
    }
}
