<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoryrequest extends Model
{
    protected $fillable = ['boutiqueID', 'categoryName', 'gender', 'status'];

    public function boutique()
    {
        return $this->hasOne('App\Boutique', 'id', 'boutiqueID');
    }
}
