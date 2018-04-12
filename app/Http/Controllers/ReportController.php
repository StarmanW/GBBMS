<?php

namespace App\Http\Controllers;

use App\Blood;
use App\Donor;
use App\Event;
use App\Reservation;
use App\Staff;
use Illuminate\Support\Facades\Validator;
use PDF;
use Illuminate\Http\Request;

class ReportController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        //get all blood amount for each blood type and return to dashboard page
        $bloods = Blood::all();

        //save total of each blood type to array
        $totalBlood = array(0, 0, 0, 0, 0, 0, 0, 0);
        for ($i = 1; $i <= 8; $i++) {
            for ($j = 0; $j < count($bloods); $j++) {
                if ($bloods[$j]->donors->bloodType === $i) {
                    $totalBlood[$i - 1] += 1;
                }
            }
        }

        $data = [
            'donorCount' => Donor::count(),
            'nurseCount' => Staff::where('staffPos', '=', '0')->count(),
            'eventCount' => Event::count(),
            'bloodCount' => Blood::count(),
            'totalBlood' => $totalBlood
        ];

        return view('staff.dashboard')->with('data', $data);
    }

    /***** Exception Report - Reservation Cancellation for each events *****/
    public function exceptionReportIndex() {
        $events = Event::all();
        return view('staff.reports.exceptionReportIndex')->with('events', $events);
    }

    public function exceptionReport(Request $request) {
        //Validate event ID
        $validator = Validator::make($request->all(), [
            'eventID' => ['required', 'regex:/E\d{6}/']
        ]);

        //Return the appropriate response
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            //Retrieve all reservation records that are cancelled by donor
            $resvs = Reservation::where('resvStatus', '=', 3)->where('eventID', '=', $request['eventID'])->paginate(10);

            if (count($resvs) === 0)
                return redirect()->back()->with('emptyResv', true);
            else
                return view('staff.reports.exceptionReport')->with('resvs', $resvs);
        }
    }

    public function exceptionReportPrint($id) {
        $data = [
            'resvs' => Reservation::where('resvStatus', '=', 3)->where('eventID', '=', $id)->get()
        ];
        $pdf = PDF::loadView('staff.reports.exceptionReportPrint', $data);
        return $pdf->stream('Event ('. $id . ') Reservation Cancellation Report.pdf');
    }


    /***** Transaction Report - Reservation list for each events *****/
    public function transactionReportIndex() {
        $events = Event::all();
        return view('staff.reports.transactionReportIndex')->with('events', $events);
    }

    public function transactionReport(Request $request) {
        //Validate event ID
        $validator = Validator::make($request->all(), [
            'eventID' => ['required', 'regex:/E\d{6}/']
        ]);

        //Return the appropriate response
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            //Retrieve all reservation records that are cancelled by donor
            $resvs = Reservation::where('eventID', '=', $request['eventID'])->paginate(10);

            if (count($resvs) === 0)
                return redirect()->back()->with('emptyResv', true);
            else
                return view('staff.reports.transactionReport')->with('resvs', $resvs);
        }
    }

    public function transactionReportPrint($id) {
        $data = [
            'resvs' => Reservation::where('eventID', '=', $id)->get()
        ];
        $pdf = PDF::loadView('staff.reports.transactionReportPrint', $data);
        return $pdf->stream('Event ('. $id . ') Reservation List Report.pdf');
    }


}
