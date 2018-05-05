@extends('staff.layout.baseTemplate-HR')

@section('title', "Transaction Report")

@section('additionalCSS')
    <link rel="stylesheet" href="/assets/datatables/data-tables.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/additional/css/table-list.css" type="text/css">
    <link rel="stylesheet" href="/assets/additional/css/registerForm.css" type="text/css">
@endsection

@section('contents')
    <!-- Page Content -->
    <section class="section-table cid-qMsKT09Rch" id="table1-1q">

        <div class="form-container container align-center" style="width:50%">
            <h2 class="well pb-3 mbr-fonts-style display-2">Reservation Report</h2>
            <h2 class="well pb-3 mbr-fonts-style display-5">Select an Event</h2>
            <hr style="border-top:1px solid gray;"/>
            <div class="col-lg-12 well">
                <div class="row">
                    <form method="POST" action="/staff/hr/report/transaction">
                        {{ csrf_field() }}
                        <p style="color:red; float: left;">"*" Required fields</p>
                        <br/>
                        <br/>
                        <div class="col-sm-12">
                            @if($errors->has('eventID'))
                                <span style="color:red;">Please select an appropriate event</span>
                            @elseif(session('emptyResv') === true)
                                <span style="color:red;">The selected event does not have any reservation made yet.</span>
                            @endif
                            <div class="row">
                                <label><span style="color:red;">*</span>Event</label>
                                <select name="eventID" class="form-control" required="required">
                                    <option disabled selected value>Select an event</option>
                                    @foreach($events as $event)
                                        <option value="{{$event->eventID}}">{{$event->eventID}}
                                            - {{html_entity_decode($event->eventName, ENT_QUOTES, 'UTF-8')}}</option>
                                    @endforeach
                                </select>
                            </div>
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
    <script src="/assets/datatables/jquery.data-tables.min.js"></script>
    <script src="/assets/datatables/data-tables.bootstrap4.min.js"></script>
@endsection
