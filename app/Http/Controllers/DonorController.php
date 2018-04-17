<?php

namespace App\Http\Controllers;

use App\Blood;
use App\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DonorController extends Controller {

    /**
     * Create new controller instance
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:donor');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit() {
        $donor = Donor::find(Auth::user()->donorID);
        return view('donor.donorProfile')->with('donor', $donor);
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
            'ICNum' => ['required', 'min:12', 'max:12', 'regex:/\d{12}/', 'unique:donors,ICNum,'.Auth::user()->donorID.',donorID'],
            'phoneNum' => ['required', 'max:20', 'regex:/([0-9]|[0-9\-]){3,20}/'],
            'emailAddress' => 'required|email|max:255|unique:donors,emailAddress,'.Auth::user()->emailAddress.',emailAddress',
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

                //Deletes the old profile image
                if ($donor->profileImage !== 'defaultProfileImage.jpg') {
                    File::delete(public_path() . '\storage\profileImage\\' . $donor->profileImage);
                }
            }

            $bloods = Blood::where('donorID', '=', Auth::user()->donorID)->get();
            $bloodCount = 0;
            if (count($bloods) !== 0) {
                foreach ($bloods as $blood) {
                    $blood->bloodType = $request->input('bloodType');
                    $blood->save();
                    $bloodCount++;
                }
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

            if($donor->save() === true && $bloodCount === count($bloods))
                return redirect('/donor/profile')->with('success', 'Profile details has been successfully updated!');
            else
                return redirect('/donor/profile')->with('failure', 'Oops, Profile details was not updated successfully.');
        }
    }

    /**
     * Update the donor's password
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request) {

        $donor = Donor::find(Auth::user()->donorID);

        //Verify current password input field
        if (!(Hash::check($request['currentPass'], Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not match with the password you provided.");
        }

        //Verify if new password is the current (old) password
        if(strcmp($request['currentPass'], $request['newPass']) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New password cannot be same as your current password. Please choose a different password.");
        }

        //Validate Data
        session(['passValidation' => 'true']);          //Set passValidation to true so the correct modal will be displayed
        $validator = Validator::make($request->all(), [
            'currentPass' => 'required|min:6|max:255',
            'newPass' => 'required|min:6|max:255|confirmed'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            //Set donor new password
            $donor->password = bcrypt($request['newPass']);
            if($donor->save())
                return redirect()->back()->with('success', 'Password successfully changed!');
            else
                return redirect()->back()->with('error', 'Oops, password was not successfully changed.');
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
            return redirect('/login')->with('success', 'Your account has been successfully deactivated!');
        } else
            return redirect('/login')->with('failure', 'Your account was not deactivated.');
    }
}
