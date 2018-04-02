<?php

namespace App\Http\Controllers;

use App\Blood;
use App\Donor;
use App\Event;
use App\Reservation;
use Illuminate\Http\Request;

class BloodController extends Controller
{
    /**
     * Create new controller instance
     *
     * @return void
     */
    public function __construct() {
        //authenticate user
        $this->middleware('auth:staff');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all blood amount for each blood type and return to dashboard page

        $bloods = Blood::all();

        //save total of each blood type to array
        $totalBlood = array();
        for ($i = 1; $i <= 8; $i++)
            $totalBlood[$i - 1] += $bloods[$i]->bloodAmount;

        return view('staff.dashboard')->with('totalBlood', $totalBlood);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //get all donor id for blood management page

        $event = Event::find($id);
        $reservations = Reservation::where('eventID', '=', $event->eventID);

        $donorIDs = array();
        for ($i = 0; $i < count($reservations); $i++)
            $donorIDs[$i] = $reservations[$i]->donors->donorID;

        return view('staff.blood-management')->with('donorIDs', $donorIDs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    //Update and deactivate for blood management?

//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function show($id)
//    {
//        //
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function edit($id)
//    {
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, $id)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy($id)
//    {
//        //
//    }
}
