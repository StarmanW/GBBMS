<?php

namespace App\Http\Controllers;

use App\Donor;
use App\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller {

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
        //find id of current user
        $donor = Donor::find(Auth::user()->donorID);

        //get all reservations for reservation history list page
        $resvs = Reservation::where('donorID', '=', $donor->donorID)->get();

        return view('donor.resv-list')->with('resvs', $resvs);
    }

//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        //
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function store($id) {

        //get current user id
        $donor = Donor::find(Auth::user()->donorID);

        //check eligibility
        //get last donation date
        //->orWhere('resvStatus', '=', 1)
        $lastDonation = Reservation::where('donorID', '=', $donor->donorID)->where('resvStatus', '=', 0)->get();

        //get current date
        $currentDate = Carbon::now();

        foreach ($lastDonation as $donation) {
            //get event date
            $donationEventDate = Carbon::createFromTimestamp(strtotime($donation->events->eventDate));

            //get date 3 months from last donation
            $threeMntsFrmDate = $donationEventDate->addMonths(3);

            if ($currentDate <= $threeMntsFrmDate) {
                //get date difference
                $dateDiff = $threeMntsFrmDate->diff($currentDate)->days + 1;

                return redirect('/donor/upcoming-events')->with('failure', 'You have donated blood at ' . date_format($donationEventDate, 'd F Y') . ' Please try again after ' . $dateDiff . ' days.');
            }
        }

        //generate reservation id
        $resvID = 'R' . date('y') . sprintf('%04d', count(Reservation::all()) + 1);

        //create reservation
        $resv = new Reservation();
        $resv->resvID = $resvID;
        $resv->donorID = $donor->donorID;
        $resv->eventID = $id;
        $resv->resvDateTime = Carbon::now();
        $resv->resvStatus = 1;

        if ($resv->save())
            return redirect('/donor/upcoming-events/' . $resv->eventID)->with('success', 'Reservation has been successfully made!');
        else
            return redirect('/donor/upcoming-events')->with('failure', 'Oops, reservation was not successfully made.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //find and return reservation to reservation details page
        $reservation = Reservation::find($id);
        return view('donor.resv-details')->with('reservation', $reservation);
    }

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id) {
        $resv = Reservation::find($id);
        $resv->resvStatus = 3;

        //make new current reservation page first
        if ($resv->save())
            return redirect('/donor/reservation/current')->with('success', 'Reservation created successfully!');
        else
            return redirect('/donor/reservation/current')->with('failure', 'Reservation was not created.');
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
