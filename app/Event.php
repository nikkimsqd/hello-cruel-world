<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['event', 'tagID'];

    public function tag()
    {
        return $this->hasOne('App\Categorytag', 'id', 'tagID');
    }
}
