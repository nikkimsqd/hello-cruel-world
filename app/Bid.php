<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $fillable = ['biddingID', 'boutiqueID', 'quotationPrice', 'fabricName'];

    public function bidding()
    {
        return $this->hasOne('App\Bidding', 'id', 'biddingID');
    }

    public function owner()
    {
        return $this->hasOne('App\Boutique', 'id', 'boutiqueID');
    }
}
