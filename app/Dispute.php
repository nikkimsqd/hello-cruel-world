<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dispute extends Model
{
    protected $fillable = ['orderID', 'boutiqueID', 'dispute'];

    public function order()
    {
        return $this->hasOne('App\Order', 'id', 'orderID');
    }

    public function complain()
    {
        return $this->hasOne('App\Complain', 'orderID', 'orderID');
    }
}
