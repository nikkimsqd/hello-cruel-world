<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prodtag extends Model
{
    protected $fillable = ['tagID', 'productID'];

    public function tag()
    {
        return $this->hasOne('App\Tag', 'id', 'tagID');
    }

    public function product()
    {
        return $this->hasOne('App\Product', 'id', 'productID');
    }
}
