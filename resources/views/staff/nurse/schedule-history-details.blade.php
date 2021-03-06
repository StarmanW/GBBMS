@extends('staff.layout.baseTemplate-Nurse')

@section('title', "Schedule Details")

@section('additionalCSS')
    <link rel="stylesheet" href={{"/assets/additional/css/profile.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/additional/css/reservation-details.css"}} type="text/css">
@endsection

@section('contents')
    <section class="testimonials5 cid-qM5et8Bfce" id="testimonials5-17" data-rv-view="1335">
        <div class="mbr-overlay" style="opacity: 0.1; background-color:#000000;"></div>

        <div class="container">
            <div class="media-container-column">
                <div class="mbr-testimonial align-center col-12 col-md-10">
                    <div class="panel-item">
                        <div class="container">
                            <div class="media-container-row">
                                <div class="title col-12 align-center">
                                    <h2 class="pb-3 mbr-fonts-style display-2">Schedule Details</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="profile-table-wrap">
                                <table class="table profile-table">
                                    <tbody>
                                    <th colspan="2" class="title pb-3 mbr-fonts-style display-2">Event</th>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Event ID</th>
                                            <td class="body-item mbr-fonts-style display-7">{{$scheduleHistory->events->eventID}}</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Event Name</th>
                                            <td class="body-item mbr-fonts-style display-7">{{html_entity_decode($scheduleHistory->events->eventName, ENT_QUOTES, 'UTF-8')}}</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Date</th>
                                            <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($scheduleHistory->events->eventDate), "d-M-Y")}}</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Time</th>
                                            <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($scheduleHistory->events->eventStartTime), "h:i A")}} to {{date_format(date_create($scheduleHistory->events->eventEndTime), "h:i A")}}</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Room</th>
                                            <td class="body-item mbr-fonts-style display-7">Room {{substr($scheduleHistory->events->rooms->roomID, 3)}}, Quadrant {{$scheduleHistory->events->rooms->quadrant}}, Floor {{$scheduleHistory->events->rooms->floor}}</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Status</th>
                                            <td class="body-item mbr-fonts-style display-7">{{$scheduleHistory->events->getEventStatus()}}</td>
                                        </tr>
                                        <th class="body-item mbr-fonts-style display-7">Nurses On Duty</th>
                                        <td class="body-item mbr-fonts-style display-7">
                                            <table class="table profile-table-nurse">
                                                <thead>
                                                <tr>
                                                    <th>Nurse ID</th>
                                                    <th>Nurse Name</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($scheduleHistory->events->eventSchedules as $nurse)
                                                    <tr>
                                                        <td class="body-item mbr-fonts-style display-7">{{$nurse->staffs->staffID}}</td>
                                                        <td class="body-item mbr-fonts-style display-7">{{$nurse->staffs->firstName}} {{$nurse->staffs->lastName}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tbody>
                                </table>
                                <div class="card">
                                    <div class="card-body">
                                        <a href="/staff/nurse/schedule-history">
                                            <button type="button" class="btn btn-sm btn-primary profile-btn">Back</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
