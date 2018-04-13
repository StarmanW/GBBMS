@extends('staff.layout.baseTemplate-HR')

@section('title')
    @if(session('rType') === "resvList")
        <title>Summary Report - {{date_format(date_create($records[0]->eventDate), "Y")}} Reservation Report</title>
    @elseif(session('rType') === "blood")
        <title>Summary Report - {{date_format(date_create($records[0]->eventDate), "Y")}} Donated Bloods Report</title>
    @endif
@endsection

@section('additionalCSS')
    <link rel="stylesheet" href={{"/assets/datatables/data-tables.bootstrap4.min.css"}}>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href={{"/assets/additional/css/table-list.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/additional/css/sidebar.css"}} type="text/css">
@endsection

@section('contents')
    <!-- Sidebar -->
    <div class="w3-sidebar w3-bar-block w3-animate-left" style="display:none;z-index:5" id="mySidebar">
        <br><br><br><br>
        <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close <span style="float: right;">&times;</span></button>
        <br>

        <span style="text-align: center; color: white" class="w3-bar-item">View Reports</span>
        <hr id="sideBarHR">

        <a href="/staff/hr/report/summary" class="w3-bar-item w3-button">Summary Report <i class="fa fa-list" style="float: right;" aria-hidden="true"></i></a>
        <a href="/staff/hr/report/exception" class="w3-bar-item w3-button">Reservation Cancellation Report <i class="fa fa-calendar-times" style="float: right;" aria-hidden="true"></i></a>
        <a href="/staff/hr/report/transaction" class="w3-bar-item w3-button">Reservation List <i class="fa fa-calendar-check" style="float: right;" aria-hidden="true"></i></a>
    </div>

    <!-- Page Content -->
    <div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

    <!-- Page Content -->
    <div class="w3-container">
        <section class="section-table cid-qMsKT09Rch" id="table1-1q">
            <a onclick="w3_open()">
                <i class="fa  fa-angle-up fa-4x" id="sidebar-toggle" aria-hidden="true"></i>
            </a>
            <div class="container container-table">
                <h3 class="mbr-section-subtitle mbr-fonts-style align-center pb-5 mbr-light display-5"></h3>
                <div class="table-backpanel">
                    <div class="table-wrapper">
                        @if(session('rType') === "resvList")
                            <h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-2">{{date_format(date_create($records[0]->eventDate), "Y")}} Reservation Report</h2>
                        @elseif(session('rType') === "blood")
                            <h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-2">{{date_format(date_create($records[0]->eventDate), "Y")}} Donated Bloods Report</h2>
                        @endif
                        <h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-2">
                            <span style="text-align: center"><a href="./summary/{{date_format(date_create($records[0]->eventDate), "Y")}}/{{session('rType')}}/print" target="_blank"><button type="button" class="btn btn-sm btn-primary">Print Report</button></a></span>
                            <span style="text-align: center"><a href="./summary"><button type="button" class="btn btn-sm btn-primary">Back to Search</button></a></span>
                        </h2>
                        <div class="container">
                            <div class="row search">
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <div class="dataTables_filter">
                                        <label class="searchInfo mbr-fonts-style display-7">Search:</label>
                                        <input class="form-control input-sm" disabled="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container scroll">
                            <table class="table isSearch" cellspacing="0">
                                <thead>
                                @if(session('rType') === "resvList")
                                    <tr class="table-heads ">
                                        <th class="head-item mbr-fonts-style display-7">Event ID</th>
                                        <th class="head-item mbr-fonts-style display-7">Event Name</th>
                                        <th class="head-item mbr-fonts-style display-7">Event Date</th>
                                        <th class="head-item mbr-fonts-style display-7">Event Time</th>
                                        <th class="head-item mbr-fonts-style display-7">Event Room</th>
                                        <th class="head-item mbr-fonts-style display-7">Total Reservations Made</th>
                                        <th class="head-item mbr-fonts-style display-7">Total Reservations Cancelled</th>
                                        <th class="head-item mbr-fonts-style display-7">Total Completed Reservations</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($records as $key => $event)
                                        <tr>
                                            <td class="body-item mbr-fonts-style display-7">{{$event->eventID}}</td>
                                            <td class="body-item mbr-fonts-style display-7">{{$event->eventName}}</td>
                                            <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($event->eventDate), "d-M-Y")}}</td>
                                            <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($event->eventStartTime), "h:i A")}} to {{date_format(date_create($event->eventEndTime), "h:i A")}}</td>
                                            <td class="body-item mbr-fonts-style display-7">Room {{substr($event->rooms->roomID, 3)}}, Quadrant {{$event->rooms->quadrant}}, Floor {{$event->rooms->floor}}</td>
                                            <td class="body-item mbr-fonts-style display-7">{{count($event->reservations)}}</td>
                                            <td class="body-item mbr-fonts-style display-7">{{count($event->reservations->where('resvStatus', 3))}}</td>
                                            <td class="body-item mbr-fonts-style display-7">{{count($event->reservations->where('resvStatus', 0))}}</td>
                                        </tr>
                                    @endforeach
                                @elseif(session('rType') === "blood")
                                    <tr class="table-heads ">
                                        <th class="head-item mbr-fonts-style display-7">Event ID</th>
                                        <th class="head-item mbr-fonts-style display-7">Event Name</th>
                                        <th class="head-item mbr-fonts-style display-7">Event Date</th>
                                        <th class="head-item mbr-fonts-style display-7">Event Time</th>
                                        <th class="head-item mbr-fonts-style display-7">Blood A+</th>
                                        <th class="head-item mbr-fonts-style display-7">Blood A-</th>
                                        <th class="head-item mbr-fonts-style display-7">Blood B+</th>
                                        <th class="head-item mbr-fonts-style display-7">Blood B-</th>
                                        <th class="head-item mbr-fonts-style display-7">Blood O+</th>
                                        <th class="head-item mbr-fonts-style display-7">Blood O-</th>
                                        <th class="head-item mbr-fonts-style display-7">Blood AB+</th>
                                        <th class="head-item mbr-fonts-style display-7">Blood AB-</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($records as $key => $blood)
                                        <tr>
                                            <td class="body-item mbr-fonts-style display-7">{{$blood->events->eventID}}</td>
                                            <td class="body-item mbr-fonts-style display-7">{{$blood->events->eventName}}</td>
                                            <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($blood->events->eventDate), "d-M-Y")}}</td>
                                            <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($blood->events->eventStartTime), "h:i A")}} to {{date_format(date_create($blood->events->eventEndTime), "h:i A")}}</td>
                                            <td class="body-item mbr-fonts-style display-7">{{count($blood->where('bloodType', '=', 1)->where('eventID', '=', $blood->events->eventID)->get())}} bag(s)</td>
                                            <td class="body-item mbr-fonts-style display-7">{{count($blood->where('bloodType', '=', 2)->where('eventID', '=', $blood->events->eventID)->get())}} bag(s)</td>
                                            <td class="body-item mbr-fonts-style display-7">{{count($blood->where('bloodType', '=', 3)->where('eventID', '=', $blood->events->eventID)->get())}} bag(s)</td>
                                            <td class="body-item mbr-fonts-style display-7">{{count($blood->where('bloodType', '=', 4)->where('eventID', '=', $blood->events->eventID)->get())}} bag(s)</td>
                                            <td class="body-item mbr-fonts-style display-7">{{count($blood->where('bloodType', '=', 5)->where('eventID', '=', $blood->events->eventID)->get())}} bag(s)</td>
                                            <td class="body-item mbr-fonts-style display-7">{{count($blood->where('bloodType', '=', 6)->where('eventID', '=', $blood->events->eventID)->get())}} bag(s)</td>
                                            <td class="body-item mbr-fonts-style display-7">{{count($blood->where('bloodType', '=', 7)->where('eventID', '=', $blood->events->eventID)->get())}} bag(s)</td>
                                            <td class="body-item mbr-fonts-style display-7">{{count($blood->where('bloodType', '=', 8)->where('eventID', '=', $blood->events->eventID)->get())}} bag(s)</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="container table-info-container">
                            <div class="row info">
                                <div class="col-md-6">
                                    <div class="dataTables_info mbr-fonts-style display-7">
                                        <span class="infoBefore">Showing</span>
                                        <span class="inactive infoRows"></span>
                                        <span class="infoAfter">entries</span>
                                        <span class="infoFilteredBefore">(filtered from</span>
                                        <span class="inactive infoRows"></span>
                                        <span class="infoFilteredAfter"> total entries)</span>
                                    </div>
                                </div>
                                <div class="col-md-6"></div>
                            </div>
                        </div>
                    </div>
                    <div class="container pagination" style="padding-bottom:2%;">
                        {{$records->links()}}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('additionalJS')
    <script src={{"/assets/datatables/jquery.data-tables.min.js"}}></script>
    <script src={{"/assets/datatables/data-tables.bootstrap4.min.js"}}></script>
    <script>
        //Menu Toggle Script
        function w3_open() {
            document.getElementById("mySidebar").style.display = "block";
            document.getElementById("myOverlay").style.display = "block";
        }

        function w3_close() {
            document.getElementById("mySidebar").style.display = "none";
            document.getElementById("myOverlay").style.display = "none";
        }
    </script>
@endsection
