<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorymeasurement extends Model
{
    protected $fillable = ['categoryID', 'mName'];

    public function getCategory()
    {
        return $this->hasOne('App\Category', 'id', 'categoryID');
    }
}
