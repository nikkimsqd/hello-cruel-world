<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    protected $fillable = ['type', 'typeID', 'data', 'userID'];
}
