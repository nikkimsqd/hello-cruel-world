<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['userID', 'cartID', 'mtoID', 'biddingID', 'subtotal', 'deliveryfee', 'total', 'boutiqueID', 'deliveryAddress', 'status', 'rentID', 'paymentStatus','paypalOrderID', 'deliverySchedule', 'alterationDateStart', 'alterationDateEnd', 'billingName', 'phoneNumber', 'boutiqueShare', 'adminShare', 'addressID'];
    

    public function cart()
    {
        return $this->hasOne('App\Cart', 'id', 'cartID');
    }

    public function boutique()
    {
        return $this->hasOne('App\Boutique', 'id', 'boutiqueID');
    }

    public function address()
    {
        return $this->hasOne('App\Address', 'id', 'addressID');
    }

    public function rent()
    {
        return $this->hasOne('App\Rent', 'rentID', 'rentID');
    }

    public function mto()
    {
        return $this->hasOne('App\Mto', 'id', 'mtoID');
    }

    public function customer()
    {
        return $this->hasOne('App\User', 'id', 'userID');
    }

    public function bidding()
    {
        return $this->hasOne('App\Bidding', 'id', 'biddingID');
    }
    
}
