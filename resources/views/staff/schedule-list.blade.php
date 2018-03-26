@extends('staff.layout.baseTemplate-Nurse')

@section('title')
    <title>Schedule List</title>
@endsection

@section('additionalCSS')
    <link rel="stylesheet" href="/assets/datatables/data-tables.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/additional/css/table-list.css" type="text/css">
@endsection

@section('contents')
    <section class="section-table cid-qMsKXLSbve" id="table1-1r">
        <div class="container container-table">
            <h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-2">Schedule List</h2>
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
                                <th class="head-item mbr-fonts-style display-7">Event ID</th>
                                <th class="head-item mbr-fonts-style display-7">Event Name</th>
                                <th class="head-item mbr-fonts-style display-7">Date</th>
                                <th class="head-item mbr-fonts-style display-7">Time</th>
                                <th class="head-item mbr-fonts-style display-7">Event Status</th>
                                <th class="head-item mbr-fonts-style display-7"></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td class="body-item mbr-fonts-style display-7">E180124</td>
                                <td class="body-item mbr-fonts-style display-7">Kota Kinabalu Charity Blood Drive May 2018</td>
                                <td class="body-item mbr-fonts-style display-7">12-May-2018</td>
                                <td class="body-item mbr-fonts-style display-7">10.30 AM to 4.00 PM</td>
                                <td class="body-item mbr-fonts-style display-7">Upcoming</td>
                                <td class="body-item mbr-fonts-style display-7">
                                    <a href="./schedule-details.html"><i class="fa fa-bars" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="body-item mbr-fonts-style display-7">E181285</td>
                                <td class="body-item mbr-fonts-style display-7">Blood Week June 2018</td>
                                <td class="body-item mbr-fonts-style display-7">20-Jun-2018</td>
                                <td class="body-item mbr-fonts-style display-7">11.00 Am to 5.00 PM</td>
                                <td class="body-item mbr-fonts-style display-7">Cancelled</td>
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
@endsection

@section('additionalJS')
    <script src="/assets/datatables/jquery.data-tables.min.js"></script>
    <script src="/assets/datatables/data-tables.bootstrap4.min.js"></script>
@endsection
