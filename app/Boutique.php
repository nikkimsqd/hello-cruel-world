<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boutique extends Model
{
    protected $fillable = ['userID', 'boutiqueName', 'boutiqueAddress', 'contactNo', 'status', 'storeHours', 'addressID', 'paypalAccountID'];


    public function owner()
    {
        return $this->hasOne('App\User', 'id', 'userID');
    }

    public function address()
    {
        return $this->hasOne('App\Address', 'id', 'addressID');
    }

    public function paypalEmail()
    {
        return $this->hasOne('App\Paypalaccount', 'id', 'paypalAccountID');
    }
}
