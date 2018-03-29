<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $staffs = DB::table('staff')->paginate(15);
        return view('staff.staff-list')->with('staffs', $staffs);
    }
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
        //get one staff for profile page
        $staff = Staff::find($id);
        return view('staff.staff-profile')->with('staff', $staff);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit() {
        //get one staff for edit
        $staff = Staff::find(Auth::user()->donorID);
        return view('staff.staff-profile')->with('staff', $staff);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //get current user staff
        $staff = Staff::find(Auth::user()->staffID);

        //validate data
        $validator = Validator::make($request->all(),
            [
                'staffPos' => ['required', 'boolean'],
                'firstName' => ['required', 'string', 'min:2', 'max:255', 'regex:/[A-Za-z\-@ ]{2,}/'],
                'lastName' => ['required', 'string', 'min:2', 'max:255', 'regex:/[A-Za-z\-@ ]{2,}/'],
                'ICNum' => ['required', 'min:12', 'max:12', 'unique:staff', 'regex:/\d{12}/'],
                'phoneNum' => ['required', 'max:20', 'regex:/([0-9]|[0-9\-]){3,20}/'],
                'emailAddress' => 'required|email|max:255|unique:staff',
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

            //set staff details
            $staff->staffPos = $request->input('staffPos');
            $staff->firstName = $request->input('firstName');
            $staff->lastName = $request->input('lastName');
            $staff->ICNum = $request->input('ICNum');
            $staff->phoneNum = $request->input('phoneNum');
            $staff->emailAddress = $request->input('emailAddress');
            $staff->birthDate = $request->input('birthDate');
            $staff->gender = $request->input('gender');
            $staff->profileImage = $request->input('profileImage');
            $staff->homeAddress = $request->input('homeAddress');

            //redirect to staff profile with update status and message
            if ($staff->save())
                return redirect('/staff/profile')->with('success', 'Profile details has been successfully updated!');
            else
                return redirect('/staff/profile')->with('failure', 'Oops, Profile details was not updated successfully.');
        }
    }

    /**
     * Update staff account status for deactivation.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate(Request $request, $id) {
        //Set donor account status
        $staff = Auth::user();
        $staff->staffAccStatus = 0;

        //redirect to staff login
        if ($staff->save()) {
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
