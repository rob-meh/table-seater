<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Event extends Model
{
    public function user()
    {
    	$this->belongsTo('App\User','id','user_id');
    }

    public function guests()
    {
    	return $this->hasMany('Guest');
    }
}
