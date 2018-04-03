<?php

namespace App\Http\Controllers;

use App\Blood;
use App\Donor;
use App\Event;
use App\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        //validate data
        $validator = Validator::make($request->all(),
            [
                'bloodBagID' => ['required', 'string', 'max:8', 'min:8', 'regex:/((NAP)|(NAN)|(NBP)|(NBN)|(NOP)|(NON)|(ABP)|(ABN){3})(\d{6})/'],
                'bloodVol' => ['required', 'integer', 'max:3', 'between:0,500'],
                'remarks' => ['nullable', 'string', 'max:255']
            ]);

        //find records by id
        $blood = Blood::find($request->bloodBagID);
        $donor = Donor::find($request->donorID);
        $event = Event::find($request->eventID);
        if ($blood !== null)
            return redirect()->back()->with('failure', 'Blood Bag ID ' . $blood->bloodBagID . ' already exist, please try again.');
        else if ($donor === null)
            return redirect()->back()->with('failure', 'No donor with ID' . $request->donorID . ' is found. Please try again.');
        else if ($event === null)
            return redirect()->back()->with('failure', 'No event with ID ' . $request->eventID . ' is found. Please try again.');
        else if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        else {
            $blood = new Blood();
            $blood->bloodBagID = $request->input('bloodBagID');
            $blood->donorID = $donor-donorID;
            $blood->eventID = $event->eventID;
            $blood->bloodVol = $request->input('bloodVol');
            $blood->remarks = $request->input('remarks');

            if ($blood->save() === true)
                return redirect('/staff/nurse/manage-blood')->with('success', 'Blood donation created successfully!');
            else
                return redirect('/staff/nurse/manage-blood')->with('failure', 'Blood donation was not created.');
        }
    }

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
