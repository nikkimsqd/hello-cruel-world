<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boutique extends Model
{
    protected $fillable = ['userID', 'boutiqueName', 'boutiqueAddress', 'contactNo', 'status', 'storeHours', 'addressID'];


    public function owner()
    {
        return $this->hasOne('App\User', 'id', 'userID');
    }

    public function address()
    {
        return $this->hasOne('App\Address', 'id', 'addressID');
    }
}
