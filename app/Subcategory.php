<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = ['categoryID', 'subcatName'];

 	public function getCategory()
 	{
        return $this->hasOne('App\Category', 'id', 'categoryID');
 	}
}
