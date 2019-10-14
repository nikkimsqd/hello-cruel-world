<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rentableproduct extends Model
{
    protected $fillable = ['price', 'cashban', 'penaltyAmount', 'limitOfDays', 'fine'];
}
