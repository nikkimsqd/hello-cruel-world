<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefProvince extends Model
{
    protected $primaryKey = 'id';
	
	public $table = 'refprovince';
	public $timestamps = false;
	public $incrementing = false;
}
