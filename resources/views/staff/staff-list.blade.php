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
        <a href="./homepage-hr.html" class="w3-bar-item" id="homepageStyle">
            <img src="/assets/images/gLogo.png" alt="Gleneagles Logo" title="" style="height: 5rem;"> Gleneagles KK
        </a>
        <span style="text-align: center; color: white" class="w3-bar-item">View List</span>
        <hr id="sideBarHR">
        <a href="./donor-list.html" class="w3-bar-item w3-button">Donor List</a>
        <a href="./staff-list.html" class="w3-bar-item w3-button">Staff List</a>
        <a href="./event-list.html" class="w3-bar-item w3-button">Event List</a>
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
                <h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-2">Staff List</h2>
                <h3 class="mbr-section-subtitle mbr-fonts-style align-center pb-5 mbr-light display-5"></h3>
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
                                    <th class="head-item mbr-fonts-style display-7">Staff ID</th>
                                    <th class="head-item mbr-fonts-style display-7">Staff Name</th>
                                    <th class="head-item mbr-fonts-style display-7">Position</th>
                                    <th class="head-item mbr-fonts-style display-7">Email Address</th>
                                    <th class="head-item mbr-fonts-style display-7">Phone Number</th>
                                    <th class="head-item mbr-fonts-style display-7">Account Status</th>
                                    <th class="head-item mbr-fonts-style display-7"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td class="body-item mbr-fonts-style display-7">SH15001</td>
                                    <td class="body-item mbr-fonts-style display-7">Zion Tseu</td>
                                    <td class="body-item mbr-fonts-style display-7">HR Manager</td>
                                    <td class="body-item mbr-fonts-style display-7">zions-sh15@gmail.com</td>
                                    <td class="body-item mbr-fonts-style display-7">019-553-5413</td>
                                    <td class="body-item mbr-fonts-style display-7">Activated</td>
                                    <td class="body-item mbr-fonts-style display-7">
                                        <a href="./staff-profile.html">
                                            <i class="fa fa-bars" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="body-item mbr-fonts-style display-7">SN16002</td>
                                    <td class="body-item mbr-fonts-style display-7">Samuel Wong Kim Foong</td>
                                    <td class="body-item mbr-fonts-style display-7">Nurse</td>
                                    <td class="body-item mbr-fonts-style display-7">samuelwkf-sn16@gmail.com</td>
                                    <td class="body-item mbr-fonts-style display-7">012-446-5856</td>
                                    <td class="body-item mbr-fonts-style display-7">Activated</td>
                                    <td class="body-item mbr-fonts-style display-7">
                                        <i class="fa fa-bars" aria-hidden="true"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="body-item mbr-fonts-style display-7">SN17001</td>
                                    <td class="body-item mbr-fonts-style display-7">Chong Jia Herng</td>
                                    <td class="body-item mbr-fonts-style display-7">Nurse</td>
                                    <td class="body-item mbr-fonts-style display-7">chongjh-sn17@gmail.com</td>
                                    <td class="body-item mbr-fonts-style display-7">013-124-9875</td>
                                    <td class="body-item mbr-fonts-style display-7">Activated</td>
                                    <td class="body-item mbr-fonts-style display-7">
                                        <i class="fa fa-bars" aria-hidden="true"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="body-item mbr-fonts-style display-7">SN18030</td>
                                    <td class="body-item mbr-fonts-style display-7">Enjiun Tan</td>
                                    <td class="body-item mbr-fonts-style display-7">Nurse</td>
                                    <td class="body-item mbr-fonts-style display-7">enjiuntej-sn18@gmail.com</td>
                                    <td class="body-item mbr-fonts-style display-7">019-542-1123</td>
                                    <td class="body-item mbr-fonts-style display-7">Activated</td>
                                    <td class="body-item mbr-fonts-style display-7">
                                        <i class="fa fa-bars" aria-hidden="true"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="body-item mbr-fonts-style display-7">SN17035</td>
                                    <td class="body-item mbr-fonts-style display-7">Teo Kien Lung</td>
                                    <td class="body-item mbr-fonts-style display-7">Nurse</td>
                                    <td class="body-item mbr-fonts-style display-7">teokl-sn17@gmail.com</td>
                                    <td class="body-item mbr-fonts-style display-7">016-856-4231</td>
                                    <td class="body-item mbr-fonts-style display-7">Deactivated</td>
                                    <td class="body-item mbr-fonts-style display-7">
                                        <i class="fa fa-bars" aria-hidden="true"></i>
                                    </td>
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
