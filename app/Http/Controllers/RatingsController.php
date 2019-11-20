<?php

namespace App\Http\Controllers;

use App\Http\Resources\Rating as RatingResource;
use App\Http\Resources\Restaurant as RestaurantResource;
use App\Rating;
use App\Restaurant;
use Illuminate\Http\Request;


class RatingsController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Rating  $ratings
     * @return \Illuminate\Http\Response
     */
    public function show(Rating $ratings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rating  $ratings
     * @return \Illuminate\Http\Response
     */
    public function edit(Rating $ratings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rating  $ratings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rating $ratings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rating  $ratings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rating $ratings)
    {
        //
    }
}
