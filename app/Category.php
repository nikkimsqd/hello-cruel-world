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
}
