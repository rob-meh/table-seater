<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Table;
use App\Models\MenuItem;

class Guest extends Model
{
    public function dietaryRestriction()
    {
    	$this->hasMany('GuestDietaryRestriction','guest_id','id');
    }

    public function event()
    {
    	return $this->belongsTo('Event','id','event_id');
    }

    public function table()
    {
    	return $this->belongsTo('Table','id','table_id');
    }

    public function plusOne()
    {
    	return $this->hasOne('Guest','id','plus_one');
    }

    public function plusOneOf()
    {
        return Guest::where('plus_one','=',$this->id);
    }

    public function menuItem()
    {
        return $this->hasOne('MenuItem','id','menu_item_id');
    }
}
