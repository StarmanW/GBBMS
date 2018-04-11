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
        $this->middleware('auth:staff');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $donors = Donor::paginate(15);
        return view('staff.donor-list')->with('donors', $donors);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $donor = Donor::find($id);
        return view('staff.donor-profile-hr')->with('donor', $donor);
    }
}
