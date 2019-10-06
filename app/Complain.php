<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    protected $fillable = ['userID', 'orderID', 'complain', 'status'];

    public function complainFiles()
    {
        return $this->hasMany('App\File', 'complainID', 'id');
    }

    public function order()
    {
        return $this->hasOne('App\Order', 'id', 'orderID');
    }
}
