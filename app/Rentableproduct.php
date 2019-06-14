<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rentableproduct extends Model
{
    protected $fillable = ['price', 'depositAmount', 'penaltyAmount', 'limitOfDays', 'fine', 'locationsAvailable'];

    public function locations()
    {
        return $this->hasOne('App\Barangay', 'brgyCode', 'locationsAvailable');
    }
}
