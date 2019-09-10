<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Declinedtransaction extends Model
{
    protected $fillable = ['type', 'typeID', 'reason'];

    public function rent()
    {
    	return $this->hasOne('App\Rent', 'id', 'typeID');
    }

    public function mto()
    {
    	return $this->hasOne('App\Mto', 'id', 'typeID');
    }
}
