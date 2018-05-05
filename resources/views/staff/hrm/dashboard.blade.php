@extends('staff.layout.baseTemplate-HR')

@section('title', "HR - Dashboard")

@section('additionalCSS')
    <link rel="stylesheet" href={{"/assets/web/assets/mobirise-icons-bold/mobirise-icons-bold.css"}}>
    <link rel="stylesheet" href={{"/assets/additional/css/dashboard.css"}} type="text/css">
@endsection

@section('contents')
    <section class="cid-qLZoPtxl7o mbr-fullscreen mbr-parallax-background" id="header2-j">
        <div class="mbr-overlay" style="opacity: 0.1; background-color:#000000;"></div>

        <div class="container align-center">
            <div class="card" id="cardHeader">
                <div class="card-header">
                    <h3 class="card-title mbr-section-title mbr-fonts-style align-center pb-3 display-2" style="text-align: center">Blood Bank Overview</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="well dash-box">
                                <h2>
                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>{{$data['donorCount']}}</h2>
                                <h4 class="mbr-section-title mbr-fonts-style align-center pb-3 display-6">Donors</h4>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="well dash-box">
                                <h2>
                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>{{$data['nurseCount']}}</h2>
                                <h4 class="mbr-section-title mbr-fonts-style align-center pb-3 display-6">Nurses</h4>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="well dash-box">
                                <h2>
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>{{$data['eventCount']}}</h2>
                                <h4 class="mbr-section-title mbr-fonts-style align-center pb-3 display-6">Blood Donation Events</h4>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="well dash-box">
                                <h2>
                                    <span class="glyphicon glyphicon-stats" aria-hidden="true"></span>{{$data['bloodCount']}}</h2>
                                <h4 class="mbr-section-title mbr-fonts-style align-center pb-3 display-6">Blood Bags</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Blood Graph Section -->
            <div class="card">
                <div class="card-heading" style="border-bottom:1px solid; width:96%; margin:auto">
                    <h3 class="card-title mbr-section-title mbr-fonts-style align-center pb-3 display-6">Blood Amount Graph</h3>
                </div>
                <div class="card-body">
                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                </div>
            </div>

            <!-- Management Section -->
            <div class="card">
                <div class="card-heading" style="border-bottom:1px solid; width:96%; margin:auto">
                    <h3 class="card-title mbr-section-title mbr-fonts-style align-center pb-3 display-6">Management Section</h3>
                </div>
                <div class="card-body">
                    <a href="/staff/hr/registration">
                        <button type="button" class="btn btn-lg btn-primary">Registration</button>
                    </a>
                    <a href="/staff/hr/list/event">
                        <button type="button" class="btn btn-lg btn-primary">View Lists</button>
                    </a>
                    <a href="/staff/hr/report/summary">
                        <button type="button" class="btn btn-lg btn-primary">Reports</button>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('additionalJS')
    <script src={{"/assets/additional/js/canvasjs.js"}}></script>
    <script src={{"/assets/additional/js/bloodGraph.js"}}></script>
    <script>
        window.onload = renderGraph('{!! json_encode($data['totalBlood']) !!}');    //Encode blood type count into json data
    </script>
@endsection