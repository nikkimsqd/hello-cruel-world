<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Measurementrequest extends Model
{
    protected $fillable = ['type', 'typeID', 'categoryID', 'measurements'];

    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'categoryID');
    }
}
