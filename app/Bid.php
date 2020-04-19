<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $guarded = [];

    public function offer()
    {
        return $this->belongsTo('App\Offer');
    }

    public function client()
    {
        return $this->belongsTo('App\User');
    }
}
