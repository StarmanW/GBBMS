@extends('donor.layout.baseTemplate')

@section('title')
    <title>Reservation Details</title>
@endsection

@section('additionalCSS')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/default.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.rtl.min.css" />
    <link rel="stylesheet" href={{"/assets/additional/css/notify.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/additional/css/profile.css"}} type="text/css">
	<link rel="stylesheet" href={{"/assets/additional/css/reservation-details.css"}} type="text/css">
@endsection

@section('contents')
    <section class="testimonials5 cid-qM5et8Bfce" id="testimonials5-17" data-rv-view="1335">
        <div class="container">
            <div class="media-container-row">
                <div class="title col-12 align-center">
                    <h2 class="pb-3 mbr-fonts-style display-1">
                        Reservation Details
                    </h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="media-container-column">
                <div class="mbr-testimonial align-center col-12 col-md-10">
                    <div class="panel-item">
                        <div class="card-block">
                            <div class="profile-table-wrap">
                                <table class="table profile-table">
                                    <tbody>
										<th colspan="2" class="title">Reservation</th>
										<tr>
                                            <th class="body-item mbr-fonts-style display-7">Reservation ID</th>
                                            <td class="body-item mbr-fonts-style display-7">{{$reservation->resvID}}</td>
                                        </tr>
										<tr>
                                            <th class="body-item mbr-fonts-style display-7">Date Reserved</th>
                                            <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($reservation->resvDateTime), "d-M-Y")}}</td>
                                        </tr>
										<tr>
                                            <th class="body-item mbr-fonts-style display-7">Reservation Status</th>
                                            <td class="body-item mbr-fonts-style display-7">{{$reservation->getResvStatus()}}</td>
                                        </tr>
										<th colspan="2" class="title">Event</th>
										<tr>
                                            <th class="body-item mbr-fonts-style display-7">Event ID</th>
                                            <td class="body-item mbr-fonts-style display-7">{{$reservation->events->eventID}}</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Event Name</th>
                                            <td class="body-item mbr-fonts-style display-7">{{html_entity_decode($reservation->events->eventName, ENT_QUOTES, 'UTF-8')}}</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Date</th>
                                            <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($reservation->events->eventDate), "d-M-Y")}}</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Time</th>
                                            <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($reservation->events->eventStartTime), "h:i A")}} to {{date_format(date_create($reservation->events->eventEndTime), "h:i A")}}</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Room</th>
                                            <td class="body-item mbr-fonts-style display-7">Room {{substr($reservation->events->rooms->roomID, 3)}}, Quadrant {{$reservation->events->rooms->quadrant}}, Floor {{$reservation->events->rooms->floor}}</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Status</th>
                                            <td class="body-item mbr-fonts-style display-7">{{$reservation->events->getEventStatus()}}</td>
                                        </tr>
                                        <tr>
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
                                                    @foreach($reservation->events->eventSchedules as $evScheds)
                                                        <tr>
                                                            <td class="body-item mbr-fonts-style display-7">{{$evScheds->staffs->staffID}}</td>
                                                            <td class="body-item mbr-fonts-style display-7">{{$evScheds->staffs->firstName}} {{$evScheds->staffs->lastName}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
								<div class="card">
                                    <div class="card-body">
                                        @if(session('isResvCurr'))
                                            <a href="/donor/reservation/current"><button type="button" class="btn btn-sm btn-primary profile-btn">Back</button></a>
                                            <button type="submit" onclick="cancellationPrompt('{{$reservation->resvID}}');" class="btn btn-sm btn-secondary profile-btn">Cancel Reservation</button>
                                            <form method="post" action="/donor/reservation/{{$reservation->resvID}}/cancel" id="cancel{{$reservation->resvID}}" style="display: none;">
                                                {{csrf_field()}}
                                            </form>
                                            @php session()->forget('isResvCurr'); @endphp
                                        @elseif(session('isResvHistory'))
                                            <a href="/donor/reservation"><button type="button" class="btn btn-sm btn-primary profile-btn">Back</button></a>
                                            @php session()->forget('isResvHistory'); @endphp
                                        @endif
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

@section('additionalJS')
    <script src="/assets/additional/js/reservation_util.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>

    @if(session('success'))
        <script>displayCancellationStatus('{{session('success')}}')</script>
    @elseif(session('failure'))
        <script>displayCancellationStatus('{{session('failure')}}')</script>
    @endif
@endsection
