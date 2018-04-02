<?php

namespace App\Http\Controllers;

use App\Room;
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
            'quadrant' => ['required', 'integer', 'regex:/^[1-4]$/'],
            'floor' => ['required', 'integer', 'regex:/^[0-9]{0,2}$/'],
        ]);

        //generate roomID
        $roomID = sprintf('%02d', $request->input('floor')) . $request->input('quadrant') . sprintf('%03d', (count(Room::all()) + 1));

        //set room details
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        else {
            $room = new Room();
            $room->roomID = $roomID;
            $room->quadrant = $request->input('quadrant');
            $room->floor = $request->input('floor');
            $room->roomStatus = true;

            if ($room->save())
                return redirect('/staff/hr/registration')->with('success', 'Room created successfully!');
            else
                return redirect('/staff/hr/registration')->with('failure', 'Room was not created.');
        }
    }

//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function show($id)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $room = Room::find($id);
        return view('/staff/hr/registration')->with('room', $room);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //find room
        $room = Room::find($id);

        //validate data
        $validator = Validator::make($request->all(), [
            'quadrant' => ['required', 'integer', 'max:1'],
            'floor' => ['required', 'integer', 'max:2'],
        ]);

        //set room details
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        else {
            $room->roomID = $request->input('roomID');
            $room->quadrant = $request->input('quadrant');
            $room->floor = $request->input('floor');
            $room->roomStatus = $request->input('roomStatus');

            if ($room->save())
                return redirect('/staff/hr/registration')->with('success', 'Room updated successfully!');
            else
                return redirect('/staff/hr/registration')->with('failure', 'Room was not updated.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id) {
        //find room
        $room = Room::find($id);
        $room->roomStatus = false;

        if ($room->save())
            return redirect('/staff/hr/registration')->with('success', 'Room deactivated successfully!');
        else
            return redirect('/staff/hr/registration')->with('failure', 'Room was not deactivated.');

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
