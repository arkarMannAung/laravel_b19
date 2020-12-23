<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Subcategories;
use App\Items;
class Categories extends Model
{
    protected $fillable = [
    	'name','logo',
    ];
	public function subcategories()
    {
      return $this->hasMany('App\Subcategories');
    }
	public function items()
	{
  	  return $this->hasManyThrough('App\Items', 'App\Subcategories');
	}
}
