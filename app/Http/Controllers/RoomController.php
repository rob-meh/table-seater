<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiController;
use App\Models\Room;
use Response;
use Auth;
use Input;

class RoomController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request, $eventId)
    {
        //
        $input = Input::except('token');
        $room = Room::firstOrNew(['event_id'=>$eventId]);
        if($room->id)
        {
            return $this->respondExistingRelationship('Event already has a Room!');
        }
        $validator = $room->getValidator($input);

        if($validator->fails())
        {
            return $this->respondInvalidData($validator->errors());
        }

        $room->fill($input);
        $room->event_id = $eventId;
        $room->save();

        return $this->respondCreateSuccess('Room created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($eventId)
    {
        $room = Room::where('event_id','=',$eventId)->first();
        if(!$room)
        {
            return $this->respondNotFound('Room Not Found!');
        }
        return $this->respond([
            $room->toArray()
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $eventId)
    {
        $input = Input::except('token');
        $room = Room::where('event_id','=',$eventId)->first();

        if(!$room)
        {
            return $this->respondNotFound('Room does not exist');
        }

        $validator = $room->getValidator($input);

        if($validator->fails())
        {
            return $this->respondInvalidData($validator->errors());
        }

        $room->fill($input);
        $room->save();
        return $this->respondUpdateSuccess('Room updated');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $eventId)
    {
        $room = Room::where('event_id','=',$eventId)->first();
        if(!$room)
        {
            return $this->respondNotFound('Room does not exist');
        }

        $room->delete();

        return $this->respondDeleteSuccess('Room deleted');
        
    }
}
