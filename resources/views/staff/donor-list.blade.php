@extends('staff.layout.baseTemplate-HR')

@section('title')
    <title>Donor List</title>
@endsection

@section('additionalCSS')
    <link rel="stylesheet" href={{"/assets/datatables/data-tables.bootstrap4.min.css"}}>
    <link rel="stylesheet" href={{"/assets/additional/css/table-list.css"}} type="text/css">
@endsection

@section('contents')
    <!-- /#sidebar-wrapper -->
    <section class="section-table cid-qMsKEFTWPJ" id="table1-1p">
        <div class="container container-table">
            <h3 class="mbr-section-subtitle mbr-fonts-style align-center pb-5 mbr-light display-5"></h3>
            <div class="table-backpanel">
                <h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-2">Donor List</h2>
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
                                <th class="head-item mbr-fonts-style display-7">Blood Type</th>
                                <th class="head-item mbr-fonts-style display-7">Phone</th>
                                <th class="head-item mbr-fonts-style display-7">Status</th>
                                <th class="head-item mbr-fonts-style display-7"></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($donors as $donor)
                                <tr>
                                    <td class="body-item mbr-fonts-style display-7">{{$donor->donorID}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{$donor->firstName}} {{$donor->lastName}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{$donor->getGender()}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{$donor->getBloodTypeString()}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{$donor->phoneNum}}</td>
                                    <td class="body-item mbr-fonts-style display-7">{{$donor->getAccStatus()}}</td>
                                    <td class="body-item mbr-fonts-style display-7">
                                        <a href="/staff/hr/list/donor/{{$donor->donorID}}">
                                            <i class="fa fa-bars" aria-hidden="true" title="Donor details"></i>
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
                <div class="container pagination" style="padding-bottom:2%;">
                    {{$donors->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('additionalJS')
    <script src={{"/assets/datatables/jquery.data-tables.min.js"}}></script>
    <script src={{"/assets/datatables/data-tables.bootstrap4.min.js"}}></script>
@endsection