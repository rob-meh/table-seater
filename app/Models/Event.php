<?php

namespace App\Models;
use App\BaseModel;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Menu;
use App\Models\Room;
use App\Models\Guest;
class Event extends BaseModel
{
    //protected $hidden =['user_id'];
    protected $fillable = ['event_name','event_start_date','event_end_date'];
    protected $rules = [
        'event_name'=>'required',
        'event_start_date'=>'required|date_format:Y/m/d h:i A',
        'event_end_date'=>'required|date_format:Y/m/d h:i A',
        'number_of_guests'=>'required|numeric'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function guestList()
    {
    	return $this->hasMany('App\Models\Guest');
    }

    public function menu()
    {
        return $this->hasOne('App\Models\Menu');
    }

    public function room()
    {
        return $this->hasOne('App\Models\Room');
    }

}
