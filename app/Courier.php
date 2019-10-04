<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    protected $fillable = ['userID', 'status'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'userID');
    }
}
