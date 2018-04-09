@extends('staff.layout.baseTemplate-Nurse')

@section('title')
    <title>Blood Management</title>
@endsection

@section('additionalCSS')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/default.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.rtl.min.css" />
    <link rel="stylesheet" href={{"/assets/additional/css/registerForm.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/additional/css/notify.css"}} type="text/css">
@endsection

@section('contents')
    <section class="cid-qLZoPtxl7o mbr-fullscreen mbr-parallax-background" id="header2-j">
        <div class="container align-center">
            <div class="row justify-content-md-center">
                <div class="mbr-white col-md-10">
                    <div class="container align-center">
                        <br />
                        <br />
                        <div class="form-container">
                            <h1 class="well">Blood Managememt</h1>
                            <hr style="border-top:1px solid gray;" />
                            <div class="col-lg-12 well">
                                <div class="row">
                                    <form method="POST" action="./manage-blood">
                                        {{csrf_field()}}
                                        <p style="color:red; float: left;">"*" Required fields</p>
                                        <br />
                                        <br />
                                        <div class="col-sm-12">
                                            <div class="row" style="margin:auto">
                                                <label>
                                                    <span style="color:red;">*</span>Blood Bag ID</label>
                                                <input type="text" name="bloodBagID" placeholder="NAN160001" class="form-control"
                                                       pattern="^((NAP)|(NAN)|(NBP)|(NBN)|(NOP)|(NON)|(ABP)|(ABN))(\d{6})$" title="Blood type, followed by year and 4 numbers"
                                                       required="required">
                                            </div>
                                            <br>
                                            <div class="row" style="margin:auto">
                                                <label>
                                                    <span style="color:red;">*</span>Donor ID</label>
                                                    <select name="donorID" class="form-control" required="required">
                                                        <option>Select a donor ID</option>
                                                        @foreach($data['donors'] as $donor)
                                                            <option value="{{$donor->donorID}}">{{$donor->donorID}} ({{$donor->firstName}} {{$donor->lastName}})</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label>
                                                        <span style="color:red;">*</span>Donated Blood Volume (mL)</label>
                                                    <input class="form-control" type="number" min="0" max="500" name="bloodVol" placeholder="450">
                                                </div>
                                            </div>
                                            <div class="row" style="margin:auto">
                                                <label>Remarks</label>
                                                <textarea class="form-control" name="remarks"></textarea>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="submit-button">
                                            <button type="submit" class="btn btn-lg btn-success form-btn">Submit</button>
                                            <button type="reset" class="btn btn-lg btn-primary form-btn">Reset</button>
                                            <button type="button" class="btn btn-lg btn-secondary form-btn conclude-btn" onclick="$('#concludeEvent').submit();">Conclude Event</button>                                        </div>
                                    </form>
                                    <form method="POST" action="/staff/nurse/event/{{$data['eventID']}}/conclude" id="concludeEvent" style="display:none;">
                                        {{csrf_field()}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @php session(['eventID' => $data['eventID']])@endphp
@endsection

@section('additionalJS')
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
    <script src="/assets/additional/js/blood_management.js"></script>

    @if(count($errors) > 0)
        <script>bloodManagementFormErr('Empty/Invalid Data Entered', {!! $errors !!});</script>
    @endif
@endsection