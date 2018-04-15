@if(session('rType') === "resvList")
    <title>{{date_format(date_create($records[0]->eventDate), "Y")}} Reservation Report</title>
@elseif(session('rType') === "blood")
    <title>{{date_format(date_create($records[0]->eventDate), "Y")}} Donated Bloods Report</title>
@endif
<body>
<htmlpageheader name="page-header">
    @include('staff.layout.reportCSSStyle')

    <div style="padding: 2.5% 0;">
        <img src="https://3.bp.blogspot.com/-5UI9bDl5Mjc/V7Giemh2wSI/AAAAAAAAAbU/jiw5uHq6aloLQijVqxGkzUsVB5cEdHLXwCLcB/s1600/gkk.jpg"
             alt="Gleneagles Hospital KK Logo" style="height: 7%; width: 35%; float: left;">

        <div style="width: 60%; float:right; text-align:right;">
            <p>GLENEAGLES KOTA KINABALU<br>Riverson@Sembulan, Block A-1,<br>Lorong Riverson@Sembulan,<br>88100 Kota
                Kinabalu, Sabah</p>
        </div>
    </div>
</htmlpageheader>

<div style="text-align: center;">
    @if(session('rType') === "resvList")
        <h2 style="margin-bottom: 2.5%;">Summary Report <br/> {{date_format(date_create($records[0]->eventDate), "Y")}} Reservation Report</h2>
    @elseif(session('rType') === "blood")
        <h2 style="margin-bottom: 2.5%;">Summary Report <br/> {{date_format(date_create($records[0]->eventDate), "Y")}} Donated Bloods Report</h2>
    @endif
</div>

<div>

    <section class="section-table cid-qMsKYUfsjq" id="table1-1s">
        <div class="container container-table">
            <div class="table-wrapper">
                <div class="container scroll">
                    <table class="table isSearch" cellspacing="0">
                        <thead>
                        @if(session('rType') === "resvList")
                            <tr class="table-heads ">
                                <th class="head-item mbr-fonts-style display-7">Event ID</th>
                                <th class="head-item mbr-fonts-style display-7">Event Name</th>
                                <th class="head-item mbr-fonts-style display-7">Event Date</th>
                                <th class="head-item mbr-fonts-style display-7">Event Time</th>
                                <th class="head-item mbr-fonts-style display-7">Event Room</th>
                                <th class="head-item mbr-fonts-style display-7">Total Donor Absent</th>
                                <th class="head-item mbr-fonts-style display-7">Total Reservations Cancelled</th>
                                <th class="head-item mbr-fonts-style display-7">Total Completed Reservations</th>
                                <th class="head-item mbr-fonts-style display-7">Total Reservations Made</th>
                            </tr>
                        </thead>
                            <tbody>
                            @foreach($records as $key => $event)
                                <tr>
                                    <td class="body-item mbr-fonts-style display-7">{{$event->eventID}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{html_entity_decode($event->eventName, ENT_QUOTES, 'UTF-8')}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($event->eventDate), "d-M-Y")}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($event->eventStartTime), "h:i A")}} to {{date_format(date_create($event->eventEndTime), "h:i A")}}</td>
                                    <td class="body-item mbr-fonts-style display-7">Room {{substr($event->rooms->roomID, 3)}}, Quadrant {{$event->rooms->quadrant}}, Floor {{$event->rooms->floor}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{count($event->reservations->where('resvStatus', 2))}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{count($event->reservations->where('resvStatus', 3))}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{count($event->reservations->where('resvStatus', 0))}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{count($event->reservations)}}</td>
                                </tr>
                            @endforeach
                        @elseif(session('rType') === "blood")
                                <tr class="table-heads ">
                                    <th class="head-item mbr-fonts-style display-7">Event ID</th>
                                    <th class="head-item mbr-fonts-style display-7">Event Name</th>
                                    <th class="head-item mbr-fonts-style display-7">Event Date</th>
                                    <th class="head-item mbr-fonts-style display-7">Event Time</th>
                                    <th class="head-item mbr-fonts-style display-7">Blood A+</th>
                                    <th class="head-item mbr-fonts-style display-7">Blood A-</th>
                                    <th class="head-item mbr-fonts-style display-7">Blood B+</th>
                                    <th class="head-item mbr-fonts-style display-7">Blood B-</th>
                                    <th class="head-item mbr-fonts-style display-7">Blood O+</th>
                                    <th class="head-item mbr-fonts-style display-7">Blood O-</th>
                                    <th class="head-item mbr-fonts-style display-7">Blood AB+</th>
                                    <th class="head-item mbr-fonts-style display-7">Blood AB-</th>
                                    <th class="head-item mbr-fonts-style display-7">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $key => $event)
                                <tr>
                                    <td class="body-item mbr-fonts-style display-7">{{$event->eventID}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{html_entity_decode($event->eventName, ENT_QUOTES, 'UTF-8')}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($event->eventDate), "d-M-Y")}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($event->eventStartTime), "h:i A")}} to {{date_format(date_create($event->eventEndTime), "h:i A")}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{count($event->bloods->where('bloodType', '=', 1)->where('eventID', '=', $event->eventID))}} bag(s)</td>
                                    <td class="body-item mbr-fonts-style display-7">{{count($event->bloods->where('bloodType', '=', 2)->where('eventID', '=', $event->eventID))}} bag(s)</td>
                                    <td class="body-item mbr-fonts-style display-7">{{count($event->bloods->where('bloodType', '=', 3)->where('eventID', '=', $event->eventID))}} bag(s)</td>
                                    <td class="body-item mbr-fonts-style display-7">{{count($event->bloods->where('bloodType', '=', 4)->where('eventID', '=', $event->eventID))}} bag(s)</td>
                                    <td class="body-item mbr-fonts-style display-7">{{count($event->bloods->where('bloodType', '=', 5)->where('eventID', '=', $event->eventID))}} bag(s)</td>
                                    <td class="body-item mbr-fonts-style display-7">{{count($event->bloods->where('bloodType', '=', 6)->where('eventID', '=', $event->eventID))}} bag(s)</td>
                                    <td class="body-item mbr-fonts-style display-7">{{count($event->bloods->where('bloodType', '=', 7)->where('eventID', '=', $event->eventID))}} bag(s)</td>
                                    <td class="body-item mbr-fonts-style display-7">{{count($event->bloods->where('bloodType', '=', 8)->where('eventID', '=', $event->eventID))}} bag(s)</td>
                                    <td class="body-item mbr-fonts-style display-7">{{count($event->bloods)}} bag(s)</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<div>
    <p>Total {{count($records)}} records shown</p>
</div>

<htmlpagefooter name="page-footer">
    <div style="text-align: center;">
        <p style="margin-top: 15%;">{PAGENO}</p>
    </div>
</htmlpagefooter>
</body>
