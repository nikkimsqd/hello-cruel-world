<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $primaryKey = 'productID';
    protected $fillable = [

        'userID', 'fileID', 'productName', 'productDesc', 'productPrice', 'category', 'productStatus'
        
    ];

     public function productFile()
    {
        return $this->hasMany('App\File', 'productID', 'productID');
    }

    public function owner()
    {
        return $this->hasOne('App\User', 'id', 'userID');
    }
}
