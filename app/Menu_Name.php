<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu_Name extends Model
{
    public $timestamps = false;
    protected $table = "menu_names";
    protected $guarded = array();

    public function menu()
    {
        return $this->belongsTo('App\Menu', 'foreign_key');
    }
}
