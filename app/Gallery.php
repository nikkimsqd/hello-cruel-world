<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['userID'];

    public function productFile()
    {
        return $this->hasOne('App\File', 'galleryID', 'id');
    }
}
