<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $fillable = ['orderID', 'amount', 'paypalEmail'];

    public function order()
    {
        return $this->hasOne('App\Order', 'id', 'orderID');
    }
}
