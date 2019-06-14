<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
	protected $primaryKey = 'rentID';
    protected $dates = ['approved_at'];

    protected $fillable = ['boutiqueID', 'customerID', 'status', 'productID', 'dateToUse', 'locationToBeUsed', 'addressOfDelivery', 'additionalNotes', 'dateToBeReturned', 'approved_at', 'completed_at', 'orderID', 'subtotal', 'deliveryFee', 'total', 'measurementID', 'paymentStatus', 'paypalOrderID', 'amountDeposit', 'amountPenalty'];


    public function customer()
    {
        return $this->hasOne('App\User', 'id', 'customerID');
    }

    public function product()
    {
        return $this->hasOne('App\Product', 'id', 'productID');
    }

    public function address()
    {
        return $this->hasOne('App\Address', 'id', 'addressOfDelivery');
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
}
