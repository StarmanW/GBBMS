@extends('donor.layout.baseTemplate')

@section('title', "Current Reservation List")

@section('additionalCSS')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/default.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.rtl.min.css" />
    <link rel="stylesheet" href={{"/assets/additional/css/notify.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/datatables/data-tables.bootstrap4.min.css"}}>
    <link rel="stylesheet" href={{"/assets/additional/css/table-list.css"}} type="text/css">
@endsection

@section('contents')
    <!-- Page Content -->
    <section class="section-table cid-qEBSaDdCCZ" id="table1-t" data-rv-view="1214">
        <div class="mbr-overlay" style="opacity: 0.1; background-color:#000000;"></div>

        <div class="container container-table">
            <h3 class="mbr-section-subtitle mbr-fonts-style align-center pb-5 mbr-light display-5"></h3>
            <div class="table-backpanel">
                <h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-2">Your Current Reservations</h2>
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
                                <th class="head-item mbr-fonts-style display-7">Reservation ID</th>
                                <th class="head-item mbr-fonts-style display-7">Event Name</th>
                                <th class="head-item mbr-fonts-style display-7">Event Date</th>
                                <th class="head-item mbr-fonts-style display-7">Event Time</th>
                                <th class="head-item mbr-fonts-style display-7">Reservation Status</th>
                                <th class="head-item mbr-fonts-style display-7"></th>
                                <th class="head-item mbr-fonts-style display-7"></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($resvs as $resv)
                                <tr>
                                    <td class="body-item mbr-fonts-style display-7">{{$resv->resvID}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{html_entity_decode($resv->events->eventName, ENT_QUOTES, 'UTF-8')}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($resv->events->eventDate), "d-M-Y")}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($resv->events->eventStartTime), "h:i A")}} to {{date_format(date_create($resv->events->eventEndTime), "h:i A")}}</td>
                                    <td class="body-item mbr-fonts-style display-7">Reserved</td>
                                    <td class="body-item mbr-fonts-style display-7 button-column">
                                        <a href="/donor/reservation/{{$resv->resvID}}">
                                            <i class="fa fa-bars" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td class="body-item mbr-fonts-style display-7 button-column">
                                        @if($resv->resvStatus===1)
                                        <a href="#" onclick="cancellationPrompt('{{$resv->resvID}}');">
                                            <i class="fa fa-times" aria-hidden="true" title="Cancel reservation now"></i>
                                        </a>
                                        <form method="post" action="/donor/reservation/{{$resv->resvID}}/cancel" id="cancel{{$resv->resvID}}" style="display: none;">
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
                    {{$resvs->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('additionalJS')
    <script src={{"/assets/datatables/jquery.data-tables.min.js"}}></script>
    <script src={{"/assets/datatables/data-tables.bootstrap4.min.js"}}></script>
    <script src={{"/assets/additional/js/reservation_util.js"}}></script>
    <script src={{"/assets/theme/js/script.js"}}></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>

    @if(session('success'))
    <script>displayCancellationStatus('{{session('success')}}')</script>
    @elseif(session('failure'))
    <script>displayCancellationStatus('{{session('failure')}}')</script>
    @endif
@endsection