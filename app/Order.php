<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['userID', 'cartID', 'subtotal', 'deliveryfee', 'total', 'boutiqueID', 'deliveryAddress', 'status', 'rentID', 'paymentStatus', 'mtoID'];
    

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
        return $this->hasOne('App\Address', 'id', 'deliveryAddress');
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
    
}
