@extends('staff.layout.baseTemplate-HR')

@section('title')
    <title>Staff List</title>
@endsection

@section('additionalCSS')
    <link rel="stylesheet" href="/assets/datatables/data-tables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="/assets/additional/css/table-list.css" type="text/css">
    <link rel="stylesheet" href="/assets/additional/css/sidebar.css" type="text/css">
@endsection

@section('contents')
    <!-- Sidebar -->
    <div class="w3-sidebar w3-bar-block w3-animate-left" style="display:none;z-index:5" id="mySidebar">
        <a href="/staff/hr/home" class="w3-bar-item" id="homepageStyle">
            <img src="assets/images/gLogo.png" alt="Gleneagles Logo" title="" style="height: 5rem;"> Gleneagles KK
        </a>
        <span style="text-align: center; color: white" class="w3-bar-item">View List</span>
        <hr id="sideBarHR">
        <a href="/staff/hr/list/donor" class="w3-bar-item w3-button">Donor List</a>
        <a href="/staff/hr/list/staff" class="w3-bar-item w3-button">Staff List</a>
        <a href="/staff/hr/list/event" class="w3-bar-item w3-button">Event List</a>
        <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>
    </div>

    <!-- Page Content -->
    <div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

    <!-- Page Content -->
    <div class="w3-container">
        <section class="section-table cid-qMsKT09Rch" id="table1-1q">
            <a onclick="w3_open()">
                <i class="fa  fa-angle-up fa-3x" id="sidebar-toggle" aria-hidden="true"></i>
            </a>
            <div class="container container-table">
                <h3 class="mbr-section-subtitle mbr-fonts-style align-center pb-5 mbr-light display-5"></h3>
                <div class="table-backpanel">
                    <div class="table-wrapper">
                        <h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-2">Staff List</h2>
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
                                <tr class="table-heads ">
                                    <th class="head-item mbr-fonts-style display-7">Staff ID</th>
                                    <th class="head-item mbr-fonts-style display-7">Staff Name</th>
                                    <th class="head-item mbr-fonts-style display-7">Gender</th>
                                    <th class="head-item mbr-fonts-style display-7">Position</th>
                                    <th class="head-item mbr-fonts-style display-7">Email Address</th>
                                    <th class="head-item mbr-fonts-style display-7">Phone Number</th>
                                    <th class="head-item mbr-fonts-style display-7">Account Status</th>
                                    <th class="head-item mbr-fonts-style display-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($staffs as $staff)
                                    <tr>
                                        <td class="body-item mbr-fonts-style display-7">{{$staff->staffID}}</td>
                                        <td class="body-item mbr-fonts-style display-7">{{$staff->firstName}} {{$staff->lastName}}</td>
                                        <td class="body-item mbr-fonts-style display-7">{{$staff->getGender()}}</td>
                                        <td class="body-item mbr-fonts-style display-7">{{$staff->getStaffPosition()}}</td>
                                        <td class="body-item mbr-fonts-style display-7">{{$staff->emailAddress}}</td>
                                        <td class="body-item mbr-fonts-style display-7">{{$staff->phoneNum}}</td>
                                        <td class="body-item mbr-fonts-style display-7">{{$staff->getAccStatus()}}</td>
                                        <td class="body-item mbr-fonts-style display-7">
                                            <a href="/staff/hr/list/staff/{{$staff->staffID}}">
                                                <i class="fa fa-bars" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
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
