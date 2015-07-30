<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\BaseModel;

class MenuItem extends BaseModel
{
	protected $fillable =['name'];
	protected $rules = [
		'name'=>'required'
	];
	protected $appends =[
		'menu_name'
	];
    public function menu()
    {
        return $this->belongsTo('App\Models\Menu');
    }

    public function getMenuNameAttribute()
    {
    	return $this->menu->menu_name;
    }
}
