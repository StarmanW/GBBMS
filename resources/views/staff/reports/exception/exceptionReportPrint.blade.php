<title>Event ({{$resvs[0]->eventID}}) Reservation Cancellation Report</title>
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
    <h2 style="margin-bottom: 2.5%;">Exception Report <br/> Event ({{$resvs[0]->eventID}}) Reservation Cancellation Report</h2>
</div>

<div>

    <section class="section-table cid-qMsKYUfsjq" id="table1-1s">
        <div class="container container-table">
            <div class="table-wrapper">
                <div class="container scroll">
                    <table class="table isSearch" cellspacing="0">
                        <thead>
                        <tr class="table-heads">
                            <th class="head-item mbr-fonts-style display-7">Event ID</th>
                            <th class="head-item mbr-fonts-style display-7">Event Name</th>
                            <th class="head-item mbr-fonts-style display-7">Date</th>
                            <th class="head-item mbr-fonts-style display-7">Time</th>
                            <th class="head-item mbr-fonts-style display-7">Room ID</th>
                            <th class="head-item mbr-fonts-style display-7">Reservation ID</th>
                            <th class="head-item mbr-fonts-style display-7">Donor Name</th>
                            <th class="head-item mbr-fonts-style display-7">Donor ID</th>
                            <th class="head-item mbr-fonts-style display-7">Cancelled On</th>
                        </thead>
                        <tbody>
                        @foreach($resvs as $key => $resv)
                            <tr>
                                @if($key === 0)
                                    <td class="body-item mbr-fonts-style display-7">{{$resv->events->eventID}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{html_entity_decode($resv->events->eventName, ENT_QUOTES, 'UTF-8')}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($resv->events->eventDate), "d-M-Y")}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($resv->events->eventStartTime), "h:i A")}} to {{date_format(date_create($resv->events->eventEndTime), "h:i A")}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{$resv->events->rooms->roomID}}</td>
                                @else
                                    <td class="body-item mbr-fonts-style display-7"></td>
                                    <td class="body-item mbr-fonts-style display-7"></td>
                                    <td class="body-item mbr-fonts-style display-7"></td>
                                    <td class="body-item mbr-fonts-style display-7"></td>
                                    <td class="body-item mbr-fonts-style display-7"></td>
                                @endif
                                <td class="body-item mbr-fonts-style display-7">{{$resv->resvID}}</td>
                                <td class="body-item mbr-fonts-style display-7">{{$resv->donors->donorID}}</td>
                                <td class="body-item mbr-fonts-style display-7">{{$resv->donors->firstName}} {{$resv->donors->lastName}}</td>
                                <td class="body-item mbr-fonts-style display-7">{{$resv->updated_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<div>
    <p>Total {{count($resvs)}} records shown</p>
</div>

<htmlpagefooter name="page-footer">
    <div style="text-align: center;">
        <p style="margin-top: 15%;">{PAGENO}</p>
    </div>
</htmlpagefooter>
</body>
