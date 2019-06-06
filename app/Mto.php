<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mto extends Model
{
    protected $fillable = ['userID', 'boutiqueID', 'notes', 'dateOfUse', 'measurementID', 'height', 'categoryID', 'status', 'paymentStatus', 'paypalOrderID', 'budget', 'subtotal', 'deliveryFee', 'total', 'deliveryAddress', 'orderID'];

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

    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'categoryID');
    }

    public function productFile()
    {
        return $this->hasOne('App\File', 'mtoID', 'id');
    }
    
    public function order()
    {
        return $this->hasOne('App\Order', 'id', 'orderID');
    }
}
