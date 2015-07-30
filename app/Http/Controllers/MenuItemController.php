<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiController;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\GuestMenuItem;
use Input;
use Response;
class MenuItemController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($eventId)
    {
        $menu_items = Menu::where('event_id','=',$eventId)->first()->menuItems;
        return $this->respond([
            $menu_items->toArray()
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
        
        $menu = Menu::where('event_id','=',$eventId)->first();
        $menuItem = new MenuItem();

        if(!$menu->id)
        {
            return $this->respondNotFound('Menu Not Found');
        }
        $validator = $menuItem->getValidator($input);

        if($validator->fails())
        {
            return $this->respondInvalidData($validator->errors());
        }

        $menuItem->fill($input);
        $menuItem->menu_id = $menu->id;
        $menuItem->save();

        return $this->respondCreateSuccess($menuItem->name . ' created');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request, $eventId, $menuItemId)
    {
        $menuItem = MenuItem::findOrFail($menuItemId)->first();
        if(!$menuItem->event_id === $eventId)
        {
            return $this->respondNotFound('Menu Item Not Found');
        }
        return $this->respond([
                $menuItem->toArray()
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $eventId, $menuItemId)
    {
        $menuItem = MenuItem::findOrFail($menuItemId)->first();
        $input = Input::except('token');

        $validator = $menuItem->getValidator($input);

        if($validator->fails())
        {
            return $this->respondInvalidData($validator->errors());
        }

        $menuItem->fill($input);
        $menuItem->save();
        return $this->respondUpdateSuccess($menuItem->name . ' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $eventId, $menuItemId)
    {
        $menuItem = MenuItem::where('id','=',$menuItemId)->first();
        if(!$menuItem)
        {
            return $this->respondNotFound('Menu Item Not Found');
        }
        $itemName = $menuItem->name;
        GuestMenuItem::where('menu_item_id','=',$menuItemId)->delete();
        $menuItem->delete();
        return $this->respondDeleteSuccess($itemName . ' deleted');
    }
}
