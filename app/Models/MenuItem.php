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

    public function menu()
    {
        return $this->belongsTo('App\Models\Menu');
    }
}
