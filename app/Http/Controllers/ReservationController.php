<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Http\Request;
use App\Http\Resources\Reservation as ReservationResource;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservation = Reservation::all();

        return ReservationResource::collection($reservation);
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
        $reservation = $request->isMethod('put') ? Reservation::findOrFail
        ($request->restaurant_id): new Reservation();
        $reservation->id = $request->input('reservation_id');
        $reservation->name = $request->input('name');
        $reservation->nbperson = $request->input('nbperson');
        $reservation->time = $request->input('time');
        $reservation->approved = $request->input('approved');
        $reservation->restaurant_id = $request->input('restaurant_id');
        $reservation->user_id = $request->input('user_id');

        if ($reservation->save()) {
            return new ReservationResource($reservation);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        // Return a single restaurant as a resource
        if($reservation->delete()) {
            return new ReservationResource($reservation);
        }
    }


}
