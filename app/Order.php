<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['id', 'userID', 'transactionID', 'subtotal', 'deliveryfee', 'total', 'boutiqueID', 'status', 'paymentStatus', 'deliverySchedule', 'boutiqueShare', 'adminShare', 'addressID', 'payoutID', 'courierID', 'alterationID'];
    

    public function cart()
    {
        return $this->hasOne('App\Cart', 'id', 'transactionID');
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
        return $this->hasOne('App\Rent', 'id', 'transactionID');
    }

    public function mto()
    {
        return $this->hasOne('App\Mto', 'id', 'transactionID');
    }

    public function customer()
    {
        return $this->hasOne('App\User', 'id', 'userID');
    }

    public function bidding()
    {
        return $this->hasOne('App\Bidding', 'id', 'transactionID');
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

    public function refund()
    {
        return $this->hasOne('\App\Refund', 'orderID', 'id');
    }
    
}
