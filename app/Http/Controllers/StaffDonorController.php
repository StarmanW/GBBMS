<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Donor;

class StaffDonorController extends Controller {

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
        //get all donors and paginate into set of 10
        $donors = Donor::paginate(10);

        //return result to donor list page
        return view('staff.donor-list')->with('donors', $donors);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //get a specific donor
        $donor = Donor::find($id);

        //return result to donor profile page
        return view('staff.donor-profile-hr')->with('donor', $donor);
    }
}
