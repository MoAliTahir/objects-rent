<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function offer()
    {
        return $this->belongsTo('App\Offer');
    }


    public function isOwnedBy($userId){
        return $this->user->id == $userId;
    }
}
