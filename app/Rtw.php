<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rtw extends Model
{
    protected $fillable = ['productID', 'xs', 's', 'm', 'l', 'xl', 'xxl'];
    
}
