<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Event;
use App\Http\Requests\EventRequest;
use Response;

class EventController extends ApiController
{

    /**
     * Get all events 
     *
     * @param  int  $userId
     * @return Response
     */
    public function allEvents()
    {
        $events = Event::all();
        return $this->respond([
            'data'=>$events->toArray()
        ]);
    }

    public function getEvent($eventId)
    {
        $event = Event::find($eventId);

        if(!$event)
        {
            return $this->respondNotFound('Event does not exist');
        }
        return $this->respond([
            'data'=>$event->toArray()
        ]);
    }

    public function store()
    {
        dd('store');
    }


}
