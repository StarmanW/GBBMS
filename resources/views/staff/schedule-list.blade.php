@extends('staff.layout.baseTemplate-Nurse')

@section('title')
    <title>Schedule List</title>
@endsection

@section('additionalCSS')
    <link rel="stylesheet" href={{"/assets/datatables/data-tables.bootstrap4.min.css"}}>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href={{"/assets/additional/css/table-list.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/additional/css/sidebar.css"}} type="text/css">
@endsection

@section('contents')
    <div class="w3-container">
        <section class="section-table cid-qMsKXLSbve" id="table1-1r">
            <div class="container container-table">
                <div class="table-backpanel">
                    <h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-2">Schedule List</h2>
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
                                        <th class="head-item mbr-fonts-style display-7">Event ID</th>
                                        <th class="head-item mbr-fonts-style display-7">Event Name</th>
                                        <th class="head-item mbr-fonts-style display-7">Date</th>
                                        <th class="head-item mbr-fonts-style display-7">Time</th>
                                        <th class="head-item mbr-fonts-style display-7">Event Status</th>
                                        <th class="head-item mbr-fonts-style display-7"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($schedules as $schedule)
                                    <tr>
                                        <td class="body-item mbr-fonts-style display-7">{{$schedule->eventID}}</td>
                                        <td class="body-item mbr-fonts-style display-7">{{$schedule->events->eventName}}</td>
                                        <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($schedule->events->eventDate), 'd-M-Y')}}</td>
                                        <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($schedule->events->eventStartTime), 'h:i A')}} to {{date_format(date_create($schedule->events->eventEndTime), 'h:i A')}}</td>
                                        <td class="body-item mbr-fonts-style display-7">{{$schedule->events->getEventStatus()}}</td>
                                        <td class="body-item mbr-fonts-style display-7 button-column">
                                            <a href="/staff/nurse/event/{{$schedule->schedID}}/manage-blood">
                                                <i class="fa fa-tint" aria-hidden="true" title=""></i>
                                            </a>
                                            <a href="/staff/nurse/schedule/{{$schedule->schedID}}">
                                                <i class="fa fa-bars" aria-hidden="true" title=""></i>
                                            </a>
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
                </div>
            </div>
        </section>
    </div>
@endsection

@section('additionalJS')
    <script src={{"/assets/datatables/jquery.data-tables.min.js"}}></script>
    <script src={{"/assets/datatables/data-tables.bootstrap4.min.js"}}></script>
@endsection
