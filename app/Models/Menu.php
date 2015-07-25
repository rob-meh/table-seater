<?php

namespace App\Models;
use App\BaseModel;

use Illuminate\Database\Eloquent\Model;

class Menu extends BaseModel
{
	protected $fillable =['menu_name']; 

	protected $rules = [
	'menu_name'=>'required'
	];
    public function event()
    {
        return $this->belongsTo('App\Models\Event');
    }

    public function menuItems()
    {
        return $this->hasMany('App\Models\MenuItem');
    }
}
