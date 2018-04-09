<?php

namespace App\Http\Controllers;

use App\Event;
use App\Reservation;
use Illuminate\Http\Request;

class ConcludeEventController extends Controller {
    /**
     * Create new controller instance
     *
     * @return void
     */
    public function __construct() {
        //authenticate user
        $this->middleware('auth:staff');
    }

//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function index()
//    {
//        //
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        //
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        //
//    }
//
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //set current event status to completed
        //and donor reservation status to 'did not attend' for donors that did not attend

        //set event status
        $event = Event::find($request->eventID);
        $event->eventStatus = 0;

        //set donor reservation status
        $reservations = Reservation::where('eventID', '=', $request->eventID)->where('resvStatus', '=', 1)->get();

        $resvSaveStats = 0;
        foreach ($reservations as $reservation) {
            $reservation->resvStatus = 2;

            if ($reservation->save())
                $resvSaveStats++;
        }

        if ($event->save() && $resvSaveStats === count($reservations))
            return redirect('/staff/nurse/homepage')->with('success', 'Event has been successfully concluded!');
        else
            return redirect('/staff/nurse/manage-blood')->with('failure', 'Event was not concluded, please try again.');
    }

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
