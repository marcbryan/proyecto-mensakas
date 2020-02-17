<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_Name extends Model
{
    public $timestamps = false;
    protected $table = "category_names";
    protected $guarded = array();

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
