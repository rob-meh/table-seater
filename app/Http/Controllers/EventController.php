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
        $event->user_id = Auth::user()->id;
        $event->fill($input);
        $event->save();
        //TODO Why wont the users show up?
        DB::enableQueryLog();
        var_dump(Event::find(1)->user());
        echo '<br>';
        echo '<br>';
        var_dump(DB::getQueryLog());
        die();
    }



}
