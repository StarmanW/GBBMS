@extends('staff.layout.baseTemplate-Nurse')

@section('title')
    <title>Home - Nurse</title>
@endsection

@section('additionalCSS')
    <link rel="stylesheet" href="/assets/additional/css/hover-image.css" type="text/css">
    <link rel="stylesheet" href="/assets/additional/css/homepage.css" type="text/css">
    <link rel="stylesheet" href="/assets/additional/css/homepage-nurse.css" type="text/css">
@endsection

@section('contents')
    <section class="features13 cid-qMsLYhctpH" id="features13-1y">
        <div class="mbr-overlay" style="opacity: 0.2; background-color:#adadad;"></div>
        <div class="container">
            <h2 class="mbr-section-title pb-3 mbr-fonts-style display-1">Welcome, Chong</h2>

            <div class="media-container-row container">
                <div class="card col-12 col-md-6 p-5 m-3 align-center col-lg-4 card-text hover-image"
                     onclick="window.location='./schedule-list.html';">
                    <div class="card-img">
                        <i class="fa fa-calendar-alt fa-5x" id="fa-card-icon-1" aria-hidden="true"></i>
                    </div>
                    <h4 class="card-title py-2 mbr-fonts-style display-2">Upcoming Schedules</h4>
                    <p class="mbr-text mbr-fonts-style display-7"></p>
                </div>
                <div class="card col-12 col-md-6 p-5 m-3 align-center col-lg-4 card-text hover-image"
                     onclick="window.location='./blood-management.html';">
                    <div class="card-img">
                        <i class="fa fa-tint fa-5x" id="fa-card-icon-2" aria-hidden="true"></i>
                    </div>
                    <h4 class="card-title py-2 mbr-fonts-style display-2 card-text-2">Manage
                        <br/>Blood Donation</h4>
                    <p class="mbr-text mbr-fonts-style display-7"></p>
                </div>
                <div class="card col-12 col-md-6 p-5 m-3 align-center col-lg-4 card-text hover-image"
                     onclick="window.location='./staff-profile-nurse.html';">
                    <div class="card-img">
                        <i class="fa fa-address-book fa-5x" id="fa-card-icon-3" aria-hidden="true"></i>
                    </div>
                    <h4 class="card-title py-2 mbr-fonts-style display-2">User
                        <br/>Profile</h4>
                    <p class="mbr-text mbr-fonts-style display-7"></p>
                </div>

            </div>
        </div>
    </section>

    <section class="timeline1 cid-qMsMnVLzFg" id="timeline1-22">
        <div class="mbr-overlay" style="opacity: 0.3; background-color: black;"></div>
        <div class="container align-center">
            <h2 class="mbr-section-title pb-3 mbr-fonts-style display-2">Upcoming Activities</h2>
            <h3 class="mbr-section-subtitle pb-5 mbr-fonts-style display-5"></h3>
            <div class="container timelines-container" mbri-timelines="">
                <div class="row timeline-element reverse separline">
                    <div class="timeline-date-panel col-xs-12 col-md-6  align-left">
                        <div class="time-line-date-content">
                            <p class="mbr-timeline-date mbr-fonts-style display-5">2 May 2018</p>
                        </div>
                    </div>
                    <span class="iconBackground"></span>
                    <div class="col-xs-12 col-md-6 align-right">
                        <div class="timeline-text-content">
                            <h4 class="mbr-timeline-title pb-3 mbr-fonts-style display-5">Kota Kinabalu Charity Blood
                                Drive May 2018</h4>
                            <table class="activity-table">
                                <tbody>
                                <tr>
                                    <td>
                                        <p class="mbr-timeline-text mbr-fonts-style display-7">Room&nbsp;&nbsp;:&nbsp;&nbsp;</p>
                                    </td>
                                    <td>
                                        <p class="mbr-timeline-text mbr-fonts-style display-7">031012, Quadrant 1, 3rd
                                            floor, Gleneagles Hospital KK</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="mbr-timeline-text mbr-fonts-style display-7">Date&emsp;:</p>
                                    </td>
                                    <td>
                                        <p class="mbr-timeline-text mbr-fonts-style display-7">12 May 2018</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="mbr-timeline-text mbr-fonts-style display-7">Time&emsp;:</p>
                                    </td>
                                    <td>
                                        <p class="mbr-timeline-text mbr-fonts-style display-7">10.30 AM to 4.00 PM</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row timeline-element  separline">
                    <div class="timeline-date-panel col-xs-12 col-md-6 align-right">
                        <div class="time-line-date-content">
                            <p class="mbr-timeline-date mbr-fonts-style display-5">1 June 2018</p>
                        </div>
                    </div>
                    <span class="iconBackground"></span>
                    <div class="col-xs-12 col-md-6 align-left ">
                        <div class="timeline-text-content">
                            <h4 class="mbr-timeline-title pb-3 mbr-fonts-style display-5">Blood Week June 2018</h4>
                            <table class="activity-table">
                                <tbody>
                                <tr>
                                    <td>
                                        <p class="mbr-timeline-text mbr-fonts-style display-7">Room&nbsp;&nbsp;:&nbsp;&nbsp;</p>
                                    </td>
                                    <td>
                                        <p class="mbr-timeline-text mbr-fonts-style display-7">031012, Quadrant 1, 3rd
                                            floor, Gleneagles Hospital KK</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="mbr-timeline-text mbr-fonts-style display-7">Date&emsp;:</p>
                                    </td>
                                    <td>
                                        <p class="mbr-timeline-text mbr-fonts-style display-7">12 May 2018</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="mbr-timeline-text mbr-fonts-style display-7">Time&emsp;:</p>
                                    </td>
                                    <td>
                                        <p class="mbr-timeline-text mbr-fonts-style display-7">10.30 AM to 4.00 PM</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="row timeline-element reverse">
                    <div class="timeline-date-panel col-xs-12 col-md-6  align-left">
                        <div class="time-line-date-content">
                            <p class="mbr-timeline-date mbr-fonts-style display-5">12 October 2018</p>
                        </div>
                    </div>
                    <span class="iconBackground"></span>
                    <div class="col-xs-12 col-md-6 align-right">
                        <div class="timeline-text-content">
                            <h4 class="mbr-timeline-title pb-3 mbr-fonts-style display-5">Kota Kinabalu Charity Blood
                                Drive October 2018</h4>
                            <table class="activity-table">
                                <tbody>
                                <tr>
                                    <td>
                                        <p class="mbr-timeline-text mbr-fonts-style display-7">Room&nbsp;&nbsp;:&nbsp;&nbsp;</p>
                                    </td>
                                    <td>
                                        <p class="mbr-timeline-text mbr-fonts-style display-7">031012, Quadrant 1, 3rd
                                            floor, Gleneagles Hospital KK</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="mbr-timeline-text mbr-fonts-style display-7">Date&emsp;:</p>
                                    </td>
                                    <td>
                                        <p class="mbr-timeline-text mbr-fonts-style display-7">12 May 2018</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="mbr-timeline-text mbr-fonts-style display-7">Time&emsp;:</p>
                                    </td>
                                    <td>
                                        <p class="mbr-timeline-text mbr-fonts-style display-7">10.30 AM to 4.00 PM</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
