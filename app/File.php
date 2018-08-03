<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	protected $primaryKey = 'fileID';
	
    protected $fillable = [
        'userID', 'filename'
    ];
}