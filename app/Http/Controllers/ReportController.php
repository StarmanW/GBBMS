<?php

namespace App\Http\Controllers;

use App\Blood;
use App\Donor;
use App\Event;
use App\Reservation;
use App\Staff;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use PDF;
use Illuminate\Http\Request;

class ReportController extends Controller {

    //Function to display dashboard data
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
    //Function to show exception report index
    public function exceptionReportIndex() {
        $events = Event::all();
        return view('staff.reports.exception.exceptionReportIndex')->with('events', $events);
    }

    //Function to process exception report form
    public function exceptionReportProcessForm(Request $request) {
        //Validate event ID
        $validator = Validator::make($request->all(), [
            'eventID' => ['required', 'regex:/E\d{6}/']
        ]);

        //Return the appropriate response
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            return Redirect::to('/staff/hr/report/exception/' . $request['eventID']);
        }
    }

    //Function to display exception report on web
    public function exceptionReport($id) {
        //Retrieve all reservation records that are cancelled by donor
        $resvs = Reservation::where('resvStatus', '=', 3)->where('eventID', '=', $id)->paginate(10);

        if (count($resvs) === 0)
            return redirect()->back()->with('emptyResv', true);
        else
            return view('staff.reports.exception.exceptionReport')->with('resvs', $resvs);
    }

    //Function to generate printable exception report
    public function exceptionReportPrint($id) {
        $data = [
            'resvs' => Reservation::where('resvStatus', '=', 3)->where('eventID', '=', $id)->get()
        ];
        $pdf = PDF::loadView('staff.reports.exception.exceptionReportPrint', $data);
        return $pdf->stream('Event (' . $id . ') Reservation Cancellation Report.pdf');
    }

    /***** Transaction Report - Reservation list for each events *****/
    //Function to show transaction report index
    public function transactionReportIndex() {
        $events = Event::all();
        return view('staff.reports.transaction.transactionReportIndex')->with('events', $events);
    }

    //Function to process transaction report form
    public function transactionReportProcessForm(Request $request) {
        //Validate event ID
        $validator = Validator::make($request->all(), [
            'eventID' => ['required', 'regex:/E\d{6}/']
        ]);

        //Return the appropriate response
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            return Redirect::to('/staff/hr/report/transaction/' . $request['eventID']);
        }
    }

    //Function to display transaction report on web
    public function transactionReport($id) {
        //Retrieve all reservation records that are cancelled by donor
        $resvs = Reservation::where('eventID', '=', $id)->paginate(10);

        if (count($resvs) === 0)
            return redirect()->back()->with('emptyResv', true);
        else
            return view('staff.reports.transaction.transactionReport')->with('resvs', $resvs);
    }

    //Function to generate printable transaction report
    public function transactionReportPrint($id) {
        $data = [
            'resvs' => Reservation::where('eventID', '=', $id)->get()
        ];
        $pdf = PDF::loadView('staff.reports.transaction.transactionReportPrint', $data);
        return $pdf->stream('Event (' . $id . ') Reservation Report.pdf');
    }

    /***** Summary Report - Reservation list for each events *****/
    //Function to show transaction report index
    public function summaryReportIndex() {
        $eventTimeline = Event::orderBy('created_at', 'ASC')->get();
        return view('staff.reports.summary.annualReportIndex')->with('eventTimeline', date_format(date_create($eventTimeline[0]->created_at), "Y"));
    }

    //Function to process summary report form
    public function summaryReportProcessForm(Request $request) {
        //Validate input
        $validator = Validator::make($request->all(), [
            'year' => ['required', 'date_format:"Y"'],
            'report' => ['required', 'regex:/^(resvList|blood)$/'],
        ]);

        //Return the appropriate response
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            return Redirect::to('/staff/hr/report/summary/' . $request['year'] . '/' . $request['report']);
        }
    }

    //Function to display transaction report on web
    public function summaryReport($year, $rType) {
        switch ($rType) {
            case "resvList":
                $records = Event::whereYear('eventDate', '=', $year)->paginate(10);
                session(['rType' => 'resvList']);
                break;
            case "blood":
                $records = Event::whereYear('eventDate', '=', $year)->paginate(10);
                session(['rType' => 'blood']);
                break;
        }

        //Verify records variable is 0 or not, else return the result
        if (count($records) === 0)
            return redirect('/staff/hr/report/summary')->with('emptyRecord', true);
        else
            return view('staff.reports.summary.annualReport')->with('records', $records);
    }


    //Function to display transaction report on web
    public function summaryReportPrint($year, $rType) {
        switch ($rType) {
            case "resvList":
                $data = [
                    'records' => Event::whereYear('eventDate', '=', $year)->get()
                ];
                session(['rType' => 'resvList']);
                $pdf = PDF::loadView('staff.reports.summary.annualReportPrint', $data);
                return $pdf->stream($year . ' Reservation Report.pdf');
                break;
            case "blood":
                $data = [
                    'records' => Event::whereYear('eventDate', '=', $year)->get()
                ];
                session(['rType' => 'blood']);
                $pdf = PDF::loadView('staff.reports.summary.annualReportPrint', $data);
                return $pdf->stream($year . ' Donated Bloods Report.pdf');
                break;
        }
    }
}
