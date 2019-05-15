<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefRegion extends Model
{
    protected $primaryKey = 'id';
	
	public $table = 'refregion';
	public $timestamps = false;
	public $incrementing = false;
}
