<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartitem extends Model
{
	public $table = 'cartitems';
    protected $fillable = ['cartID', 'productID'];
 	
 	public function getCart()
 	{
        return $this->hasOne('App\Cart', 'id', 'cartID');
 	}

 	public function product()
 	{
        return $this->hasOne('App\Product', 'productID', 'productID');
 	}
}
