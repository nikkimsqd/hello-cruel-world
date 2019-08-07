<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mto extends Model
{
    protected $fillable = ['userID', 'boutiqueID', 'notes', 'deadlineOfProduct', 'measurementID', 'fabChoice', 'quantity', 'numOfPerson', 'price', 'orderID', 'status'];

    public function customer()
    {
        return $this->hasOne('App\User', 'id', 'userID');
    }

    public function boutique()
    {
        return $this->hasOne('App\Boutique', 'id', 'boutiqueID');
    }

    public function measurement()
    {
        return $this->hasOne('App\Measurement', 'id', 'measurementID');
    }

    public function productFile()
    {
        return $this->hasOne('App\File', 'mtoID', 'id');
    }
    
    public function order()
    {
        return $this->hasOne('App\Order', 'id', 'orderID');
    }

    public function declineDetails()
    {
        return $this->hasOne('App\Declinedtransaction', 'id', 'status');
    }
}
