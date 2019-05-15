<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $primaryKey = 'id';
	
	public $table = 'provinces';
	public $timestamps = false;
	public $incrementing = false;
	public $fillable = ['id', 'psgcCode', 'provDesc', 'regCode', 'provCode'];
}
