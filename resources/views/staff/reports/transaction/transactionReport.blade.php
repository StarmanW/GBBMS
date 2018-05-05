@extends('staff.layout.baseTemplate-HR')

@section('title')
    Event ({{$resvs[0]->eventID}}) Reservation Report
@endsection

@section('additionalCSS')
    <link rel="stylesheet" href="/assets/datatables/data-tables.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/additional/css/table-list.css" type="text/css">
@endsection

@section('contents')
    <!-- Page Content -->
    <section class="section-table cid-qMsKT09Rch" id="table1-1q">
        <div class="container container-table">
            <h3 class="mbr-section-subtitle mbr-fonts-style align-center pb-5 mbr-light display-5"></h3>
            <div class="table-backpanel">
                <div class="table-wrapper">
                    <h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-2">Event
                        ({{$resvs[0]->eventID}}) Reservation Report</h2>
                    <h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-2">
                        <span style="text-align: center"><a href="./{{$resvs[0]->eventID}}/print" target="_blank"><button
                                        type="button" class="btn btn-sm btn-primary">Print Report</button></a></span>
                        <span style="text-align: center"><a href="/staff/hr/report/transaction"><button type="button"
                                                                                                        class="btn btn-sm btn-primary">Back to Search</button></a></span>
                    </h2>
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
                                <th class="body-item mbr-fonts-style display-7">No.</th>
                                <th class="head-item mbr-fonts-style display-7">Event ID</th>
                                <th class="head-item mbr-fonts-style display-7">Event Name</th>
                                <th class="head-item mbr-fonts-style display-7">Date</th>
                                <th class="head-item mbr-fonts-style display-7">Time</th>
                                <th class="head-item mbr-fonts-style display-7">Room ID</th>
                                <th class="head-item mbr-fonts-style display-7">Reservation ID</th>
                                <th class="head-item mbr-fonts-style display-7">Donor ID</th>
                                <th class="head-item mbr-fonts-style display-7">Donor Name</th>
                                <th class="head-item mbr-fonts-style display-7">Reservation Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($resvs as $key => $resv)
                                <tr>
                                    <td class="body-item mbr-fonts-style display-7">{{$key + 1}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{$resv->events->eventID}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{html_entity_decode($resv->events->eventName, ENT_QUOTES, 'UTF-8')}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($resv->events->eventDate), "d-M-Y")}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($resv->events->eventStartTime), "h:i A")}}
                                        to {{date_format(date_create($resv->events->eventEndTime), "h:i A")}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{$resv->events->rooms->roomID}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{$resv->resvID}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{$resv->donors->donorID}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{$resv->donors->firstName}} {{$resv->donors->lastName}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{$resv->getResvStatus()}}</td>
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
                    {{$resvs->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('additionalJS')
    <script src="/assets/datatables/jquery.data-tables.min.js"></script>
    <script src="/assets/datatables/data-tables.bootstrap4.min.js"></script>
@endsection
