<?php

namespace App\Models;
use App\BaseModel;
use Illuminate\Database\Eloquent\Model;
use App\User;
use Auth;
class Event extends BaseModel
{
    //protected $hidden =['user_id'];
    protected $fillable = ['event_name','event_start_date','event_end_date'];
    protected $rules = [
        'event_name'=>'required',
        'event_start_date'=>'required|date_format:Y/m/d h:i A',
        'event_end_date'=>'required|date_format:Y/m/d h:i A',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function guests()
    {
    	return $this->hasMany('Guest');
    }

    public function save(array $options = [ ] )
    {
        $this->user_id = Auth::user()->id;
        return parent::save();
    }
}
