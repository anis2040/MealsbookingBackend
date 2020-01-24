<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Resources\Restaurant as RestaurantResource;
use Illuminate\Support\Facades\DB;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurant = Restaurant::all();
        return RestaurantResource::collection($restaurant);
       // return view('restaurants.index',['restaurants' => $restaurant]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $restaurant = $request->isMethod('put') ? Restaurant::findOrFail
        ($request->restaurant_id): new Restaurant();
        $restaurant->id = $request->input('restaurant_id');
        $restaurant->name = $request->input('name');
        $restaurant->description = $request->input('description');
        $restaurant->photo = $request->input('photo');
        $restaurant->address = $request->input('address');
        $restaurant->priceMin = $request->input('priceMin');
        $restaurant->priceMax = $request->input('priceMax');

        if ($restaurant->save()) {
            return new RestaurantResource($restaurant);
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
        $restaurant = Restaurant::findOrFail($id);
        RestaurantResource::withoutWrapping();
        // Return a single restaurant as a resource
        return new RestaurantResource($restaurant);
    }

    public function sortBycategory($category) {
        $restaurant = Restaurant::where('category',$category)->get();

        return RestaurantResource::collection($restaurant);
    }

    public function topTenRestaurants() {
        $resto = Restaurant::join('ratings','restaurants.id','=','ratings.restaurant_id')->orderBy('ratings.rating','desc')
            ->select('restaurants.*')->distinct()->get();
        return  RestaurantResource::collection($resto);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        // Return a single restaurant as a resource
        if($restaurant->delete()) {
            return new RestaurantResource($restaurant);
        }

    }
}
