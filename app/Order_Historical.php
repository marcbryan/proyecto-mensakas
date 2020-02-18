<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order_Historical extends Model
{
    protected $guarded = array();
    protected $table = "order_historical";
}
