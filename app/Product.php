<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $primaryKey = 'productID';
    protected $fillable = [

        'boutiqueID', 'fileID', 'productName', 'productDesc', 'productPrice', 'category', 'productStatus', 'forRent', 'forSale', 'gender', 'customizable'
        
    ];

     public function productFile()
    {
        return $this->hasMany('App\File', 'productID', 'productID');
    }

    public function owner()
    {
        return $this->hasOne('App\Boutique', 'id', 'boutiqueID');
    }

    public function getCategory()
    {
        return $this->hasOne('App\Category', 'id', 'category');
    }
}
