<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

	/**
	* Create new controller instance
	*
	* @return void
	*/
	public function __construct() {
		$this->middleware('auth:staff');
	}
	
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staff = Staff::where("staffID", $id)->get();
        return view('staff.staff-profile')->with('staff', $staff);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staff = Staff::find($id);

		$data = ['staff' => $staff];
		return view('staff.staff-profile')->with('staff', $staff);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate data
		$this->validate($request,
		[
			'staffPos' => ['required', 'boolean'],
			'firstName' => ['required', 'string', 'min:2', 'max:255', 'regex:/[A-Za-z\-@ ]{2,}/'],
            'lastName' => ['required', 'string', 'min:2', 'max:255', 'regex:/[A-Za-z\-@ ]{2,}/'],
            'ICNum' => ['required', 'min:12', 'max:12', 'unique:staffs', 'regex:/\d{12}/'],
            'phoneNum' => ['required', 'max:20', 'regex:/([0-9]|[0-9\-]){3,20}/'],
            'emailAddress' => 'required|email|max:255|unique:staffs',
            'birthDate' => 'required|date',
            'password' => 'required|min:6|max:255|confirmed',
            'homeAddress' => 'required|max:500'
		]);
		
		//set staff details
		$staff->staffPos = $request->input('staffPos');
		$staff->firstName = $request->input('firstName');
		$staff->lastName = $request->input('lastName');
		$staff->ICNum = $request->input('ICNum');
		$staff->phoneNum = $request->input('phoneNum');
		$staff->emailAddress = $request->input('emailAddress');
		$staff->birthDate = $request->input('birthDate');
		$staff->password = $request->input('password');
		$staff->homeAddress = $request->input('homeAddress');
		
		//redirect to donor profile with update status and message
		if($donor->save())
			return redirect('/profile')->with('success', 'Staff (' . $id . ') has been successfully updated!');
		else
			return redirect('/profile')->with('failure', 'Oops, staff (' . $id . ') was not updated successfully.');
			
    }

	/**
     * Update donor account status for deactivation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate(Request $request, $id)
    {
        //validate data
		$this->validate($request,
		[
            'staffAccStatus' => 'required|boolean'
		]);
		
		//set staff account status
		$staff->staffAccStatus = $request->input('staffAccStatus');
		
		//redirect to donor login
		if($staff->save())
			return redirect('/login')->with('success');
		else
			return redirect('/login')->with('failure');
		
    }
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
