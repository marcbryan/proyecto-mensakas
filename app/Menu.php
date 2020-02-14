<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $timestamps = false;
    protected $guarded = array();

    public function names()
    {
      return $this->hasMany('App\Menu_Name');
    }
}
