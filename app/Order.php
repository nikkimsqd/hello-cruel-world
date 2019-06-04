<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['userID', 'cartID', 'subtotal', 'deliveryfee', 'total', 'boutiqueID', 'deliveryAddress', 'status', 'rentID', 'paymentStatus'];
    

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
    
}
