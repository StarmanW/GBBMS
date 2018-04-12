<?php

namespace App\Http\Controllers;

use App\Staff;
use PDF;
use Illuminate\Http\Request;

class TestReport extends Controller {

    public function generate_pdf() {
        $staffs = Staff::all();
        $pdf = PDF::loadView('staff.testReport', $staffs);
        return $pdf->stream('staffListReport.pdf');
    }
}