<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['boutiqueID', 'categoryName', 'gender'];
    
    public function getMeasurements()
    {
        return $this->hasMany('App\Categorymeasurement', 'categoryID', 'id');
    }

 	public function category()
 	{
        return $this->hasMany('App\Subcategory', 'categoryID', 'id');
 	}

 	//erase nani
    public function categoryTag()
    {
        return $this->hasMany('App\Categorytag', 'categoryID', 'id');
    }

    public function getSubCategory()
    {
        return $this->hasMany('App\Subcategory', 'categoryID', 'id');
    }
}
