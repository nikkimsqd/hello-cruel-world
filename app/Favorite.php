<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['productID', 'setID', 'userID'];

    public function product()
    {
        return $this->hasOne('App\Product', 'id', 'productID');
    }

    public function set()
    {
        return $this->hasOne('App\Set', 'id', 'setID');
    }
}
