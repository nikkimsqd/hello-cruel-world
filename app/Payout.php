<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    protected $fillable = ['boutiqueID', 'paypalEmail'];

    public function order()
    {
        return $this->hasOne('App\Order', 'id', 'orderID');
    }
}
