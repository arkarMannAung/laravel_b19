<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
        protected $fillable = [
    	'orderdate','voucherno','total','note','status'
    ];
    public function items(){
    	return $this->belongsToMany('App\Items','item_orders')
    				->withPivot('qty')
    				->withTimestamps();
    }
}
