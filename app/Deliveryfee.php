<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deliveryfee extends Model
{
	// public $table = 'deliveryfee';
	
    protected $fillable = ['baseFee', 'additionalFee'];
}
