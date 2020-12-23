<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item_order extends Model
{
    protected $fillable = [
    	'qty','item_id','order_id'
    ];
}
