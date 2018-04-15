<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventSchedule;
use Illuminate\Support\Facades\DB;

class EventController extends Controller {
    /**
     * Create new controller instance
     *
     * @return void
     */
    public function __construct() {
        //authenticate user
        $this->middleware('auth:donor');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //get all upcoming events from events table for upcoming event list page
        //get events after current date and sort by date in ascending order
        $events = Event::where('eventStatus', '=', '1')->whereDate('eventDate', '>', DB::raw('CURDATE()'))->orderBy('eventDate', 'asc')->paginate(10);

        //get nearest 3 events to current date
        return view('donor.upcoming-event-list')->with('eventList', $events);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexShort() {
        //get 3 upcoming events from events table for homepage
        //get events after current date and sort by date in ascending order
        $events = Event::where('eventStatus', '=', '1')->whereDate('eventDate', '>', DB::raw('CURDATE()'))->orderBy('eventDate', 'asc')->take(3)->get();

        if(count($events) > 0) {
            //get nearest 3 events to current date
            return view('donor.homepage')->with('eventList', $events);
        } else {
            return view('donor.homepage');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //get one event for detail page
        $event = Event::find($id);
        $eventScheds = EventSchedule::where('eventID', '=', $id)->get();

        $data = [
            'event' => $event,
            'nurses' => $eventScheds
        ];

        return view('donor.event-details-donor')->with('data', $data);
    }
}
