<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\BaseModel;
use App\Models\GuestMenuItem;

class MenuItem extends BaseModel
{
	protected $fillable =['name'];
	protected $rules = [
		'name'=>'required'
	];
	protected $appends =[
		'menu_name',
		'number_of_times_ordered'
	];
    public function menu()
    {
        return $this->belongsTo('App\Models\Menu');
    }

    public function getMenuNameAttribute()
    {
    	return $this->menu->menu_name;
    }

    public function getNumberOfTimesOrderedAttribute(){
    	return GuestMenuItem::where('menu_item_id','=',$this->id)->count();
    }
}
