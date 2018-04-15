@extends('staff.layout.baseTemplate-HR')

@section('title')
    <title>Event List</title>
@endsection

@section('additionalCSS')
    <link rel="stylesheet" href={{"/assets/datatables/data-tables.bootstrap4.min.css"}}>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/default.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.rtl.min.css" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href={{"/assets/additional/css/table-list.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/additional/css/sidebar.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/additional/css/notify.css"}} type="text/css">
@endsection

@section('contents')
    <!-- Sidebar -->
    <div class="w3-sidebar w3-bar-block w3-animate-left" style="display:none;z-index:5" id="mySidebar">
        <br><br><br><br>
        <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close <span style="float: right">&times;</span></button>
        <br>

        <span style="text-align: center; color: white" class="w3-bar-item">View List</span>
        <hr id="sideBarHR">
        <a href="/staff/hr/list/staff" class="w3-bar-item w3-button">Staff List <i class="fa fa-user-md" style="float: right" id="sidebar-toggle" aria-hidden="true"></i></a>
        <a href="/staff/hr/list/donor" class="w3-bar-item w3-button">Donor List <i class="fa fa-tint" style="float: right" id="sidebar-toggle" aria-hidden="true"></i></a>
        <a href="/staff/hr/list/event" class="w3-bar-item w3-button">Event List <i class="fa fa-calendar-alt" style="float: right" id="sidebar-toggle" aria-hidden="true"></i></a>
    </div>

    <!-- Page Content -->
    <div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

    <!-- Page Content -->
    <div class="w3-container">
        <section class="section-table cid-qMsKYUfsjq" id="table1-1s">
            <a onclick="w3_open()">
                <i class="fa fa-angle-up fa-4x" id="sidebar-toggle" aria-hidden="true"></i>
            </a>
            <div class="container container-table">
                <h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-2">Event List</h2>
                <h3 class="mbr-section-subtitle mbr-fonts-style align-center pb-5 mbr-light display-5"></h3>
                <div class="table-backpanel">
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
                                    <td class="body-item mbr-fonts-style display-7">{{$event->eventName}}</td>
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
    </div>
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
    <script>
        //Menu Toggle Script
        function w3_open() {
            document.getElementById("mySidebar").style.display = "block";
            document.getElementById("myOverlay").style.display = "block";
        }

        function w3_close() {
            document.getElementById("mySidebar").style.display = "none";
            document.getElementById("myOverlay").style.display = "none";
        }
    </script>
@endsection