<?php

namespace App\Http\Controllers\DonorControllers;

use App\Models\Event;
use App\Models\EventSchedule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
        //get events after current date and sort by date in ascending order and paginate into set of 10
        $events = Event::where('eventStatus', '=', '1')->whereDate('eventDate', '>', DB::raw('CURDATE()'))->orderBy('eventDate', 'asc')->paginate(10);

        //return result to donor upcoming event list page
        return view('donor.upcoming-event-list')->with('eventList', $events);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexShort() {
        //get events after current date and sort by date in ascending order
        $events = Event::where('eventStatus', '=', '1')->whereDate('eventDate', '>', DB::raw('CURDATE()'))->orderBy('eventDate', 'asc')->take(3)->get();

        //return 3 results to donor homepage
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
        //get a specific event
        $event = Event::find($id);
        //get event schedules for the event
        $eventScheds = EventSchedule::where('eventID', '=', $id)->get();

        //validate data
        $data = [
            'event' => $event,
            'nurses' => $eventScheds
        ];

        //return result to donor event details page
        return view('donor.event-details-donor')->with('data', $data);
    }
}
