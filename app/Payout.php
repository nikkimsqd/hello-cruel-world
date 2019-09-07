<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    protected $fillable = ['orderID', 'batchID', 'amount'];

    public function order()
    {
        return $this->hasOne('App\Order', 'id', 'orderID');
    }
}
