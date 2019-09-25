<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorytag extends Model
{
    protected $fillable = ['categoryID', 'tagName'];

    public function getCategory()
    {
        return $this->hasOne('App\Category', 'id', 'categoryID');
    }
}
