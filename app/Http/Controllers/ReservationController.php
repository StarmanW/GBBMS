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
        //get all reservations for reservation history list page
        //find id of current user
        $donor = Donor::find(Auth::user()->donorID);

        $resvs = Reservation::where('donorID', '=', $donor->donorID)->where('resvStatus', '!=', 1)->paginate(10);

        return view('donor.resv-list')->with('resvs', $resvs);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function resvCurrent() {
        //get all reservations for reservation history list page
        //find id of current user
        $donor = Donor::find(Auth::user()->donorID);

        $resvs = Reservation::where('donorID', '=', $donor->donorID)->where('resvStatus', '=', 1)->paginate(10);

        return view('donor.resv-current')->with('resvs', $resvs);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexShort() {
        //get all reservations for reservation history list page
        //find id of current user
        $donor = Donor::find(Auth::user()->donorID);

        $resvs = DB::table('reservations')
            ->select();

        $resv = array();

        for ($i = 0; $i < count($resvs); $i++) {
            if ($resvs[$i]->events->eventDate > Carbon::now()) {
                $resv[$i] = $resvs[$i];
            }
        }

        $unsortedResv = array_sort($resv);

        $resvList = [$unsortedResv[0], $unsortedResv[1], $unsortedResv[2]];

        dd($resvList);

        return view('donor.resv-list')->with('resvList', $resvList);
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

        foreach ($lastDonation as $donation) {
            //get event date
            $donationEventDate = Carbon::createFromTimestamp(strtotime($donation->events->eventDate));

            //get date 3 months from last donation
            $threeMntsFrmDate = $donationEventDate->addMonths(3);

            if ($currentDate <= $threeMntsFrmDate) {
                //get date difference
                $dateDiff = $threeMntsFrmDate->diff($currentDate)->days + 1;

                return redirect('/donor/upcoming-events')->with('failure', 'You have donated blood at ' . date_format(date_create($donation->events->eventDate), 'd F Y') . ' Please try again after ' . $dateDiff . ' days. (After ' . date_format($donationEventDate, 'd F Y') . ')');
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
            if ($currentDate <= $threeMntsFrmDate) {
                //get date difference
                $dateDiff = $threeMntsFrmDate->diff($currentDate)->days + 1;
                return redirect('/donor/upcoming-events')->with('failure', 'You have recently reserved a blood donation event that is within the 3 months period. Please try again after ' . $dateDiff . ' days. (After ' . date_format($donationEventDate, 'd F Y') . ')');
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
        if (preg_match('$https?:\/\/' . $_SERVER['HTTP_HOST'] . '/donor/reservation/current$', url()->previous()) === 1) {
            session(['isResvCurr' => true]);
        } elseif (preg_match('$https?:\/\/' . $_SERVER['HTTP_HOST'] . '/donor/reservation$', url()->previous()) === 1) {
            session(['isResvHistory' => true]);
        }

        $reservation = Reservation::find($id);
        return view('donor.resv-details')->with('reservation', $reservation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id) {
        //deactivate a reservation recor without deleting
        $resv = Reservation::find($id);
        $resv->resvStatus = 3;

        //make new current reservation page first
        if ($resv->save())
            return redirect()->back()->with('success', 'Reservation has been successfully cancelled!');
        else
            return redirect()->back()->with('failure', 'Reservation was not successfully cancelled.');
    }
}
