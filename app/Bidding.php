<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bidding extends Model
{
    protected $fillable = ['userID', 'maxPriceLimit', 'endDate', 'deadlineOfProduct', 'measurement', 'height', 'category', 'notes', 'orderID', 'status'];

    public function owner()
    {
        return $this->hasOne('App\User', 'id', 'userID');
    }

    public function productFile()
    {
        return $this->hasMany('App\File', 'biddingID', 'id');
    }

    public function order()
    {
        return $this->hasOne('App\Order', 'biddingID', 'id');
    }

    public function measurement()
    {
        return $this->hasOne('App\Measurement', 'id', 'measurementID');
    }
}
