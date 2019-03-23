<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bidding extends Model
{
    protected $fillable = ['productType', 'startingprice', 'notes', 'endDate', 'dateOfUse'];

    public function productFile()
    {
        return $this->hasMany('App\File', 'biddingID', 'id');
    }
}
