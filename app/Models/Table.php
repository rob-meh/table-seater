<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Guest;
use App\BaseModel;

class Table extends BaseModel
{

	protected $fillable=['number_of_seats','table_name','length','width'];
	protected $rules=[
		'number_of_seats'=>'required',
		'length'=>'numeric',
		'width'=>'numeric',
	];
	public function room()
	{
		return $this->belongsTo('Room');
	}

	public function tables()
	{
		return $this->hasOne('TableType');
	}

	public function seatGuest(Guest $guest)
	{
		$tableGuests = Guest::where('table_id','=',$this->id)->get();

		if($tableGuests->count() < $this->number_of_seats)
		{
			if(!$tableGuests->contains($guest))
			{
				$guest->table_id =  $this->id;
				$guest->save();
				return true;
			}
		}
		return false;
	}

	public function guestsAtTable()
	{
		return  Guest::where('table_id','=', $this->id)->get();
	}
}
