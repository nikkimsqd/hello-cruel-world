<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = ['senderID', 'recipientID', 'subject', 'message', 'location', 'status'];

    public function sender()
    {
        return $this->hasOne('App\User', 'id', 'senderID');
    }

    public function recipient()
    {
        return $this->hasOne('App\User', 'id', 'recipientID');
    }
}
