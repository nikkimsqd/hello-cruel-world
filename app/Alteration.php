<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alteration extends Model
{
    protected $fillable = ['dateStart', 'dateEnd', 'status'];

    //status: 1 = allocated, 0 = not allocated
    //status: Pending, used, unused
}
