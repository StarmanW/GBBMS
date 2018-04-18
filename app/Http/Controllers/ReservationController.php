<?php

namespace App\Http\Controllers;

use App\Donor;
use App\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        //get current user donor
        $donor = Donor::find(Auth::user()->donorID);

        //get reservations history for the user and paginate into set of 10
        $resvs = Reservation::where('donorID', '=', $donor->donorID)->where('resvStatus', '!=', 1)->paginate(10);

        //return result to reservation history list page
        return view('donor.resv-list')->with('resvs', $resvs);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function resvCurrent() {
        //get current user donor
        $donor = Donor::find(Auth::user()->donorID);

        //get current reservations for the user and paginate into set of 10
        $resvs = Reservation::where('donorID', '=', $donor->donorID)->where('resvStatus', '=', 1)->paginate(10);

        //return result to reservation list page
        return view('donor.resv-current')->with('resvs', $resvs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function store($id) {

        //receive and store reservation detail in DB
        //get current user id
        $donor = Donor::find(Auth::user()->donorID);

        //Check for duplicate reservation
        $duplicateResv = Reservation::where('donorID', '=', $donor->donorID)
            ->where('eventID', '=', $id)
            ->where('resvStatus', '=', 1)->get();

        //If returned result is not 0, redirect back with failure message
        if (count($duplicateResv) !== 0) {
            return redirect()->back()->with('failure', 'Duplicated reservation, you have already reserved for this donation.');
        }

        //check eligibility
        //get last donation date
        //->orWhere('resvStatus', '=', 1)
        $lastDonation = Reservation::where('donorID', '=', $donor->donorID)->where('resvStatus', '=', 0)->get();

        //get current date
        $currentDate = Carbon::now();

        //Check for recent donation
        foreach ($lastDonation as $donation) {
            //get event date
            $donationEventDate = Carbon::createFromTimestamp(strtotime($donation->events->eventDate));

            //get date 3 months from last donation
            $threeMntsFrmDate = $donationEventDate->addMonths(3);

            //check if last donation date is 3 months ago
            if ($currentDate <= $threeMntsFrmDate) {
                //get date difference
                $dateDiff = $threeMntsFrmDate->diff($currentDate)->days + 1;

                //return to upcoming events page with message
                return redirect('/donor/upcoming-events')->with
                    (
                        'failure', 'You have donated blood at ' .
                        date_format(date_create($donation->events->eventDate), 'd F Y') .
                        ' Please try again after ' . $dateDiff . ' days. 
                        (After ' . date_format($donationEventDate, 'd F Y') . ')'
                    );
            }
        }

        //Check for recent reservation
        $recentResv = Reservation::where('donorID', '=', $donor->donorID)->where('resvStatus', '=', 1)->get();
        //get current date
        $currentDate = Carbon::now();
        foreach ($recentResv as $donation) {
            //get event date
            $donationEventDate = Carbon::createFromTimestamp(strtotime($donation->events->eventDate));
            //get date 3 months from last donation
            $threeMntsFrmDate = $donationEventDate->addMonths(3);

            //check if last reservation date is 3 months ago
            if ($currentDate <= $threeMntsFrmDate) {
                //get date difference
                $dateDiff = $threeMntsFrmDate->diff($currentDate)->days + 1;

                //return to upcoming events page with message
                return redirect('/donor/upcoming-events')->with
                    (
                        'failure', 'You have recently reserved a blood donation event that is within the 3 months period. 
                        Please try again after ' . $dateDiff . ' days. (After ' . date_format($donationEventDate, 'd F Y') . ')'
                    );
            }
        }

        //Checks if donors previously reserved a specific event
        //If donors previously cancelled a specific event, set status
        //back to 1 instead of creating a duplicated records
        $prevCancelledResv = Reservation::where('donorId', $donor->donorID)->where('eventID', $id)->where('resvStatus', 3)->first();
        if ($prevCancelledResv !== null) {
            $prevCancelledResv->resvStatus = 1;     //Update 'cancelled' status back to 'reserved'
            
            //return to upcoming events page with message
            if ($prevCancelledResv->save())
                return redirect('/donor/upcoming-events/' . $prevCancelledResv->eventID)->with('success', 'Reservation has been successfully made!');
            else
                return redirect('/donor/upcoming-events/')->with('failure', 'Oops, reservation was not successfully made.');
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

        //if save successful, return to upcoming events page with message
        if ($resv->save())
            return redirect('/donor/upcoming-events/' . $resv->eventID)->with('success', 'Reservation has been successfully made!');
        else
            return redirect('/donor/upcoming-events/')->with('failure', 'Oops, reservation was not successfully made.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        //find and return reservation to reservation details page
        if (preg_match('$https?:\/\/' . $_SERVER['HTTP_HOST'] . '/donor/reservation/current$', url()->previous()) === 1) {
            session(['isResvCurr' => true]);
        } elseif (preg_match('$https?:\/\/' . $_SERVER['HTTP_HOST'] . '/donor/reservation$', url()->previous()) === 1) {
            session(['isResvHistory' => true]);
        }

        //find a specific reservation
        $reservation = Reservation::find($id);

        //return result to reservation detail page
        return view('donor.resv-details')->with('reservation', $reservation);
    }

    /**
     * Deactivate a reservation record without deleting.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id) {
        //find a specific reservation
        $resv = Reservation::find($id);

        //set reservation status to "Donor cancelled"
        $resv->resvStatus = 3;

        //return to current page with message
        if ($resv->save())
            return redirect()->back()->with('success', 'Reservation has been successfully cancelled!');
        else
            return redirect()->back()->with('failure', 'Reservation was not successfully cancelled.');
    }
}
