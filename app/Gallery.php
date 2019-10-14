<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['id', 'userID'];

    public function productFile()
    {
        return $this->hasOne('App\File', 'galleryID', 'id');
    }
}
