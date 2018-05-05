@extends('donor.layout.baseTemplate')

@section('title', "Upcoming Events")

@section('additionalCSS')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/default.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.rtl.min.css" />
    <link rel="stylesheet" href={{"/assets/datatables/data-tables.bootstrap4.min.css"}}>
    <link rel="stylesheet" href={{"/assets/additional/css/table-list.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/additional/css/sidebar.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/additional/css/notify.css"}} type="text/css">
@endsection

@section('contents')
    <section class="section-table cid-qMsL032wYA" id="table1-1t">
        <div class="mbr-overlay" style="opacity: 0.1; background-color:#000000;"></div>

        <div class="container container-table">
            <h3 class="mbr-section-subtitle mbr-fonts-style align-center pb-5 mbr-light display-5"></h3>
            <div class="table-backpanel">
                <h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-2">Upcoming Events</h2>
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
                                    <th class="head-item mbr-fonts-style display-7">Event Name</th>
                                    <th class="head-item mbr-fonts-style display-7">Date</th>
                                    <th class="head-item mbr-fonts-style display-7">Time</th>
                                    <th class="head-item mbr-fonts-style display-7">Room</th>
                                    <th class="head-item mbr-fonts-style display-7">Event Status</th>
                                    <th class="head-item mbr-fonts-style display-7"></th>
                                    <th class="head-item mbr-fonts-style display-7"></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($eventList as $event)
                                <tr>
                                    <td class="body-item mbr-fonts-style display-7">{{html_entity_decode($event->eventName, ENT_QUOTES, 'UTF-8')}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($event->eventDate), "d-M-Y")}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($event->eventStartTime), "h:i A")}} to {{date_format(date_create($event->eventEndTime), "h:i A")}}</td>
                                    <td class="body-item mbr-fonts-style display-7">Room {{substr($event->rooms->roomID, 3)}}, Quadrant {{$event->rooms->quadrant}}, Floor {{$event->rooms->floor}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{$event->getEventStatus()}}</td>
                                    <td class="body-item mbr-fonts-style display-7 button-column">
                                        <a href="/donor/upcoming-events/{{$event->eventID}}">
                                            <i class="fa fa-bars" aria-hidden="true" title="Event details"></i>
                                        </a>
                                    </td>
                                    <td class="body-item mbr-fonts-style display-7 button-column">
                                        @if($event->reservations->where('resvStatus', '=', 1)->where('donorID', '=', Auth::id())->where('eventID', '=', $event->eventID)->count() === 0)
                                        <a href="#" onclick="reservationPrompt('{{$event->eventID}}', '{{$event->eventName}}')">
                                            <i class="fa fa-check" aria-hidden="true" title="Reserve now"></i>
                                        </a>
                                        <form method="post" action="/donor/{{$event->eventID}}/reserve" id="reserve{{$event->eventID}}" style="display: none;">
                                            {{csrf_field()}}
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
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
                <div class="container pagination" style="padding-bottom:2%;">
                    {{$eventList->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('additionalJS')
    <script src={{"/assets/datatables/jquery.data-tables.min.js"}}></script>
    <script src={{"/assets/datatables/data-tables.bootstrap4.min.js"}}></script>
    <script src={{"/assets/additional/js/event_list_util.js"}}></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>

    @if(session('success'))
        <script>displayReservationStatus('{{session('success')}}')</script>
    @elseif(session('failure'))
        <script>displayReservationStatus('{{session('failure')}}')</script>
    @endif
@endsection