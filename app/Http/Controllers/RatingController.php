<?php

namespace App\Http\Controllers;

use App\Http\Resources\Rating as RatingResource;
use App\Http\Resources\Restaurant as RestaurantResource;
use App\Rating;
use App\Restaurant;
use Illuminate\Http\Request;


class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservation = Rating::all();

        return RatingResource::collection($reservation);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reservation = $request->isMethod('put') ? Rating::findOrFail
        ($request->rating_id): new Rating();
        $reservation->id = $request->input('rating_id');
        $reservation->review = $request->input('review');
        $reservation->rating = $request->input('rating');
        $reservation->restaurant_id = $request->input('restaurant_id');
        $reservation->user_id = $request->input('user_id');

        if ($reservation->save()) {
            return new RatingResource($reservation);
        }
    }

    public function ratingByResto($id) {
        $restaurant = Rating::where('restaurant_id',$id)->get();

        return RatingResource::collection($restaurant);
    }
}
