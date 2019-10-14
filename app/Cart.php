<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['id', 'userID', 'status'];

    public function owner()
    {
        return $this->hasOne('App\User', 'id', 'userID');
    }

    public function items()
    { 
        return $this->hasMany('App\Cartitem', 'cartID', 'id');
    }
}
