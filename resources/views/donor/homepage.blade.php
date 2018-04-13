@extends('donor.layout.baseTemplate')


@section('title')<title>Home - Donor</title>@endsection

@section('additionalCSS')
    <link rel="stylesheet" href={{"/assets/additional/css/hover-image.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/additional/css/homepage.css"}} type="text/css">
@endsection

@section('contents')
    <section class="features13 cid-qMsMqKYHaC" id="features13-25">
        <div class="mbr-overlay" style="opacity: 0.2; background-color:#adadad;"></div>
        <div class="container">
            <h2 class="mbr-section-title pb-3 mbr-fonts-style display-1">Welcome, {{Auth::user()->firstName}}</h2>
            <div class="media-container-row container">
                <div class="card col-12 col-md-6 p-5 m-3 align-center col-lg-4 card-text hover-image" onclick="window.location='./upcoming-events';">
                    <div class="card-img">
                        <i class="fa fa-calendar-alt fa-5x" id="fa-card-icon-1" aria-hidden="true"></i>
                    </div>
                    <h4 class="card-title py-2 mbr-fonts-style display-2">Upcoming Events</h4>
                    <p class="mbr-text mbr-fonts-style display-7"></p>
                </div>
                <div class="card col-12 col-md-6 p-5 m-3 align-center col-lg-4 card-text hover-image" onclick="window.location='./reservation/current';">
                    <div class="card-img">
                        <i class="fa fa-calendar-check fa-5x" id="fa-card-icon-1" aria-hidden="true"></i>
                    </div>
                    <h4 class="card-title py-2 mbr-fonts-style display-2">Current<br>Reservation</h4>
                    <p class="mbr-text mbr-fonts-style display-7"></p>
                </div>
            </div>
            <div class="media-container-row container">
                <div class="card col-12 col-md-6 p-5 m-3 align-center col-lg-4 card-text hover-image" onclick="window.location='./reservation';">
                    <div class="card-img">
                        <i class="fa fa-file-alt fa-5x" id="fa-card-icon-3" aria-hidden="true"></i>
                    </div>
                    <h4 class="card-title py-2 mbr-fonts-style display-2">View<br/>Lists</h4>
                    <p class="mbr-text mbr-fonts-style display-7"></p>
                </div>
                <div class="card col-12 col-md-6 p-5 m-3 align-center col-lg-4 card-text hover-image" onclick="window.location='./profile';">
                    <div class="card-img">
                        <i class="fa fa-address-book fa-5x" id="fa-card-icon-4" aria-hidden="true"></i>
                    </div>
                    <h4 class="card-title py-2 mbr-fonts-style display-2">User<br/>Profile</h4>
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
                <?php $order = "" ?>
                @foreach ($eventList as $event)
                    <?php $order = ($order == "reverse") ? '' : 'reverse' ?>
                    <div class="row timeline-element {{$order}} separline">
                            <div class="timeline-date-panel col-xs-12 col-md-6 align-left">
                            <div class="time-line-date-content">
                                <p class="mbr-timeline-date mbr-fonts-style display-5">{{date_format(date_create($event->eventDate), "d-M-Y")}}</p>
                            </div>
                        </div>
                        <span class="iconBackground"></span>
                        <div class="col-xs-12 col-md-6 align-left">
                            <div class="timeline-text-content">
                                <h4 class="mbr-timeline-title pb-3 mbr-fonts-style display-5">{{$event->eventName}}</h4>
                                <table class="activity-table">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <p class="mbr-timeline-text mbr-fonts-style display-7">Room&nbsp;&nbsp;:&nbsp;&nbsp;</p>
                                        </td>
                                        <td>
                                            <?php $floor=$event->rooms->floor?>
                                            <p class="mbr-timeline-text mbr-fonts-style display-7">
                                                {{$event->roomID}},
                                                Quadrant {{$event->rooms->quadrant}},
                                                {{$floor}}
                                                    @if($floor==1)
                                                        st
                                                    @elseif($floor==2)
                                                        nd
                                                    @elseif($floor==3)
                                                        rd
                                                    @else
                                                        th
                                                    @endif
                                                floor,
                                                Gleneagles Hospital KK
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="mbr-timeline-text mbr-fonts-style display-7">Time&emsp;:</p>
                                        </td>
                                        <td>
                                            <p class="mbr-timeline-text mbr-fonts-style display-7">{{date_format(date_create($event->eventStartTime), "h:i A")}} to {{date_format(date_create($event->eventEndTime), "h:i A")}}</p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
