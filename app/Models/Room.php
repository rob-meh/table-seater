<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function event()
    {
    	return $this->belongsTo('Event');
    }

    public function tables()
    {
    	return $this->hasMany('Table');
    }
}
