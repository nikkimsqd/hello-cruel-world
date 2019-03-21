<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Declinedrent extends Model
{
    protected $fillable = ['rentID', 'reason'];

    public function rent()
    {
    	return $this->hasOne('App\Rent', 'rentID', 'rentID');
    }

}
