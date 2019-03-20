<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['userID', 'productID', 'status'];

    public function owner()
    {
        return $this->hasOne('App\User', 'id', 'userID');
    }

    public function product()
    {
    	return $this->hasOne('App\Product', 'productID', 'productID');
    }

    public function productFile()
    {
        return $this->hasOne('App\File', 'productID', 'productID');
    }
}
