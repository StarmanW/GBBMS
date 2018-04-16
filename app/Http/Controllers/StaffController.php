<?php

namespace App\Http\Controllers;

use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller {

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
        //get all staffs and paginate for list page
        $staffs = Staff::paginate(10);
        return view('staff.staff-list')->with('staffs', $staffs);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //get one staff for profile page
        $staff = Staff::find($id);
        return view('staff.staff-details-hr')->with('staff', $staff);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit() {
        //get one staff for edit
        $staff = Staff::find(Auth::user()->staffID);
        return view('staff.staff-profile')->with('staff', $staff);
    }

    /**
     * Update the staff's password
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request) {

        $staff = Staff::find(Auth::user()->staffID);

        //Verify current password input field
        if (!(Hash::check($request['currentPass'], Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not match with the password you provided.");
        }

        //Verify if new password is the current (old) password
        if(strcmp($request['currentPass'], $request['newPass']) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
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
            //Set staff new password
            $staff->password = bcrypt($request['newPass']);
            if($staff->save())
                return redirect()->back()->with('success', 'Password successfully changed!');
            else
                return redirect()->back()->with('error', 'Oops, password was not successfully changed.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        //get current user staff
        $staff = Staff::find(Auth::user()->staffID);

        //validate data
        $validator = Validator::make($request->all(),
            [
                'firstName' => ['required', 'string', 'min:2', 'max:255', 'regex:/[A-Za-z\-@ ]{2,}/'],
                'lastName' => ['required', 'string', 'min:2', 'max:255', 'regex:/[A-Za-z\-@ ]{2,}/'],
                'ICNum' => ['required', 'min:12', 'max:12', 'unique:staff,ICNum,'.Auth::user()->staffID.',staffID', 'regex:/\d{12}/'],
                'phoneNum' => ['required', 'max:20', 'regex:/([0-9]|[0-9\-]){3,20}/'],
                'emailAddress' => 'required|email|max:255|unique:staff,emailAddress,'.Auth::user()->staffID.',staffID',
                'birthDate' => 'required|date',
                'gender' => ['required', 'boolean'],
                'profileImage' => 'image|nullable|max:1999',
                'homeAddress' => 'required|max:500'
            ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        else {

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
                if ($staff->profileImage !== 'defaultProfileImage.jpg') {
                    File::delete(public_path() . '\storage\profileImage\\' . $staff->profileImage);
                }
            }

            //Set staff details
            $staff->firstName = $request->input('firstName');
            $staff->lastName = $request->input('lastName');
            $staff->ICNum = $request->input('ICNum');
            $staff->phoneNum = $request->input('phoneNum');
            $staff->emailAddress = $request->input('emailAddress');
            $staff->birthDate = $request->input('birthDate');
            $staff->gender = $request->input('gender');
            if ($request->hasFile('profileImage')) {
                $staff->profileImage = $fileNameToStore;
            }
            $staff->homeAddress = $request->input('homeAddress');

            //redirect to staff profile with update status and message
            if ($staff->save())
                return redirect()->back()->with('success', 'Staff profile details has been successfully updated!');
            else
                return redirect()->back()->with('failure', 'Oops, staff profile details was not updated successfully.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  string $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateHR(Request $request, $id) {
        //get current user staff
        $staff = Staff::find($id);

        //validate data
        $validator = Validator::make($request->all(),
            [
                'staffPos' => ['required', 'boolean'],
                'firstName' => ['required', 'string', 'min:2', 'max:255', 'regex:/[A-Za-z\-@ ]{2,}/'],
                'lastName' => ['required', 'string', 'min:2', 'max:255', 'regex:/[A-Za-z\-@ ]{2,}/'],
                'ICNum' => ['required', 'min:12', 'max:12', 'unique:staff,ICNum,'.$staff->staffID.',staffID', 'regex:/\d{12}/'],
                'phoneNum' => ['required', 'max:20', 'regex:/([0-9]|[0-9\-]){3,20}/'],
                'emailAddress' => 'required|email|max:255|unique:staff,emailAddress,'.$staff->staffID.',staffID',
                'birthDate' => 'required|date',
                'gender' => ['required', 'boolean'],
                'profileImage' => 'image|nullable|max:1999',
                'homeAddress' => 'required|max:500'
            ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        else {

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

            //Set staff details
            $staff->staffPos = $request->input('staffPos');
            $staff->firstName = $request->input('firstName');
            $staff->lastName = $request->input('lastName');
            $staff->ICNum = $request->input('ICNum');
            $staff->phoneNum = $request->input('phoneNum');
            $staff->emailAddress = $request->input('emailAddress');
            $staff->birthDate = $request->input('birthDate');
            $staff->gender = $request->input('gender');
            if ($request->hasFile('profileImage')) {
                $staff->profileImage = $fileNameToStore;
            }
            $staff->homeAddress = $request->input('homeAddress');

            //redirect to staff profile with update status and message
            if ($staff->save())
                return redirect()->back()->with('success', 'Staff profile details has been successfully updated!');
            else
                return redirect()->back()->with('failure', 'Oops, staff profile details was not updated successfully.');
        }
    }

    /**
     * Update staff account status for deactivation.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function deactivate(Request $request) {
        //Set staff account status
        $staff = Auth::user();
        $staff->staffAccStatus = 0;

        if ($staff->staffPos === 1 && Staff::where('staffPos', '=', 1)->count() === 1) {
            return redirect()->back()->with('failure', 'Please nominate a new HR manager before proceeding.');
        }

        //redirect to staff login
        if ($staff->save()) {
            Auth::logout();                         //Log user out
            $request->session()->invalidate();      //Invalidate the session
            return redirect('/login')->with('success', 'Your account has been successfully deactivated!');
        } else
            return redirect('/login')->with('failure', 'Your account was not deactivated.');
    }

    /**
     * Update staff account status for deactivation by HR manager.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function deactivateHR($id) {
        //Set staff account status
        $staff = Staff::where('staffID', '=', $id)->where('staffAccStatus', '=', 1)->get();

        if ($staff !== 0)
            return redirect()->back()->with('failure', 'Staff account has already been deactivated.');
        else
        {
            if ($staff->staffPos === 1 && Staff::where('staffPos', '=', 1)->count() === 1)
                return redirect()->back()->with('failure', 'Please nominate a new HR manager before proceeding.');

            $staff->staffAccStatus = 0;

            //redirect to staff login
            if ($staff->save()) {
                return redirect()->back()->with('successHRDeactivate', 'Staff ('. $staff->staffID .') account has been successfully deactivated!');
            } else
                return redirect()->back()->with('failureHRDeactivate', 'Oops, an error has occurred while deactivating staff ('. $staff->staffID .')account.');
        }
    }
}
