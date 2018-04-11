<?php

namespace App\Http\Controllers;

use App\EventSchedule;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffScheduleController extends Controller {
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
        //get all schedule with current user staff and return to schedule list page
        $staff = Staff::find(Auth::user()->staffID);
        $schedules = EventSchedule::where('staffID', '=', $staff->staffID)->where('schedStatus', '=', '1')->paginate(10);

        return view('staff.schedule-list')->with('schedules', $schedules);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $schedule = EventSchedule::find($id);
        return view('staff.schedule-details')->with('schedule', $schedule);
    }
}
