<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mto extends Model
{
    protected $fillable = ['userID', 'boutiqueID', 'notes', 'dateOfUse', 'measurementID', 'height', 'categoryID'];

    public function customer()
    {
        return $this->hasOne('App\User', 'id', 'userID');
    }

    public function measurement()
    {
        return $this->hasOne('App\Measurement', 'id', 'measurementID');
    }

    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'categoryID');
    }
}
