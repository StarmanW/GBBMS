<?php

namespace App\Http\Controllers;

use App\Blood;
use Illuminate\Support\Facades\Auth;

class DonorHistoryController extends Controller {

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
     * Display the donation history list for donor
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $donationHistory = Blood::where('donorID', '=', Auth::user()->donorID)->paginate(10);
        return view('donor.donate-history')->with('donationHistory', $donationHistory);
    }

    /**
     * Display the specific donation history for a donor
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $donHistDetail = Blood::where('bloodBagID', $id)->where('donorID', '=', Auth::user()->donorID)->first();
        return view('donor.donate-history-details')->with('donHistDetail', $donHistDetail);
    }
}
