<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mto extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['id', 'userID', 'boutiqueID', 'notes', 'deadlineOfProduct', 'measurementID', 'fabChoice', 'quantity', 'numOfPerson', 'price', 'orderID', 'status', 'nameOfWearers'];

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
        return $this->hasOne('App\File', 'typeID', 'id');
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
