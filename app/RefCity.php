<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefCity extends Model
{
    protected $primaryKey = 'id';
	
	public $table = 'refcitymun';
	public $timestamps = false;
	public $incrementing = false;
}
