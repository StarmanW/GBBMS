@extends('donor.layout.baseTemplate')

@section('title')
    <title>Event Details</title>
@endsection

@section('additionalCSS')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/default.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.rtl.min.css" />
    <link rel="stylesheet" href={{"/assets/additional/css/scrollToTop.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/additional/css/profile.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/additional/css/notify.css"}} type="text/css">
@endsection

@section('contents')
    <section class="testimonials5 cid-qM5et8Bfce" id="testimonials5-17" data-rv-view="1335">
        <div class="mbr-overlay" style="opacity: 0.15; background-color:#000000;"></div>
        <div class="container">
            <div class="media-container-row">
                <div class="title col-12 align-center">
                    <h2 class="pb-3 mbr-fonts-style display-1">Event Details</h2>
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
                                                    @foreach($data['nurses'] as $nurse)
                                                        <tr>
                                                            <td class="body-item mbr-fonts-style display-7">{{$nurse->staffID}}</td>
                                                            <td class="body-item mbr-fonts-style display-7">{{$nurse->staffs->firstName}} {{$nurse->staffs->lastName}}</td>
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
                                        <a href="/donor/upcoming-events"><button type="button" class="btn btn-sm btn-primary profile-btn">Back</button></a>
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
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
    @if(session('success'))
        <script>
            //Display Donor password update message
            alertify.alert('{{session('success')}}').setting({
                'transition': 'zoom',
                'movable': false,
                'modal': true,
                'labels': 'OK'
            }).setHeader("Change Password").show();
        </script>
    @elseif(session('failure'))
        <script>
            //Display Donor password update message
            alertify.alert('{{session('failure')}}').setting({
                'transition': 'zoom',
                'movable': false,
                'modal': true,
                'labels': 'OK'
            }).setHeader("Change Password").show();
        </script>
    @endif
@endsection
