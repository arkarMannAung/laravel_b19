<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Brands;
use App\Subcategories;

class Items extends Model
{
    protected $fillable = [
    	'codeno','name','photo','price','discount','description','brand_id','subcategory_id'
    ];
    public function subcategory(){
    	return $this->belongsTo('App\Subcategories');
    }
    public function brand(){
    	return $this->belongsTo('App\Brands');
    }
    public function Orders(){
    	return $this->belongsToMany('App\Order','item_orders')
    				->withPivot('qty')
    				->withTimestamps();
    }
}
