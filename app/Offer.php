<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $guarded = [];


    public function item()
    {
        return $this->hasOne('App\Item');
    }

    public function bids()
    {
        return $this->hasMany('App\Bid');
    }


}
