<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profiling extends Model
{
	protected $primaryKey = 'id';
    
    protected $fillable = ['userID', 'data'];

}
