@extends('staff.layout.baseTemplate-HR')

@section('title')
    <title>Event Details</title>
@endsection

@section('additionalCSS')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/default.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.rtl.min.css" />
    <link rel="stylesheet" href={{"/assets/additional/css/registerForm.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/additional/css/profile.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/additional/css/notify.css"}} type="text/css">
@endsection

@section('contents')
    <section class="testimonials5 cid-qM5et8Bfce" id="testimonials5-17" data-rv-view="1335">
        <div class="mbr-overlay" style="opacity: 0.15; background-color:#000000;"></div>
        <div class="container">
            <div class="media-container-row">
                <div class="title col-12 align-center">
                    <h2 class="pb-3 mbr-fonts-style display-1">
                        Event Details
                    </h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="media-container-column">
                <div class="mbr-testimonial align-center col-12 col-md-10">
                    <div class="panel-item">
                        <div class="card-block">
                            @if($data['event']->eventStatus===2)
                                <a href="/staff/hr/list/event"><button type="button" class="btn btn-sm btn-primary profile-btn">Back</button></a>
                            @endif
                            <div class="profile-table-wrap">
                                <table class="table profile-table">
                                    <tbody>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Event ID</th>
                                            <td class="body-item mbr-fonts-style display-7">{{$data['event']->eventID}}</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Event Name</th>
                                            <td class="body-item mbr-fonts-style display-7">{{$data['event']->eventName}}</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Date</th>
                                            <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($data['event']->eventDate), "d-M-Y")}}</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Time</th>
                                            <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($data['event']->eventStartTime), "h:i A")}} to {{date_format(date_create($data['event']->eventEndTime), "h:i A")}}</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Room</th>
                                            <td class="body-item mbr-fonts-style display-7">Room {{substr($data['event']->rooms->roomID, 3)}}, Quadrant {{$data['event']->rooms->quadrant}}, Floor {{$data['event']->rooms->floor}}</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Status</th>
                                            <td class="body-item mbr-fonts-style display-7">{{$data['event']->getEventStatus()}}</td>
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
                                                        @foreach($data['eventScheds'] as $eventSched)
                                                        <tr>
                                                            <td class="body-item mbr-fonts-style display-7">{{$eventSched->staffs->staffID}}</td>
                                                            <td class="body-item mbr-fonts-style display-7">{{$eventSched->staffs->firstName}} {{$eventSched->staffs->lastName}}</td>
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
                                        @if($data['event']->eventStatus===1)
                                        <a href="/staff/hr/list/event"><button type="button" class="btn btn-sm btn-primary profile-btn">Back</button></a>
                                            <button data-toggle="modal" data-target="#updateEventModal" type="button" name="edit" class="btn btn-sm btn-primary profile-btn">Edit Event Details</button>
                                            <button type="button" name="delete" class="btn btn-sm btn-secondary profile-btn" onclick="cancelEventPrompt('{{$data['event']->eventID}}', '{{$data['event']->eventName}}');">Cancel Event</button>
                                            <form method="POST" action="/staff/hr/list/event/{{$data['event']->eventID}}/cancel" id="cancel{{$data['event']->eventID}}" style="display: none;">
                                                {{csrf_field()}}
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- line modal -->
        <div class="modal fade" id="updateEventModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="lineModalLabel">Editing event {{$data['event']->eventID}}</h3>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">Close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="/staff/hr/list/event/{{$data['event']->eventID}}">
                            {{ csrf_field() }}
                            <p style="color:red; float: left;">"*" Required fields</p>
                            <br />
                            <br />
                            <div class="col-sm-12">
                                <div class="row" style="margin:auto">
                                    <label>
                                        <span style="color:red;">*</span>Event Name</label>
                                    <input type="text" name="eventName" value="{{$data['event']->eventName}}" placeholder="John" class="form-control" pattern="[A-Za-z0-9\-@ ]{2,}" title="Alphabetic, @ and - symbols only. E.g. - John"
                                        required="required">
                                </div>
                                <br>
                                <div class="row" style="margin:auto">
                                    <label>
                                        <span style="color:red;">*</span>Event Date</label>
                                    <input class="form-control" value="{{$data['event']->eventDate}}" type="date" name="eventDate" id="eventDate" required="required">
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label>
                                            <span style="color:red;">*</span>Start Time</label>
                                        <input class="form-control" value="{{date_format(date_create($data['event']->eventStartTime), "h:i")}}" type="time" name="eventStartTime" id="eventStartTime">
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>
                                            <span style="color:red;">*</span>End Time</label>
                                        <input class="form-control" value="{{date_format(date_create($data['event']->eventEndTime), "h:i")}}" type="time" name="eventEndTime" id="eventEndTime">
                                    </div>
                                </div>
                                <div class="row" style="margin:auto">
                                    <label>
                                        <span style="color:red;">*</span>Room</label>
                                    <select name="roomID" class="form-control" required="required">
                                        <option disabled selected value>Select Room Number</option>
                                        @foreach($data['rooms'] as $room)
                                            <option value="{{$room->roomID}}" @if($data['event']->roomID === $room->roomID) {{"selected"}} @endif>Room {{$room->roomID}} (Floor {{$room->floor}}, Quadrant {{$room->quadrant}} - Room {{substr($room->roomID, 3)}})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br />
                            <div class="submit-button div-button-center">
                                <button type="submit" class="btn btn-sm btn-success profile-btn">Submit</button>
                                <button type="reset" class="btn btn-sm btn-primary profile-btn">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('additionalJS')
    <script src={{"/assets/additional/js/event_util.js"}}></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>

    @if(count($errors) > 0)
        <script>
            $('#updateEventModal').modal('show');
            eventUpdateFormError('Empty/Invalid Data Entered', {!! $errors !!});
        </script>
    @elseif(session('success'))
        <script>eventUpdateSuccess("{{session('success')}}");</script>
    @elseif(session('cancelSuccess'))
        <script>cancelEventSuccess("{{session('cancelSuccess')}}");</script>
    @elseif(session('cancelFailure'))
        <script>cancelEventFailure("{{session('cancelFailure')}}");</script>
    @endif
@endsection