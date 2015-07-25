<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestMenuItem extends Model
{
    public function guest()
    {
    	return $this->belongsTo('App\Models\Guest');
    }

    public function menuItem()
    {
    	return $this->hasOne('App\Models\MenuItem');
    }
}
