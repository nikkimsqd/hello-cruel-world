<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setitem extends Model
{
    protected $fillable = ['setID', 'productID'];

 	public function getSet()
 	{
        return $this->hasOne('App\Set', 'id', 'setID');
 	}

 	public function product()
 	{
        return $this->hasOne('App\Product', 'id', 'productID');
 	}
}
