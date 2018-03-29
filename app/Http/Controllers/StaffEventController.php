<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $events = DB::table('events')->paginate(15);
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
        $events = DB::table('events')->where('eventStatus', '=', 'true')->whereDate('eventDate', '>', DB::raw('CURDATE()'))->orderBy('eventDate', 'asc')->get();

        //get nearest 3 events to current date
        $eventList = array($events[0], $events[1], $events[2]);
        return view('staff.home-hr')->with('eventList', $eventList);
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
        //generate event ID
        $eventID = 'E' . date('y') . sprintf('%04d', count(Event::all()) + 1);

        $validator = Validator::make($request->all(),
            [
                'eventName' => ['required', 'string', 'max:255'],
                'eventDate' => ['required', 'date'],
                'eventStartTime' => ['required', 'date_format:H:i'],
                'eventEndTime' => ['required', 'date_format:H:i'],
                'roomID' => ['required', 'string', 'regex:/^(\d{2})([1234]{1})(\d{4})$/']
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
            $event->eventStatus = true;

            if ($event->save())
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
        $event = Event::where("eventID", $id)->get();
        return view('staff.event-details-hr')->with('event', $event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //get one event for edit
        $event = Staff::find($id);
        return view('staff.event-details-hr')->with('event', $event);
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
                'eventStartTime' => ['required', 'time'],
                'eventEndTime' => ['required', 'time'],
                'roomID' => ['required', 'string', 'regex:/^(\d{2})([1234]{1})(\d{4})$/']
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
            $event->eventStatus = $request->input('eventStatus');

            if ($event->save())
                return redirect('/staff/hr/registration')->with('success', 'Event updated successfully!');
            else
                return redirect('/staff/hr/registration')->with('failure', 'Event was not updated.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate(Request $request, $id) {
        //find event
        $event = Event::find($id);

        //validate data
        $this->validate($request,
            [
                'eventStatus' => 'required|boolean'
            ]);

        //set event status
        $event->eventStatus = $request->input('eventStatus');

        //redirect to registration page
        if ($event->save())
            return redirect('/staff/hr/registration')->with('success', 'Event has been successfully cancelled!');
        else
            return redirect('/staff/hr/registration')->with('failure', 'Event was not cancelled.');
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
