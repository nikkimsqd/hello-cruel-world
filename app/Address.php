<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
    	'userID', 'contactName', 'phoneNumber', 'completeAddress', 'lat', 'lng', 'status'
    ];


    public function user()
    {
        return $this->hasOne('App\User', 'id', 'userID');
    }
    
}
