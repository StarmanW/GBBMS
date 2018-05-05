<?php

namespace App\Http\Controllers\StaffControllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StaffRoomController extends Controller {

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //Set the current registration tab into session
        session(['roomTab' => 'true']);

        //validate data
        $validator = Validator::make($request->all(), [
            'roomNo' => ['required', 'integer', 'regex:/^[0-9]{0,3}$/'],
            'quadrant' => ['required', 'integer', 'regex:/^[1-4]$/'],
            'floor' => ['required', 'integer', 'regex:/^[0-9]{0,2}$/'],
        ]);

        //set room details
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        else {
            //Generate roomID
            $roomID = sprintf('%02d', $request->input('floor')) . $request->input('quadrant') . sprintf('%03d', $request->input('roomNo'));

            if(Room::find($roomID) !== null) {
                return redirect('/staff/hr/registration')->withInput()->with('roomAddDup', 'The room has already existed in the system.');
            }

            $room = new Room();
            $room->roomID = $roomID;
            $room->quadrant = $request->input('quadrant');
            $room->floor = $request->input('floor');
            $room->roomStatus = true;

            //return to HR registration page with message
            if ($room->save() === true)
                return redirect('/staff/hr/registration')->with('success', 'Room created successfully!');
            else
                return redirect('/staff/hr/registration')->with('roomAddFailed', 'Room creation was unsuccessfully.');
        }
    }
}
