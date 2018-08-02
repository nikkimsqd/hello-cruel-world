<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
<<<<<<< HEAD
    protected $fillable = [
        'userID', 'batchID', 'filename'
=======
	protected $primaryKey = 'fileID';
    protected $fillable = [
        'userID', 'filename'
>>>>>>> master
    ];
}
