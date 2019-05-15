<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefBrgy extends Model
{
    protected $primaryKey = 'id';
	
	public $table = 'refbrgy';
	public $timestamps = false;
	public $incrementing = false;
}
