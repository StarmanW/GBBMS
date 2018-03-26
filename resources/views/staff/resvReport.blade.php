@extends('staff.layout.baseTemplate-HR')

@section('title')
    <title>Reservation Report</title>
@endsection

@section('additionalCSS')
    <link rel="stylesheet" href="assets/datatables/data-tables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="assets/additional/css/dashboard.css" type="text/css">
    <link rel="stylesheet" href="assets/additional/css/resv-list.css" type="text/css">
    <link rel="stylesheet" href="assets/additional/css/resv-report.css" type="text/css">
    <link rel="stylesheet" href="assets/additional/css/sidebar.css" type="text/css">
@endsection

@section('contents')
    <!-- Sidebar -->
    <div class="w3-sidebar w3-bar-block w3-animate-left" style="display:none;z-index:5" id="mySidebar">
        <br><br><br><br>
        <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>
        <br>
            
        <span style="text-align: center; color: white" class="w3-bar-item">View Reports</span>
        <hr id="sideBarHR">

        <a href="./annualReport.html" class="w3-bar-item w3-button">Annual Report</a>
        <a href="./monthlyReport.html" class="w3-bar-item w3-button">Monthly Report</a>
        <a href="./exceptReport.html" class="w3-bar-item w3-button">Reservation Cancellation Report</a>
        <a href="./resvReport.html" class="w3-bar-item w3-button">Reservation List</a>
    </div>

    <!-- Page Content -->
    <div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

    <div class="w3-container">
        <section class="section-table cid-qMsKT09Rch" id="table1-1q">
            <a onclick="w3_open()">
                <i class="fa  fa-angle-up fa-3x" id="sidebar-toggle" aria-hidden="true"></i>
            </a>

            <div class="container align-center">
                <div class="card" id="cardHeader" style="margin:0">
                    <div class="card-header main-color-bg">
                        <h3 class="card-title">Reservation Report</h3>
                        
                    </div>
                    <section class="section-table cid-qEBSaDdCCZ" id="table1-t" data-rv-view="1214">
                            <div class="container container-table">
                                <div class="table-wrapper">
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
                                                    <th class="head-item mbr-fonts-style display-7">No.</th>
                                                    <th class="head-item mbr-fonts-style display-7">Event ID</th>
                                                    <th class="head-item mbr-fonts-style display-7">Event Name</th>
                                                    <th class="head-item mbr-fonts-style display-7">Event Date</th>
                                                    <th class="head-item mbr-fonts-style display-7">Event Time</th>
                                                    <th class="head-item mbr-fonts-style display-7">Reservation ID</th>
                                                    <th class="head-item mbr-fonts-style display-7">Donor Name</th>
                                                    <th class="head-item mbr-fonts-style display-7">Donor ID</th>
                                                    <th class="head-item mbr-fonts-style display-7">Blood Type</th>
                                            </thead>
                    
                                            <tbody>
                                                <tr>
                                                    <td class="body-item mbr-fonts-style display-7">1</td>
                                                    <td class="body-item mbr-fonts-style display-7">E180124</td>
                                                    <td class="body-item mbr-fonts-style display-7">KK Charity Blood Drive April 2018</td>
                                                    <td class="body-item mbr-fonts-style display-7">23-Apr-2018</td>
                                                    <td class="body-item mbr-fonts-style display-7">10.00 AM to 4.00 PM</td>
                                                    <td class="body-item mbr-fonts-style display-7">R180245</td>
                                                    <td class="body-item mbr-fonts-style display-7">D170001</td>
                                                    <td class="body-item mbr-fonts-style display-7">Samuel Wong Kim Foong</td>
                                                    <td class="body-item mbr-fonts-style display-7">O Positive</td>
                                                </tr>
                                                <tr>
                                                    <td class="body-item mbr-fonts-style display-7">2</td>
                                                    <td class="body-item mbr-fonts-style display-7">E180124</td>
                                                    <td class="body-item mbr-fonts-style display-7">KK Charity Blood Drive April 2018</td>
                                                    <td class="body-item mbr-fonts-style display-7">23-Apr-2018</td>
                                                    <td class="body-item mbr-fonts-style display-7">10.00 AM to 4.00 PM</td>
                                                    <td class="body-item mbr-fonts-style display-7">R180245</td>
                                                    <td class="body-item mbr-fonts-style display-7">D170002</td>
                                                    <td class="body-item mbr-fonts-style display-7">Shrilina Koo Yung Ja</td>
                                                    <td class="body-item mbr-fonts-style display-7">A Negative</td>
                                                </tr>
                                                <tr>
                                                    <td class="body-item mbr-fonts-style display-7">3</td>
                                                    <td class="body-item mbr-fonts-style display-7">E180124</td>
                                                    <td class="body-item mbr-fonts-style display-7">KK Charity Blood Drive April 2018</td>
                                                    <td class="body-item mbr-fonts-style display-7">23-Apr-2018</td>
                                                    <td class="body-item mbr-fonts-style display-7">10.00 AM to 4.00 PM</td>
                                                    <td class="body-item mbr-fonts-style display-7">R180245</td>
                                                    <td class="body-item mbr-fonts-style display-7">D170004</td>
                                                    <td class="body-item mbr-fonts-style display-7">Zion Tseu</td>
                                                    <td class="body-item mbr-fonts-style display-7">AB Positive</td>
                                                </tr>
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
                        </section>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('additionalJS')
    <script src="assets/datatables/jquery.data-tables.min.js"></script>
    <script src="assets/datatables/data-tables.bootstrap4.min.js"></script>
    <script src="assets/additional/js/canvasjs.js"></script>
    <script src="assets/additional/js/reportGraphAnnual.js"></script>

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
