<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Donor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DonorController extends Controller {
//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function index()
//    {
//        //
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        //
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        //
//    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $donors = Donor::where("donorID", $id)->get();
        return view('donor.donor_profile')->with('donors', $donors);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit() {
        $donor = Donor::find(Auth::user()->donorID);
        if ($donor !== null) {
            return view('donor.donorProfile')->with('donor', $donor);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {

        $donor = Donor::find(Auth::user()->donorID);

        //Validate Data
        $validator = Validator::make($request->all(), [
            'firstName' => ['required', 'string', 'min:2', 'max:255', 'regex:/[A-Za-z\-@ ]{2,}/'],
            'lastName' => ['required', 'string', 'min:2', 'max:255', 'regex:/[A-Za-z\-@ ]{2,}/'],
            'ICNum' => ['required', 'min:12', 'max:12', 'regex:/\d{12}/'],
            'phoneNum' => ['required', 'max:20', 'regex:/([0-9]|[0-9\-]){3,20}/'],
            'emailAddress' => 'required|email|max:255',
            'birthDate' => 'required|date',
            'bloodType' => ['required', 'regex:/[1-8]{1}/'],
            'homeAddress' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            //Set member details
            $donor->firstName = $request->input('firstName');
            $donor->lastName = $request->input('lastName');
            $donor->ICNum = $request->input('ICNum');
            $donor->phoneNum = $request->input('phoneNum');
            $donor->emailAddress = $request->input('emailAddress');
            $donor->birthDate = $request->input('birthDate');
            $donor->bloodType = $request->input('bloodType');
            $donor->homeAddress = $request->input('homeAddress');
            $donor->save();

            //return redirect('/member/' . $id . '/edit')->with('success', 'Member (' . $id . ') has been successfully updated!');
            return redirect('/donor/profile')->with('success', 'Profile details has been successfully updated!');
        }
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
