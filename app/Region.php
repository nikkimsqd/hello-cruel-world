<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $primaryKey = 'id';
	
	public $table = 'regions';
	public $timestamps = false;
	public $incrementing = false;
	public $fillable = ['id', 'psgcCode', 'regDesc', 'regCode'];
}
