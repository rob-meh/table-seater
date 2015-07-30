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
    	return $this->belongsTo('App\Models\Event');
    }

    public function table()
    {
    	return $this->belongsTo('App\Models\Table');
    }

    public function plusOne()
    {
    	return $this->hasOne('App\Models\Guest');
    }

    public function plusOneOf()
    {
        return Guest::where('plus_one','=',$this->id);
    }

    public function menuItem()
    {
        return $this->hasOne('App\Models\GuestMenuItem');
    }

    public function getName()
    {
        return $this->first_name .' '. $this->last_name;
    }

    public function getTableNameAttribute()
    {
        return Table::where('id','=',$this->table_id)->first()->table_name;
    }

    public function getMenuChoiceAttribute()
    {
        return GuestMenuItem::where('guest_id','=',$this->id)->first()->menuItem->name;
    }
}
