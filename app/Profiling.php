<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profiling extends Model
{
	protected $primaryKey = 'id';
    
    protected $fillable = ['userID', 'data'];

 	public function getCategory()
 	{
        return $this->hasOne('App\Category', 'id', 'data');
 	}

    public function getSubCategory()
    {
        return $this->hasMany('App\Subcategory', 'id', 'data');
    }

}
