<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $primaryKey = 'id';
	
	public $table = 'cities';
	public $timestamps = false;
	public $incrementing = false;
	public $fillable = ['id', 'psgcCode', 'citymunDesc', 'regDesc', 'provCode', 'citymunCode'];
}
