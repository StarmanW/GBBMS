<?php

namespace App\Http\Controllers\StaffControllers;

use App\Models\Room;
use App\Models\Event;
use App\Models\Staff;
use App\Models\Reservation;
use App\Models\EventSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

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
        //get all from events table and paginate into set of 10
        $events = Event::paginate(10);

        //return result to staff event list page
        return view('staff.hrm.event-list')->with('events', $events);
    }

    /**
     * Display a listing of 3 resources or less.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexShort() {
        //get 3 upcoming events from events table for homepage
        //get events after current date and sort by date in ascending order
        $events = Event::where('eventStatus', '=', '1')->whereDate('eventDate', '>', DB::raw('CURDATE()'))->orderBy('eventDate', 'asc')->take(3)->get();

        //return result as
        if(count($events) > 0) {
            //if current user is HR manager, return to HR homepage with result, else to nurse homepage
            //return result as array
            if (Auth::user()->staffPos === 1) {
                return view('staff.hrm.homepage-hr')->with('eventList', $events);
            } elseif (Auth::user()->staffPos === 0) {
                return view('staff.nurse.homepage-nurse')->with('eventList', $events);
            }
        } else {
            //if current user is HR manager, return to HR homepage with result, else to nurse homepage
            //return result as single object
            if (Auth::user()->staffPos === 1) {
                return view('staff.hrm.homepage-hr');
            } elseif (Auth::user()->staffPos === 0) {
                return view('staff.nurse.homepage-nurse');
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //get all rooms
        $rooms = Room::where('roomStatus', '=', 1)->get();

        //return result to HR registration page
        return view('staff.hrm.registration')->with('rooms', $rooms);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //get event details and save to DB
        //Set the current registration tab into session
        session(['eventTab' => 'true']);

        //generate event ID
        $eventID = 'E' . date('y') . sprintf('%04d', count(Event::all()) + 1);

        //data validation
        $validator = Validator::make($request->all(),
            [
                'eventName' => ['required', 'string', 'max:255', 'regex:/[A-Za-z0-9\-@\! ]{2,}/'],
                'eventDate' => ['required', 'date', 'after:1 week'],
                'eventStartTime' => ['required', 'date_format:H:i'],
                'eventEndTime' => ['required', 'date_format:H:i'],
                'roomID' => ['required', 'string', 'regex:/^(\d{2})([1234]{1})(\d{3})$/']
            ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        else {
            if (Event::where('eventDate', '=', $request['eventDate'])->where('roomID', '=', $request['roomID'])->count() !== 0) {
                return redirect()->back()->with('occupiedRoom', 'An upcoming event has already occupied this room on the selected day.');
            } else {
                //Set event details
                $event = new Event();
                $event->eventID = $eventID;
                $event->eventName = htmlentities($request->input('eventName'), ENT_QUOTES, 'UTF-8');
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

                for ($i = 0; $i < count($staffs); $i++) {
                    $staffIDs[$i] = $staffs[rand(0, count($staffs) - 1)]->staffID;  //Randomly select a staff index and store into temp variable
                }

                $staffIDs = array_unique($staffIDs);                                //Filter out duplicated staff IDs in array

                //For loop to create 5 new event schedule records and
                //store each of the staff IDs using the keys
                //(Otherwise it is not in sequence after filtered. E.g. - 0,1,2,5,8)
                for ($i = 0; $i < 5; $i++) {
                    $eventSchedule = new EventSchedule();
                    $eventSchedule->schedID = 'ES' . sprintf('%04d', count(EventSchedule::all()) + 1);
                    $eventSchedule->staffID = $staffIDs[array_keys($staffIDs)[$i]];
                    $eventSchedule->eventID = $event->eventID;
                    $eventSchedule->schedStatus = 1;
                    $eventSchedule->save();
                    $evSchedSaveStats++;
                }

                //return to HR registration page with message
                if ($eventSaveStats === true && $evSchedSaveStats === 5)
                    return redirect('/staff/hr/registration')->with('success', 'Event created successfully!');
                else
                    return redirect('/staff/hr/registration')->with('failure', 'Event was not created.');
            }
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
        //get all rooms
        $rooms = Room::all();
        //get reservations related to the event
        $eventScheds = EventSchedule::where('eventID', '=', $event->eventID)->get();

        //validate data
        $data = [
            'event' => $event,
            'rooms' => $rooms,
            'eventScheds' => $eventScheds
        ];

        //return result to HR event detail page
        return view('staff.hrm.event-details-hr')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //get a specific event
        $event = Event::find($id);

        //validate data
        $validator = Validator::make($request->all(),
            [
                'eventName' => ['required', 'string', 'max:255', 'regex:/[A-Za-z0-9\-@\! ]{2,}/'],
                'eventDate' => ['required', 'date'],
                'eventStartTime' => ['required', 'date_format:H:i'],
                'eventEndTime' => ['required', 'date_format:H:i'],
                'roomID' => ['required', 'string', 'regex:/^(\d{2})([1234]{1})(\d{3})$/']
            ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        else {
            //set new event details
            $event->eventName = htmlentities($request->input('eventName'), ENT_QUOTES, 'UTF-8');
            $event->eventDate = $request->input('eventDate');
            $event->eventStartTime = $request->input('eventStartTime');
            $event->eventEndTime = $request->input('eventEndTime');
            $event->roomID = $request->input('roomID');

            //return to HR event list page with message
            if ($event->save())
                return redirect('/staff/hr/list/event/' . $event->eventID)->with('success', 'Event updated successfully!');
            else
                return redirect('/staff/hr/list/event/' . $event->eventID)->with('failure', 'Event was not updated.');
        }
    }

    /**
     * Update event status for deactivation.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id) {
        //Get a specific event
        $event = Event::find($id);

        //Set event status to "cancelled"
        $event->eventStatus = 2;

        //Get reservations related to the event
        $reservation = Reservation::where('resvStatus', '=', '1')->where('eventID', '=', $event->eventID)->get();

        //Set reservation status of reservations related to the event to "deactivated"
        //Counter for validation
        $resvCount = 0;
        foreach ($reservation as $resv) {
            $resv->resvStatus = 4;
            $resv->save();
            $resvCount++;
        }

        //Get schedules related to the event
        $eventScheds = EventSchedule::where('schedStatus', '=', '1')->where('eventID', '=', $event->eventID)->get();

        //Set schedules status of schdules related to the event to "deactivated"
        //Counter for validation
        $schedCount = 0;
        foreach ($eventScheds as $sched) {
            $sched->schedStatus = 0;
            $sched->save();
            $schedCount++;
        }

        //Return to current page with message
        if ($resvCount !== 0 && $schedCount !== 0) {
            if ($event->save() && $resvCount === count($reservation) && $schedCount === count($eventScheds))
                return redirect()->back()->with('cancelSuccess', 'Event has been successfully cancelled!');
        } elseif ($event->save()) {
            return redirect()->back()->with('cancelSuccess', 'Event has been successfully cancelled!');
        } else
            return redirect()->back()->with('cancelFailure', 'Event was not cancelled.');
    }
}
