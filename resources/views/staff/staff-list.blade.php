@extends('staff.layout.baseTemplate-HR')

@section('title')
    <title>Staff List</title>
@endsection

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
    <section class="section-table cid-qMsKT09Rch" id="table1-1q">
        <div class="container container-table">
            <h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-2">Staff List</h2>
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
                                <th class="head-item mbr-fonts-style display-7">Gender</th>
                                <th class="head-item mbr-fonts-style display-7">Position</th>
                                <th class="head-item mbr-fonts-style display-7">Email</th>
                                <th class="head-item mbr-fonts-style display-7">Phone</th>
                                <th class="head-item mbr-fonts-style display-7">Status</th>
                                <th class="head-item mbr-fonts-style display-7"></th>
                                <th class="head-item mbr-fonts-style display-7"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($staffs as $staff)
                                <tr>
                                    <td class="body-item mbr-fonts-style display-7">{{$staff->staffID}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{$staff->firstName}} {{$staff->lastName}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{$staff->getGender()}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{$staff->getStaffPosition()}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{$staff->emailAddress}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{$staff->phoneNum}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{$staff->getAccStatus()}}</td>
                                    <td class="body-item mbr-fonts-style display-7 button-column">
                                        <a href="/staff/hr/list/staff/{{$staff->staffID}}">
                                            <i class="fa fa-bars" aria-hidden="true" title="Staff details"></i>
                                        </a>
                                    </td>
                                    <td class="body-item mbr-fonts-style display-7 button-column">
                                        @if($staff->staffAccStatus===1)
                                        <a href="#" onclick="deactivateStaffAccPrompt('{{$staff->staffID}}', '{{$staff->firstName}} {{$staff->lastName}}');">
                                            <i class="fa fa-times" aria-hidden="true" title="Deactivate staff account"></i>
                                        </a>
                                        <form method="POST" action="/staff/hr/list/staff/{{$staff->staffID}}/deactivate" id="deactivateStaffAcc{{$staff->staffID}}" style="display: none;">
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
                    {{$staffs->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('additionalJS')
    <script src={{"/assets/datatables/jquery.data-tables.min.js"}}></script>
    <script src={{"/assets/datatables/data-tables.bootstrap4.min.js"}}></script>
    <script src={{"/assets/additional/js/staff_util.js"}}></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>

    @if(session('success'))
        <script>staffUpdateProfileSuccess("{{session('success')}}");</script>
    @elseif(session('failure'))
        <script>oneHRAcc("{{session('failure')}}");</script>
    @elseif(session('successHRDeactivate'))
        <script>staffAccDeactivationHR("{{session('successHRDeactivate')}}");</script>
    @elseif(session('failureHRDeactivate'))
        <script>staffAccDeactivationHR("{{session('failureHRDeactivate')}}");</script>
    @endif
@endsection
