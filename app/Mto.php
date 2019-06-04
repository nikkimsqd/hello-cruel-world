<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mto extends Model
{
    protected $fillable = ['userID', 'boutiqueID', 'notes', 'dateOfUse', 'measurementID', 'height', 'categoryID', 'status', 'paymentStatus', 'paypalOrderID'];

    public function customer()
    {
        return $this->hasOne('App\User', 'id', 'userID');
    }

    public function boutique()
    {
        return $this->hasOne('App\Boutique', 'id', 'boutiqueID');
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
