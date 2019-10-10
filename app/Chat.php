<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = ['orderID', 'receiverID', 'senderID', 'senderType', 'message', 'status', 'convoID'];

    public function order()
    {
        return $this->hasOne('App\Order', 'id', 'orderID');
    }

    public function sender()
    {
        return $this->hasOne('App\User', 'id', 'senderID');
    }
}
