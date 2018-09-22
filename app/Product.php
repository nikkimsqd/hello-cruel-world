<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $primaryKey = 'productID';
    protected $fillable = [
<<<<<<< HEAD
        'productID', 'fileID', 'productName', 'productDesc', 'productPrice'
=======
        'userID', 'fileID', 'productName', 'productDesc', 'productPrice', 'category', 'productStatus'
>>>>>>> master
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
