<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $fillable = ['userID', 'itemID', 'count'];

 	public function product()
 	{
        return $this->hasOne('App\Product', 'id', 'itemID');
 	}

 	public function set()
 	{
        return $this->hasOne('App\Set', 'id', 'itemID');
 	}
}
