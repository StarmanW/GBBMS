<?php

namespace App\Http\Controllers\StaffControllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

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
    public function index() {
        //get all staffs and paginate into set of 10
        $staffs = Staff::paginate(10);

        //return result to staff list page
        return view('staff.hrm.staff-list')->with('staffs', $staffs);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //get a specific staff
        $staff = Staff::find($id);

        //return result to staff profile page
        return view('staff.hrm.staff-details-hr')->with('staff', $staff);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit() {
        //get a specific staff
        $staff = Staff::find(Auth::user()->staffID);

        //return result to staff profile for editing
        return view('staff.staff-profile')->with('staff', $staff);
    }

    /**
     * Update the staff's password
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request) {

        //get current user staff
        $staff = Staff::find(Auth::user()->staffID);

        //Verify current password input field
        if (!(Hash::check($request['currentPassword'], Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not match with the password you provided.");
        }

        //Verify if new password is the current (old) password
        if (strcmp($request['currentPassword'], $request['newPassword']) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "New password cannot be same as your current password. Please choose a different password.");
        }

        //Validate Data
        //Set passValidation to true so the correct modal will be displayed
        session(['passValidation' => 'true']);
        $validator = Validator::make($request->all(), [
            'currentPassword' => 'required|min:6|max:255',
            'newPassword' => 'required|min:6|max:255|confirmed'
        ]);

        //return to current page with message
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            //Set staff new password
            $staff->password = bcrypt($request['newPassword']);
            if ($staff->save())
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
                'ICNum' => ['required', 'min:12', 'max:12', 'unique:staff,ICNum,' . Auth::user()->staffID . ',staffID', 'regex:/\d{12}/'],
                'phoneNum' => ['required', 'max:20', 'regex:/([0-9]|[0-9\-]){3,20}/'],
                'emailAddress' => 'required|email|max:255|unique:staff,emailAddress,' . Auth::user()->staffID . ',staffID',
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

            //return to current page with message
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
                'ICNum' => ['required', 'min:12', 'max:12', 'unique:staff,ICNum,' . $staff->staffID . ',staffID', 'regex:/\d{12}/'],
                'phoneNum' => ['required', 'max:20', 'regex:/([0-9]|[0-9\-]){3,20}/'],
                'emailAddress' => 'required|email|max:255|unique:staff,emailAddress,' . $staff->staffID . ',staffID',
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

            //return to current page with message
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
        //find current user staff
        $staff = Auth::user();

        //set staff account to "deactivated"
        $staff->staffAccStatus = 0;

        //if current user is HR manager and is the only HR manager, return to current page with message
        if ($staff->staffPos === 1 && Staff::where('staffPos', '=', 1)->count() === 1)
            return redirect()->back()->with('failure', 'Please nominate a new HR manager before proceeding.');

        //return to staff login page with message
        if ($staff->save()) {
            //Log user out
            Auth::logout();

            //Invalidate the session
            $request->session()->invalidate();

            return redirect('/login')->with('success', 'Your account has been successfully deactivated!');
        } else
            return redirect('/login')->with('failure', 'Your account was not deactivated.');
    }

    /**
     * Update staff account status for deactivation by HR manager only.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function deactivateHR($id) {
        //if the specific staff account is deactivated
        if (Staff::where('staffID', '=', $id)->where('staffAccStatus', '=', 0)->count() !== 0) {
            //return to current page with message
            return redirect()->back()->with('failure', 'Staff account has already been deactivated.');
        } else {
            //get a specific staff account
            $staff = Staff::find($id);

            //if current user is HR manager and is the only HR manager, return to current page with message
            if ($staff->staffPos === 1 && Staff::where('staffPos', '=', 1)->count() === 1)
                return redirect()->back()->with('failure', 'Please nominate a new HR manager before proceeding.');

            //set staff account status to "deactivated"
            $staff->staffAccStatus = 0;

            //return to staff login page with message
            if ($staff->save()) {
                return redirect()->back()->with('successHRDeactivate', 'Staff (' . $staff->staffID . ') account has been successfully deactivated!');
            } else
                return redirect()->back()->with('failureHRDeactivate', 'Oops, an error has occurred while deactivating staff (' . $staff->staffID . ')account.');
        }
    }
}
