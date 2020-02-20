<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business_TimeTable extends Model
{
    protected $table = "business_timetable";
    protected $guarded = array();
    public $timestamps = false;
}
