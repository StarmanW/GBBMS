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

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id) {
        //set current event status to completed
        //and donor reservation status to 'did not attend' for donors that did not attend

        //set event status
        $event = Event::find($id);
        $event->eventStatus = 0;

        //set donor reservation status
        $reservations = Reservation::where('eventID', '=', $event->eventID)->where('resvStatus', '=', 1)->get();

        $resvSaveStats = 0;
        foreach ($reservations as $reservation) {
            $reservation->resvStatus = 2;

            if ($reservation->save())
                $resvSaveStats++;
        }

        //set staff schedule status
        $schedule = find($id);
        $schedule->schedStatus = 0;

        if ($event->save() && $resvSaveStats === count($reservations))
            return redirect('/staff/nurse/homepage')->with('success', 'Event has been successfully concluded!');
        else
            return redirect()->back()->with('failure', 'Event was not concluded, please try again.');
    }
}
