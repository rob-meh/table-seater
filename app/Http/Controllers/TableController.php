<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiController;
use App\Models\Event;
use App\Models\Table;
use App\Models\Room;
use App\Models\Guest;
use Input;
use Response;
class TableController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($roomId)
    {
        $tables = Room::where('id','=',$roomId)->first()->tables;
        return $this->respond([
            'data'=>$tables->toArray()
            ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request, $eventId)
    {
        $input = Input::except('token');
        $roomId = Event::find($eventId)->room->id;
        $tableType = 
        $table = new Table();
        $validator = $table->getValidator($input);

        if($validator->fails())
        {
            return $this->respondInvalidData($validator->errors());
        }

        $table->fill($input);
        $table->room_id = $roomId;
        $table->save();
        return $this->respondCreateSuccess('Table: ' . $table->table_name . ' created');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request, $eventId, $tableId)
    {
        $table = Table::find($tableId);
        if(!$table->event_id === $eventId)
        {
            return $this->respondNotFound('Table Not Found');
        }
        return $this->respond([
            'data'=>$table->toArray()
            ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $eventId, $tableId)
    {
        $table = Table::findOrFail($tableId);
        $input = Input::except('token');

        $validator = $table->getValidator($input);

        if($validator->fails())
        {
            return $this->respondInvalidData($validator->errors());
        }

        $table->fill($input);
        $table->save();
        return $this->respondUpdateSuccess('Table: '.$table->table_name . ' updated');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $eventId, $tableId)
    {
        $table = Table::find($tableId);
        foreach ($table->guestsAtTable() as $guest) {
            $guest->table_id = null;
            $guest->save();
        }
        $tableName = $table->table_name;
        $table->delete();
        return $this->respondDeleteSuccess($tableName . ' deleted');

    }

    public function tableGuests(Request $request, $eventId, $tableId)
    {
        $guests = Table::find($tableId)->guestsAtTable();
        return $this->respond([
            'data'=>$guests->toArray()
            ]);
    }

    public function seatGuest(Request $request, $eventId, $tableId)
    {
        $guest = Guest::find(Input::get('guest_id'));

        if($guest->table_id)
        {
            return $this->respondExistingRelationship('Guest is already seated at ' . $guest->table->table_name);
        } 

        $table = Table::find($tableId);

        if($table->seatGuest($guest))
        {
           return $this->prepareResponse('success', $guest->getName() . ' now seated at '.$table->table_name);
        }
        else
        {
           return $this->prepareResponse('error', $table->table_name.' is full');
        }

    }

    public function removeGuest(Request $request, $eventId, $tableId)
    {
        $guest = Guest::find(Input::get('guest_id'));
        if($guest->table_id !== $tableId )
        {
            return $this->prepareResponse('error', $guest->getName() . ' not seated at this table');
        }

        $guest->table_id = null;
        $guest->save();
        return $this->prepareResponse('success', $guest->getName() . ' removed from the table');
    }
}
