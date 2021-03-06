<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
	protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $dates = ['approved_at'];

    protected $fillable = ['id', 'boutiqueID', 'customerID', 'status', 'itemID', 'dateToUse', 'addressID', 'notes', 'dateToBeReturned', 'approved_at', 'completed_at', 'orderID'    , 'measurementID'];


    public function customer()
    {
        return $this->hasOne('App\User', 'id', 'customerID');
    }

    public function boutique()
    {
        return $this->hasOne('App\Boutique', 'id', 'boutiqueID');
    }

    public function product()
    {
        return $this->hasOne('App\Product', 'id', 'itemID');
    }

    public function address()
    {
        return $this->hasOne('App\Address', 'id', 'addressID');
    }

    public function measurement()
    {
        return $this->hasOne('App\Measurement', 'id', 'measurementID');
    }

    public function order()
    {
        return $this->hasOne('App\Order', 'id', 'orderID');
    }

    public function brgys()
    {
        return $this->hasMany('App\Barangays', 'brgyCode', 'locationsAvailable');
    }

    public function set()
    {
        return $this->hasOne('App\Set', 'id', 'itemID');
    }

    public function declineDetails()
    {
        return $this->hasOne('App\Declinedtransaction', 'id', 'status');
    }
}
