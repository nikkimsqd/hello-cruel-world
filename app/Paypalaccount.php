<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paypalaccount extends Model
{
    protected $fillable = ['boutiqueID', 'paypalEmail'];

    public function boutique()
    {
        return $this->hasOne('App\Boutique', 'id', 'boutiqueID');
    }
}
