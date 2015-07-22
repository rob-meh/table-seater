<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestDietaryRestriction extends Model
{
    public function guest()
    {
    	return $this->belongsTo('Guest','id','guest_id');
    }

    public function restriction()
    {
    	return $this->hasOne('DietaryRestriction','id','dietary_restriction_id');
    }
}
