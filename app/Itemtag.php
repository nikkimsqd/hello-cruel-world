<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itemtag extends Model
{
    protected $fillable = ['tagID', 'itemID', 'itemType'];

    // itemType : product, set

    public function tag()
    {
        return $this->hasOne('App\Tag', 'id', 'tagID');
    }

    public function product()
    {
        return $this->hasOne('App\Product', 'id', 'itemID');
    }

    public function set()
    {
        return $this->hasOne('App\Set', 'id', 'itemID');
    }
}
