<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Declinedtransaction extends Model
{
    protected $fillable = ['type', 'typeID', 'reason'];
}
