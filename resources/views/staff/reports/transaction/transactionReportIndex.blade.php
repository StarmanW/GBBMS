@extends('staff.layout.baseTemplate-HR')

@section('title')
    <title>Transaction Report</title>
@endsection

@section('additionalCSS')
    <link rel="stylesheet" href="/assets/datatables/data-tables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="/assets/additional/css/table-list.css" type="text/css">
    <link rel="stylesheet" href="/assets/additional/css/sidebar.css" type="text/css">
    <link rel="stylesheet" href="/assets/additional/css/registerForm.css" type="text/css">
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

    <!-- Sidebar overlay -->
    <div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

    <!-- Page Content -->
    <div class="w3-container">
        <section class="section-table cid-qMsKT09Rch" id="table1-1q">
            <a onclick="w3_open()">
                <i class="fa  fa-angle-up fa-4x" id="sidebar-toggle" aria-hidden="true"></i>
            </a>
            <div class="form-container container align-center" style="width:50%">
                <h2 class="well">Transaction Report <br/> (Reservation List) <br/><br/> Select an Event</h2>
                <hr style="border-top:1px solid gray;" />
                <div class="col-lg-12 well">
                    <div class="row">
                        <form method="POST" action="/staff/hr/report/transaction">
                            {{ csrf_field() }}
                            <p style="color:red; float: left;">"*" Required fields</p>
                            <br />
                            <br />
                            <div class="col-sm-12">
                                @if($errors->has('eventID'))
                                    <span style="color:red;">Please select an appropriate event</span>
                                @elseif(session('emptyResv') === true)
                                    <span style="color:red;">The selected event does not have any reservation made yet.</span>
                                @endif
                                <div class="row">
                                    <label><span style="color:red;">*</span>Event</label>
                                    <select name="eventID" class="form-control" required="required">
                                        <option disabled selected value>Select an event</option>
                                        @foreach($events as $event)
                                            <option value="{{$event->eventID}}">{{$event->eventID}} - {{html_entity_decode($event->eventName, ENT_QUOTES, 'UTF-8')}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br />
                            <div class="submit-button">
                                <button type="submit" class="btn btn-lg btn-success form-btn">View Report</button>
                                <button type="reset" class="btn btn-lg btn-primary form-btn">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('additionalJS')
    <script src="/assets/datatables/jquery.data-tables.min.js"></script>
    <script src="/assets/datatables/data-tables.bootstrap4.min.js"></script>
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
