<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['itemID', 'userID'];

    public function product()
    {
        return $this->hasOne('App\Product', 'id', 'itemID');
    }

    public function set()
    {
        return $this->hasOne('App\Set', 'id', 'itemID');
    }
}
