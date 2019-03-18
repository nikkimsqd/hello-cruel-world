<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
	protected $primaryKey = 'rentID';
    protected $dates = ['approved_at'];

    protected $fillable = ['boutiqueID', 'customerID', 'status', 'productID', 'dateToUse', 'locationToBeUsed', 'addressOfDelivery', 'additionalNotes', 'dateToBeReturned', 'approved_at', 'completed_at'];


    public function customer()
    {
        return $this->hasOne('App\User', 'id', 'customerID');
    }

    public function product()
    {
        return $this->hasOne('App\Product', 'productID', 'productID');
    }
}
