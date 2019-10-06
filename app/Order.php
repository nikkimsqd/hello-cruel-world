<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['userID', 'cartID', 'mtoID', 'biddingID', 'subtotal', 'deliveryfee', 'total', 'boutiqueID', 'deliveryAddress', 'status', 'rentID', 'paymentStatus','paypalOrderID', 'deliverySchedule', 'billingName', 'phoneNumber', 'boutiqueShare', 'adminShare', 'addressID', 'payoutID', 'courierID', 'alterationID'];
    

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

    public function payments()
    {
        return $this->hasMany('App\Payment', 'orderID', 'id');
    }

    public function payout()
    {
        return $this->hasOne('App\Payout', 'id', 'payoutID');
    }

    public function complain()
    {
        return $this->hasOne('App\Complain', 'orderID', 'id');
    }

    public function courier()
    {
        return $this->hasOne('App\Courier', 'id', 'courierID');
    }

    public function alteration()
    {
        return $this->hasOne('\App\Alteration', 'id', 'alterationID');
    }
    
}
