<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
use App\Http\Resources\Menu as MenuResource;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Menu::paginate(10);

        return MenuResource::collection($menu);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menu = $request->isMethod('put') ? Menu::findOrFail
        ($request->restaurant_id): new Menu();
        $menu->id = $request->input('menu_id');
        $menu->food_name = $request->input('food_name');
        $menu->price = $request->input('price');

        if($request->hasfile('photo'))
        {
            foreach($request->file('photo') as $image)
            {
                $name=$image->getClientOriginalName();
                $image->move(public_path().'/images/', $name);
                $data[] = $name;
            }
        }
        $menu->photo=json_encode($data);
        $menu->restaurant_id = $request->input('restaurant_id');

        if ($menu->save()) {
            return new MenuResource($menu);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        // Return a single restaurant as a resource
        return new MenuResource($menu);
    }
}
