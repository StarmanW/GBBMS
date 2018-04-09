<?php

namespace App\Http\Controllers;

use App\Blood;
use App\Donor;
use App\Event;
use App\Staff;
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
        $totalBlood = array(0,0,0,0,0,0,0,0);
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
}
