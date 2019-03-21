<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
    	'userID', 'contactName', 'phoneNumber', 'province', 'city', 'barangay', 'completeAddress', 'status'
    ];


    public function user()
    {
        return $this->hasOne('App\User', 'id', 'userID');
    }

    public function cityName()
    {
        return $this->hasOne('App\City', 'citymunCode', 'city');
    }

    public function brgyName()
    {
        return $this->hasOne('App\Barangay', 'brgyCode', 'barangay');
    }
    
}
