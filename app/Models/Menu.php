<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function event()
    {
        return $this->belongsTo('Event');
    }

    public function menuItems()
    {
        return $this->hasMany('MenuItem');
    }
}
