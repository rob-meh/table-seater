<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiController;
use App\Models\Menu;
use Response;
use Auth;
use Input;
class MenuController extends ApiController
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request, $eventId)
    {
        $input = Input::except('token');
        
        $menu = Menu::firstOrNew(['event_id'=>$eventId]);
        if($menu->id)
        {
            return $this->respondExistingRelationship('Event already has a Menu!');
        }
        $validator = $menu->getValidator($input);

        if($validator->fails())
        {
            return $this->respondInvalidData($validator->errors());
        }

        $menu->fill($input);
        $menu->event_id = $eventId;
        $menu->save();

        return $this->respondCreateSuccess($menu->menu_name . ' created');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($eventId)
    {
        $menu = Menu::where('event_id','=',$eventId)->get()->first();
        if(!$menu)
        {
            return $this->respondNotFound('Menu Not Found!');
        }
        return $this->respond([
            $menu->toArray()
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
        $menu = Menu::where('event_id','=',$eventId)->get()->first();

        if(!$menu)
        {
            return $this->respondNotFound('Menu does not exist');
        }

        $validator = $menu->getValidator($input);

        if($validator->fails())
        {
            return $this->respondInvalidData($validator->errors());
        }

        $menu->fill($input);
        $menu->save();
        return $this->respondUpdateSuccess($menu->menu_name . ' updated');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $eventId)
    {
        $menu = Menu::where('event_id','=',$eventId)->get()->first();
        if(!$menu)
        {
            return $this->respondNotFound('Menu does not exist');
        }

        $menu_name = $menu->menu_name;

        $menu->delete();

        return $this->respondDeleteSuccess($menu_name . ' deleted');
    }
}
