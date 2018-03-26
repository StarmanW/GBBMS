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
            'gender' => ['required', 'boolean'],
            'profileImage' => 'image|nullable|max:1999',
            'homeAddress' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            //Handle file upload
            if ($request->hasFile('profileImage')) {
                //Get filename
                $fileNameWithExt = $request->file('profileImage')->getClientOriginalName();
                //Get just filename
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //Get just extension
                $extension = $request->file('profileImage')->getClientOriginalExtension();
                //Filename to store, add timestamp for uniqueness of images that
                //might have the same name.
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                //Upload Image
                /*
                 * By default, storage folder is not accessible.
                 * Required to run "php artisan storage:link" command to create a sym link
                 * between the storage folder and the public folder.
                 */
                $path = $request->file('profileImage')->storeAs('public/profileImage', $fileNameToStore);
            }

            //Set member details
            $donor->firstName = $request->input('firstName');
            $donor->lastName = $request->input('lastName');
            $donor->ICNum = $request->input('ICNum');
            $donor->phoneNum = $request->input('phoneNum');
            $donor->emailAddress = $request->input('emailAddress');
            $donor->birthDate = $request->input('birthDate');
            $donor->bloodType = $request->input('bloodType');
            $donor->gender = $request->input('gender');
            if ($request->hasFile('profileImage')) {
                $donor->profileImage = $fileNameToStore;
            }
            $donor->homeAddress = $request->input('homeAddress');

            if($donor->save())
                return redirect('/donor/profile')->with('success', 'Profile details has been successfully updated!');
            else
                return redirect('/donor/profile')->with('failure', 'Oops, Profile details was not updated successfully.');
        }
    }


    /**
     * Update donor account status for deactivation.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function deactivate(Request $request) {
        //Set donor account status
        $donor = Auth::user();
        $donor->donorAccStatus = 0;

        //redirect to donor login
        if ($donor->save()) {
            Auth::logout();                         //Log user out
            $request->session()->invalidate();      //Invalidate the session
            return redirect('/login')->with('success');
        } else
            return redirect('/login')->with('failure');
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
