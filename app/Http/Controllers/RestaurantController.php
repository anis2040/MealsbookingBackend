<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Resources\Restaurant as RestaurantResource;
use Illuminate\Http\Resources\Json\Resource;
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
        $restaurant = Restaurant::paginate(5);

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
        $restaurant = Restaurant::findOrFail($id)::with('restaurant');
        // Return a single restaurant as a resource
        return new RestaurantResource($restaurant);
    }

    public function sortBycategory($category) {
        $restaurant = DB::table('restaurants')->where('category',$category)->get();
      //  dd($restaurant);
        return RestaurantResource::collection($restaurant);
    }

    public function topTen() {
        $resto = Restaurant::all();
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
