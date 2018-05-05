@extends('staff.layout.baseTemplate-HR')

@section('title', "Event List")

@section('additionalCSS')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/default.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.rtl.min.css" />
    <link rel="stylesheet" href={{"/assets/datatables/data-tables.bootstrap4.min.css"}}>
    <link rel="stylesheet" href={{"/assets/additional/css/table-list.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/additional/css/notify.css"}} type="text/css">
@endsection

@section('contents')
    <!-- Page Content -->
    <section class="section-table cid-qMsKYUfsjq" id="table1-1s">
        <div class="mbr-overlay" style="opacity: 0.1; background-color:#000000;"></div>

        <div class="container container-table">
            <h3 class="mbr-section-subtitle mbr-fonts-style align-center pb-5 mbr-light display-5"></h3>
            <div class="table-backpanel">
                <h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-2">Event List</h2>

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
                                <th class="head-item mbr-fonts-style display-7">ID</th>
                                <th class="head-item mbr-fonts-style display-7">Name</th>
                                <th class="head-item mbr-fonts-style display-7">Date</th>
                                <th class="head-item mbr-fonts-style display-7">Time</th>
                                <th class="head-item mbr-fonts-style display-7">Room</th>
                                <th class="head-item mbr-fonts-style display-7">Status</th>
                                <th class="head-item mbr-fonts-style display-7"></th>
                                <th class="head-item mbr-fonts-style display-7"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $event)
                            <tr>
                                <td class="body-item mbr-fonts-style display-7">{{$event->eventID}}</td>
                                <td class="body-item mbr-fonts-style display-7">{{html_entity_decode($event->eventName, ENT_QUOTES, 'UTF-8')}}</td>
                                <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($event->eventDate), "d-M-Y")}}</td>
                                <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($event->eventStartTime), "h:i A")}} to {{date_format(date_create($event->eventEndTime), "h:i A")}}</td>
                                <td class="body-item mbr-fonts-style display-7">Room {{substr($event->rooms->roomID, 3)}}, Quadrant {{$event->rooms->quadrant}}, Floor {{$event->rooms->floor}}</td>
                                <td class="body-item mbr-fonts-style display-7">{{$event->getEventStatus()}}</td>
                                <td class="body-item mbr-fonts-style display-7 button-column">
                                    <a href="/staff/hr/list/event/{{$event->eventID}}">
                                        <i class="fa fa-bars" aria-hidden="true" title="Event details"></i>
                                    </a>
                                </td>
                                <td class="body-item mbr-fonts-style display-7 button-column">
                                    @if($event->eventStatus===1)
                                    <a href="#" onclick="cancelEventPrompt('{{$event->eventID}}', '{{$event->eventName}}')">
                                        <i class="fa fa-times" aria-hidden="true" title="Cancel event"></i>
                                    </a>
                                    <form method="post" action="/staff/hr/list/event/{{$event->eventID}}/cancel" id="cancel{{$event->eventID}}" style="display: none;">
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
                    {{$events->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('additionalJS')
    <script src={{"/assets/datatables/jquery.data-tables.min.js"}}></script>
    <script src={{"/assets/datatables/data-tables.bootstrap4.min.js"}}></script>
    <script src={{"/assets/additional/js/event_util.js"}}></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>

    @if(session('cancelSuccess'))
        <script>cancelEventSuccess("{{session('cancelSuccess')}}");</script>
    @elseif(session('cancelFailure'))
        <script>cancelEventFailure("{{session('cancelFailure')}}");</script>
    @endif
@endsection