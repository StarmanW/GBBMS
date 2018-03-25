<!DOCTYPE html>
<html>

@extends('baseTemplates')

@section('title')
    <title>Reservation List</title>
@endsection

@section('additionalCSS')
    <link rel="stylesheet" href={{"assets/datatables/data-tables.bootstrap4.min.css"}}>
    <link rel="stylesheet" href={{"assets/additional/css/table-list.css"}} type="text/css">
    <link rel="stylesheet" href={{"assets/additional/css/sidebar.css"}} type="text/css">
@endsection

@section('contents')
    <section class="section-table cid-qEBSaDdCCZ" id="table1-t" data-rv-view="1214">
        <div class="container container-table">
            <h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-2">Your Reservation History</h2>
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
                                <th class="head-item mbr-fonts-style display-7">Reservation ID</th>
                                <th class="head-item mbr-fonts-style display-7">Event Name</th>
                                <th class="head-item mbr-fonts-style display-7">Event Date</th>
                                <th class="head-item mbr-fonts-style display-7">Event Time</th>
                                <th class="head-item mbr-fonts-style display-7">Reservation Status</th>
                                <th class="head-item mbr-fonts-style display-7"></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td class="body-item mbr-fonts-style display-7">R180245</td>
                                <td class="body-item mbr-fonts-style display-7">KK Charity Blood Drive April 2018</td>
                                <td class="body-item mbr-fonts-style display-7">23-Apr-2018</td>
                                <td class="body-item mbr-fonts-style display-7">10.00 AM to 4.00 PM</td>
                                <td class="body-item mbr-fonts-style display-7">Reserved</td>
                                <td class="body-item mbr-fonts-style display-7">
                                    <a href="./resv-details.html">
                                        <i class="fa fa-bars" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="body-item mbr-fonts-style display-7">R182457</td>
                                <td class="body-item mbr-fonts-style display-7">TARCIAN Blood Drive September 2018</td>
                                <td class="body-item mbr-fonts-style display-7">11-Sep-2018</td>
                                <td class="body-item mbr-fonts-style display-7">10.00 AM to 4.00 PM</td>
                                <td class="body-item mbr-fonts-style display-7">Reserved</td>
                                <td class="body-item mbr-fonts-style display-7">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="body-item mbr-fonts-style display-7">R182453</td>
                                <td class="body-item mbr-fonts-style display-7">TARCIAN Blood Drive May 2019</td>
                                <td class="body-item mbr-fonts-style display-7">28-May-2019</td>
                                <td class="body-item mbr-fonts-style display-7">10.00 AM to 4.00 PM</td>
                                <td class="body-item mbr-fonts-style display-7">Reserved</td>
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
    <script src={{"assets/datatables/jquery.data-tables.min.js"}}></script>
    <script src={{"assets/datatables/data-tables.bootstrap4.min.js"}}></script>
@endsection