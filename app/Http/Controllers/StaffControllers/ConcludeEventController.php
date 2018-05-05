<?php

namespace App\Http\Controllers\StaffControllers;

use App\Models\Event;
use App\Models\EventSchedule;
use App\Models\Reservation;
use App\Http\Controllers\Controller;

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
        //Set current event status to completed
        //and donor reservation status to 'did not attend' for donors that did not attend

        //Set event status
        $event = Event::find($id);
        $event->eventStatus = 0;

        //Set donor reservation status
        $reservations = Reservation::where('eventID', '=', $event->eventID)->where('resvStatus', '=', 1)->get();

        $resvSaveStats = 0;
        foreach ($reservations as $reservation) {
            $reservation->resvStatus = 2;

            if ($reservation->save() === true)
                $resvSaveStats++;
        }

        //Set event schedules status
        $schedules = EventSchedule::where('schedStatus', '=', 1)->where('eventID', '=', $id)->get();
        $schedSaveStats = 0;
        foreach ($schedules as $schedule) {
            $schedule->schedStatus = 0;

            if ($schedule->save() === true)
                $schedSaveStats++;
        }

        if ($event->save() && $resvSaveStats === count($reservations) && $schedSaveStats === count($schedules))
            return redirect('/staff/nurse/home')->with('success', 'Event has been successfully concluded!');
        else
            return redirect()->back()->with('failure', 'Event was not concluded, please try again.');
    }
}
