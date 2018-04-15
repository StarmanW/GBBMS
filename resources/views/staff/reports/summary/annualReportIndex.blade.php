@extends('staff.layout.baseTemplate-HR')

@section('title')
    <title>Summary Report</title>
@endsection

@section('additionalCSS')
    <link rel="stylesheet" href={{"/assets/datatables/data-tables.bootstrap4.min.css"}}>
    <link rel="stylesheet" href={{"/assets/additional/css/table-list.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/additional/css/registerForm.css"}} type="text/css">
@endsection

@section('contents')
    <!-- Page Content -->
    <section class="section-table cid-qMsKT09Rch" id="table1-1q">
        <div class="form-container container align-center" style="width:50%">
            <h2 class="well">Summary Report</h2>
            <hr style="border-top:1px solid gray;"/>
            <div class="col-lg-12 well">
                <div class="row">
                    <form method="POST" action="/staff/hr/report/summary">
                        {{ csrf_field() }}
                        <p style="color:red; float: left;">"*" Required fields</p>
                        <br/>
                        <br/>
                        <div class="col-sm-12">
                            @if(session('emptyRecord') === true)
                                <span style="color:red;">The selected year does not have any records found.</span>
                            @endif
                            <div class="row">
                                <label><span style="color:red;">*</span>Select Report</label>
                                <select name="report" class="form-control" required="required">
                                    <option disabled="disabled" selected="selected">Select a report</option>
                                    <option value="resvList">Reservation Report</option>
                                    <option value="blood">Bloods Donated</option>
                                </select>
                                @if($errors->has('reportType'))
                                    <span style="color:red;">Please select an appropriate report type</span>
                                @endif
                            </div>
                            <br/>
                            <div class="row">
                                <label><span style="color:red;">*</span>Select Year</label>
                                <select name="year" class="form-control" id="year" required="required">
                                    <option disabled="disabled" selected="selected" value id="defaultSelect">Select
                                        year
                                    </option>
                                </select>
                                @if($errors->has('year'))
                                    <span style="color:red;">Please select an appropriate year</span>
                                @endif
                            </div>
                            <br/>
                        </div>
                        <br/>
                        <div class="submit-button">
                            <button type="submit" class="btn btn-lg btn-success form-btn">View Report</button>
                            <button type="reset" class="btn btn-lg btn-primary form-btn">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('additionalJS')
    <script src={{"/assets/datatables/jquery.data-tables.min.js"}}></script>
    <script src={{"/assets/datatables/data-tables.bootstrap4.min.js"}}></script>
    <script>
        //Initialize year option
        $(document).ready(function () {
            var year = new Date().getFullYear();
            for (var i = 0; i <= (year - {{$eventTimeline}}); i++) {
                $("#year").append('<option value="' + (year - i) + '">' + (year - i) + '</option>');
            }
        });
    </script>
@endsection
