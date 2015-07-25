<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\BaseModel;
class Room extends BaseModel
{
	protected $fillable =['length','width'];
	protected $rules =[
		'length'=>'required|numeric',
		'width'=>'required|numeric',
	];

    public function event()
    {
    	return $this->belongsTo('App\Models\Event');
    }

    public function tables()
    {
    	return $this->hasMany('App\Models\Table');
    }
}
