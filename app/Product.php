<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	// protected $primaryKey = 'productID';
    protected $fillable = ['boutiqueID', 'productName', 'productDesc', 'price', 'category', 'productStatus', 'rpID', 'quantity', 'setID', 'measurements', 'measurementNames', 'rtwID'];

    public function productFile()
    {
        return $this->hasMany('App\File', 'productID', 'id');
    }

    public function owner()
    {
        return $this->hasOne('App\Boutique', 'id', 'boutiqueID');
    }

    public function getCategory()
    {
        return $this->hasOne('App\Category', 'id', 'category');
    }

    public function getTags()
    {
        return $this->hasOne('App\Tag', 'id', 'tags');
    }

    public function rentDetails()
    {
        return $this->hasOne('App\Rentableproduct', 'id', 'rpID');
    }

    public function rtwDetails()
    {
        return $this->hasOne('App\Rtw', 'id', 'rtwID');
    }

    public function inFavorites()
    {
        return $this->hasOne('App\Favorite', 'productID', 'id');
    }
}
