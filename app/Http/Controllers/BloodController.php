<?php

namespace App\Http\Controllers;

use App\Blood;
use App\Donor;
use App\Event;
use App\EventSchedule;
use App\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BloodController extends Controller {
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id) {
        //get all donor id for blood management page
        $schedule = EventSchedule::find($id);
        $reservations = Reservation::where('eventID', '=', $schedule->eventID)->where('resvStatus', '=', 1)->get();

        $donors = array();
        for ($i = 0; $i < count($reservations); $i++)
            $donors[$i] = $reservations[$i]->donors;

        $data = [
            'donors' => $donors,
            'eventID' => $schedule->eventID
        ];

        return view('staff.blood-management')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        //validate data
        $validator = Validator::make($request->all(),
            [
                'bloodBagID' => ['required', 'string', 'max:9', 'min:9', 'regex:/^((NAP)|(NAN)|(NBP)|(NBN)|(NOP)|(NON)|(ABP)|(ABN))(\d{6})$/'],
                'donorID' => ['required', 'regex:/^D\d{6}$/'],
                'bloodVol' => ['required', 'integer', 'between:0,500'],
                'remarks' => ['nullable', 'string', 'max:255']
            ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //find records by id
        $blood = Blood::find($request->bloodBagID);
        $donor = Donor::find($request->donorID);
        $event = Event::find(session('eventID'));
        $reservation = Reservation::where('eventID', '=', session('eventID'))->where('donorID', '=', $donor->donorID)->first();

        if ($blood !== null)
            return redirect()->back()->with('failure', 'Blood Bag ID ' . $blood->bloodBagID . ' already exist, please try again.');
        else if ($donor === null)
            return redirect()->back()->with('failure', 'No donor with ID' . $request->donorID . ' is found. Please try again.');
        else if ($event === null)
            return redirect()->back()->with('failure', 'No event with ID ' . $request->eventID . ' is found. Please try again.');
        else {
            $reservation->resvStatus = 0;

            $blood = new Blood();
            $blood->bloodBagID = $request->input('bloodBagID');
            $blood->donorID = $donor->donorID;
            $blood->eventID = $event->eventID;
            $blood->bloodType = $donor->bloodType;
            $blood->bloodVol = $request->input('bloodVol');
            $blood->remarks = $request->input('remarks');

            if ($blood->save() === true && $reservation->save() === true)
                return redirect()->back()->with('success', 'Blood bag (' . $blood->bloodBagID . ') for (' .
                    $donor->firstName . ' ' . $donor->firstName . ') (' . $donor->donorID  . ') has been registered!');
            else
                return redirect()->back()->with('failure', 'Blood bag for donor (' . $donor->donorID . ') was not created.');
        }
    }
}
