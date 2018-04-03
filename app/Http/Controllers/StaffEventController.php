<?php

namespace App\Http\Controllers;

use App\EventSchedule;
use App\Reservation;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Event;
use App\Room;

class StaffEventController extends Controller {

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
    public function index() {
        //get all from events table and paginate for list page
        $events = Event::paginate(15);
        return view('staff.event-list')->with('events', $events);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexShort() {
        //get 3 upcoming events from events table for homepage

        //get events after current date and sort by date in ascending order
        $events = Event::where('eventStatus', '=', '1')->whereDate('eventDate', '>', DB::raw('CURDATE()'))->orderBy('eventDate', 'asc')->get();

        //get nearest 3 events to current date
        $eventList = array($events[0], $events[1], $events[2]);
        return view('staff.homepage-hr')->with('eventList', $eventList);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexShortNurse() {
        //get 3 upcoming events from events table for homepage

        //get events after current date and sort by date in ascending order
        $events = Event::where('eventStatus', '=', '1')->whereDate('eventDate', '>', DB::raw('CURDATE()'))->orderBy('eventDate', 'asc')->get();

        //get nearest 3 events to current date
        $eventList = array($events[0], $events[1], $events[2]);
        return view('staff.homepage-nurse')->with('eventList', $eventList);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //get all rooms for registration page
        $rooms = Room::where('roomStatus', '=', 1)->get();
        return view('staff.registration')->with('rooms', $rooms);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //Set the current registration tab into session
        session(['eventTab' => 'true']);

        //generate event ID
        $eventID = 'E' . date('y') . sprintf('%04d', count(Event::all()) + 1);

        $validator = Validator::make($request->all(),
            [
                'eventName' => ['required', 'string', 'max:255', 'regex:/[A-Za-z0-9\-@ ]{2,}/'],
                'eventDate' => ['required', 'date'],
                'eventStartTime' => ['required', 'date_format:H:i'],
                'eventEndTime' => ['required', 'date_format:H:i'],
                'roomID' => ['required', 'string', 'regex:/^(\d{2})([1234]{1})(\d{3})$/']
            ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        else {
            //set event details
            $event = new Event();
            $event->eventID = $eventID;
            $event->eventName = $request->input('eventName');
            $event->eventDate = $request->input('eventDate');
            $event->eventStartTime = $request->input('eventStartTime');
            $event->eventEndTime = $request->input('eventEndTime');
            $event->roomID = $request->input('roomID');
            $event->eventStatus = 1;
            $eventSaveStats = $event->save();

            //Variable $evSchedSaveStats for verifying all 5 event schedule records are created successfully
            //Array $staffIDs for storing randomly generated staff IDs.
            $evSchedSaveStats = 0;
            $staffIDs = [];
            $staffs = Staff::where('staffPos', '=', 0)->get();                  //Retrieve all staff

            for($i = 0; $i < count($staffs); $i++) {
                $staffIDs[$i] = $staffs[rand(0, count($staffs) - 1)]->staffID;  //Randomly select a staff index and store into temp variable
            }

            $staffIDs = array_unique($staffIDs);                                //Filter out duplicated staff IDs in array

            //For loop to create 5 new event schedule records and
            //store each of the staff IDs using the keys
            //(Otherwise it is not in sequence after filtered. E.g. - 0,1,2,5,8)
            for($i = 0; $i < 5; $i++) {
                $eventSchedule = new EventSchedule();
                $eventSchedule->schedID = 'ES' . sprintf('%04d', count(EventSchedule::all()) + 1);
                $eventSchedule->staffID = $staffIDs[array_keys($staffIDs)[$i]];
                $eventSchedule->eventID = $event->eventID;
                $eventSchedule->save();
                $evSchedSaveStats++;
            }

            if ($eventSaveStats === true && $evSchedSaveStats === 5)
                return redirect('/staff/hr/registration')->with('success', 'Event created successfully!');
            else
                return redirect('/staff/hr/registration')->with('failure', 'Event was not created.');
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
        $rooms = Room::all();
        $eventScheds = EventSchedule::where('eventID', '=', $event->eventID)->get();

        $data = [
            'event' => $event,
            'rooms' => $rooms,
            'eventScheds' => $eventScheds
        ];
        return view('staff.event-details-hr')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //get event
        $event = Event::find($id);

        //validate data
        $validator = Validator::make($request->all(),
            [
                'eventName' => ['required', 'string', 'max:255'],
                'eventDate' => ['required', 'date'],
                'eventStartTime' => ['required', 'date_format:H:i'],
                'eventEndTime' => ['required', 'date_format:H:i'],
                'roomID' => ['required', 'string', 'regex:/^(\d{2})([1234]{1})(\d{3})$/']
            ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        else {
            //set new event details
            $event->eventName = $request->input('eventName');
            $event->eventDate = $request->input('eventDate');
            $event->eventStartTime = $request->input('eventStartTime');
            $event->eventEndTime = $request->input('eventEndTime');
            $event->roomID = $request->input('roomID');

            if ($event->save())
                return redirect('/staff/hr/list/event/' . $event->eventID)->with('success', 'Event updated successfully!');
            else
                return redirect('/staff/hr/list/event/' . $event->eventID)->with('failure', 'Event was not updated.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id) {
        //Find event based on ID
        $event = Event::find($id);

        //Set event status
        $event->eventStatus = 2;

        //Find related reservation id
        $reservation = Reservation::where('resvStatus', '=', '1')->where('eventID', '=', $event->eventID);

        //Set related reservation status
        $count = 0;     //Counter for validation
        foreach($reservation as $resv) {
            $resv->resvStatus = 4;
            $resv->save();
            $count++;
        }

        //redirect to registration page
        if($count !== 0) {
            if ($event->save() && $count === count($reservation))
                return redirect('/staff/hr/list/event/' .  $event->eventID)->with('cancelSuccess', 'Event has been successfully cancelled!');
        } elseif ($event->save()) {
                return redirect('/staff/hr/list/event/' .  $event->eventID)->with('cancelSuccess', 'Event has been successfully cancelled!');
        } else
                return redirect('/staff/hr/list/event/' .  $event->eventID)->with('cancelFailure', 'Event was not cancelled.');
    }

}
