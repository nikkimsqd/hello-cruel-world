<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{
    protected $fillable = ['boutiqueName', 'boutiqueAddress', 'userID'];
}
