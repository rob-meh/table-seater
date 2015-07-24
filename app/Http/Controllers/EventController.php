<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Event;
use Auth;
use Response;
use Input;
use DB;

class EventController extends Api\ApiController
{

    /**
     * Get all events 
     *
     * @param  int  $userId
     * @return Response
     */
    public function index()
    {
        $events = Event::where('user_id','=',Auth::user()->id)->get();

        return $this->respond([
            'data'=>$events->toArray()
        ]);
    }

    public function show($eventId)
    {
        $event = Event::where('user_id','=',Auth::user()->id)->find($eventId);

        if(!$event)
        {
            return $this->respondNotFound('Event does not exist');
        }
        return $this->respond([
            'data'=>$event->toArray()
        ]);
    }


    public function store(Request $request)
    {
        $input = Input::except('token');
        $event = new Event();

        $validator = $event->getValidator($input);

        if($validator->fails())
        {
            return $this->respondInvalidData($validator->errors());
        }

        $event->fill($input);
        $event->user_id = Auth::user()->id;
        $event->save();

        return $this->respondCreateSuccess($event->event_name . ' created');
    }

    public function update(Request $request, $eventId)
    {
        $input = Input::except('token');
        $event = Event::find($eventId);

        if(!$event)
        {
            return $this->respondNotFound('Event does not exist');
        }

        $validator = $event->getValidator($input);

        if($validator->fails())
        {
            return $this->respondInvalidData($validator->errors());
        }

        $event->fill($input);
        $event->save();
        return $this->respondUpdateSuccess($event->event_name . ' updated');
    }

    public function destroy(Request $request, $eventId)
    {

        $event = Event::find($eventId);

        if(!$event)
        {
            return $this->respondNotFound('Event does not exist');
        }

        $event_name = $event->event_name;

        $event->delete();

        return $this->respondDeleteSuccess($event_name . ' deleted');
    }


    public function getMenu($eventId)
    {
        $event = Event::find($eventId);
        $menu = $event->menu;
        if(!$menu)
        {
            return $this->respondNotFound('Menu Not Found!');
        }
        return $this->respond([
            'data'=>$menu->toArray()
        ]);

    }

    public function getGuestList($eventId)
    {
        $event = Event::find($eventId);
        $guestList = $event->guestList;
        if(!$guestList)
        {
            return $this->respondNotFound('Guest List Not Found!');
        }
        return $this->respond([
            'data'=>$guestList->toArray()
        ]);
    }


    public function getRoom($eventId)
    {
        $event = Event::find($eventId);
        $room = $event->room;
        if(!$room)
        {
            return $this->respondNotFound('Room Not Found!');
        }
        return $this->respond([
            'data'=>$room->toArray()
        ]);
    }



}
