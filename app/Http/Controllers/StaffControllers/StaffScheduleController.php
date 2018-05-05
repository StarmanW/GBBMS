<?php

namespace App\Http\Controllers\StaffControllers;

use App\Models\EventSchedule;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

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
        //get current user staff
        $staff = Staff::find(Auth::user()->staffID);
        //get all schedule related to the user and paginate into set of 10
        $schedules = EventSchedule::where('staffID', '=', $staff->staffID)->where('schedStatus', '=', '1')->paginate(10);

        //return result to nurse schedule list page
        return view('staff.nurse.schedule-list')->with('schedules', $schedules);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function schedHistory() {
        //get current user staff
        $staff = Staff::find(Auth::user()->staffID);
        //get all schedule history related to the user and paginate into set of 10
        $scheduleHistory = EventSchedule::where('staffID', '=', $staff->staffID)->where('schedStatus', '=', '0')->paginate(10);

        //return result to nurse schedule history list page
        return view('staff.nurse.schedule-history')->with('scheduleHistory', $scheduleHistory);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //get a specific schedule
        $schedule = EventSchedule::find($id);

        //return result to nurse schedule detail page
        return view('staff.nurse.schedule-details')->with('schedule', $schedule);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function showHistory($id) {
        //find specific schedule history
        $scheduleHistory = EventSchedule::find($id);

        //return result to nurse schedule history detail page
        return view('staff.nurse.schedule-history-details')->with('scheduleHistory', $scheduleHistory);
    }
}
