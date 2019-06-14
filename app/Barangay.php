<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $primaryKey = 'id';
	
	public $table = 'barangays';
	public $timestamps = false;
	public $incrementing = false;
	public $fillable = ['id', 'brgyCode', 'brgyDesc', 'regCode', 'provCode', 'citymunCode'];

	public function city()
    {
        return $this->hasOne('App\City', 'citymunCode', 'citymunCode');
    }
}
