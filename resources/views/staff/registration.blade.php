@extends('staff.layout.baseTemplate-HR')

@section('title')
    <title>HR - Registration</title>
@endsection

@section('additionalCSS')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/default.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.min.css"/>
    <link rel="stylesheet" href={{"/assets/additional/css/notify.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/additional/css/registerForm.css"}} type="text/css">
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
                            <ul class="row nav nav-tabs">
                                <li class="active col-md-4" id="multitab-left">
                                    <a data-toggle="tab" href="#nurse" class="multitab-btn">Register Staff</a>
                                </li>
                                <li class="col-md-4" id="multitab-left">
                                    <a data-toggle="tab" href="#event" class="multitab-btn" style="padding:0;">Add New Blood Donation Event</a>
                                </li>
                                <li class="col-md-4">
                                    <a data-toggle="tab" href="#room" class="multitab-btn">Add New Room</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="nurse" class="tab-pane fade show active">
                                    <h1 class="well">Register Staff</h1>
                                    <hr style="border-top:1px solid gray;" />
                                    <div class="col-lg-12 well">
                                        <div class="row">
                                            <form method="POST" action="/staff/hr/registration">
                                                {{ csrf_field() }}
                                                <p style="color:red; float: left;">"*" Required fields</p>
                                                <br />
                                                <br />
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-6 form-group">
                                                            <label>
                                                                <span style="color:red;">*</span>First Name</label>
                                                            <input type="text" name="firstName" placeholder="John" value="{{old('firstName')}}" class="form-control" pattern="[A-Za-z\-@ ]{2,}" title="Alphabetic, @ and - symbols only. E.g. - John"
                                                                required="required">
                                                        </div>
                                                        <div class="col-sm-6 form-group">
                                                            <label>
                                                                <span style="color:red;">*</span>Last Name</label>
                                                            <input type="text" name="lastName" placeholder="Doe" value="{{old('lastName')}}" class="form-control" pattern="[A-Za-z\-@ ]{2,}" title="Alphabetic, @ and - symbols only. E.g. - Smith"
                                                                required="required">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6 form-group">
                                                            <label>
                                                                <span style="color:red;">*</span>IC Number</label>
                                                            <input type="text" name="ICNum" placeholder="981213125523" value="{{old('ICNum')}}" class="form-control" pattern="\d{12}" title="Numeric only. E.g. 985564127789"
                                                                maxlength="12" required="required">
                                                        </div>
                                                        <div class="col-sm-6 form-group">
                                                            <label>
                                                                <span style="color:red;">*</span>Contact Number</label>
                                                            <input type="text" name="phoneNum" placeholder="0186559875" value="{{old('phoneNum')}}" class="form-control" pattern="([0-9]|[0-9\-]){3,20}" title="Numeric and '-' symbols only. E.g. 014-8897875"
                                                                required="required">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6 form-group">
                                                            <label>
                                                                <span style="color:red;">*</span>Email</label>
                                                            <input type="email" name="emailAddress" placeholder="email@hotmail.com" value="{{old('emailAddress')}}" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                                                                title="E.g. - john@hotmail.com" required="required">
                                                        </div>

                                                        <div class="col-sm-6 form-group">
                                                            <label>
                                                                <span style="color:red;">*</span>Birth Date</label>
                                                            <input class="form-control" type="date" value="{{old('birthDate')}}" name="birthDate" required="required">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6 form-group">
                                                            <label><span style="color:red;">*</span>Gender</label><br/>
                                                            <input type="radio" name="gender" required="required" value="1" @if(old('gender') === "1") {{'checked="checked"'}}@else{{'checked="checked"'}}@endif>&nbsp;&nbsp;Male&nbsp;&nbsp;
                                                            <input type="radio" name="gender" required="required" value="0" @if(old('gender') === "0") {{'checked="checked"'}}@endif>&nbsp;&nbsp;Female<br>
                                                        </div>
                                                        <div class="col-sm-6 form-group">
                                                            <label>
                                                                Profile Picture</label>
                                                            <input name="profileImage" class="form-control" value="{{old('profileImage')}}" type="file">
                                                        </div>
                                                    </div>
                                                    <div class="row" style="margin:auto">
                                                        <label>
                                                            <span style="color:red;">*</span>Staff Position</label>
                                                        <select name="staffPos" class="form-control" required="required">
                                                            <option disabled="disabled" selected="selected" value>Select staff position</option>
                                                            <option value="0" selected @if(old('staffPos') === "0") {{'selected="selected"'}}@endif>Nurse</option>
                                                            <option value="1" @if(old('staffPos') === "1") {{'selected="selected"'}}@endif>Human Resource Manager</option>
                                                        </select>
                                                    </div>
                                                    <br>
                                                    <div class="row" style="margin:auto">
                                                        <label>
                                                            <span style="color:red;">*</span>Home Address</label>
                                                        <textarea name="homeAddress" class="form-control" required="required" style="height:200px;resize: none;">{{old('homeAddress')}}</textarea>
                                                    </div>
                                                </div>
                                                <br />
                                                <div class="submit-button">
                                                    <button type="submit" class="btn btn-lg btn-success form-btn">Submit</button>
                                                    <button type="reset" class="btn btn-lg btn-primary form-btn">Reset</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="event" class="tab-pane fade">
                                    <h1 class="well">New Blood Donation Event</h1>
                                    <hr style="border-top:1px solid gray;" />
                                    <div class="col-lg-12 well">
                                        <div class="row">
                                            <form method="POST" action="/staff/hr/registration/event">
                                                {{ csrf_field() }}
                                                <p style="color:red; float: left;">"*" Required fields</p>
                                                <br />
                                                <br />
                                                <div class="col-sm-12">
                                                    <div class="row" style="margin:auto">
                                                        <label>
                                                            <span style="color:red;">*</span>Event Name</label>
                                                        <input type="text" value="{{old('eventName')}}" name="eventName" placeholder="Blood Drive Donation 2018" class="form-control" pattern="[A-Za-z0-9\-@\! ]{2,}" title="Alphabetic, @ and - symbols only. E.g. - Blood Drive Donation 2018"
                                                            required="required">
                                                    </div>
                                                    <br>
                                                    <div class="row" style="margin:auto">
                                                        <label>
                                                            <span style="color:red;">*</span>Event Date</label>
                                                        <input class="form-control" value="{{old('eventDate')}}" type="date" name="eventDate" id="eventDate" required="required">
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-sm-6 form-group">
                                                            <label>
                                                                <span style="color:red;">*</span>Start Time</label>
                                                            <input class="form-control" value="{{old('eventStartTime')}}" type="time" name="eventStartTime" id="eventStartTime" required="required">
                                                        </div>
                                                        <div class="col-sm-6 form-group">
                                                            <label>
                                                                <span style="color:red;">*</span>End Time</label>
                                                            <input class="form-control" value="{{old('eventEndTime')}}" type="time" name="eventEndTime" id="eventEndTime" required="required">
                                                        </div>
                                                    </div>
                                                    <div class="row" style="margin:auto">
                                                        <label>
                                                            <span style="color:red;">*</span>Room</label>
                                                        <select name="roomID" class="form-control" required="required">
                                                            <option disabled="disabled" selected="selected" value>Select Room Number</option>
                                                            @foreach($rooms as $room)
                                                                <option value="{{$room->roomID}}" @if(old('roomID') === $room->roomID) {{'selected="selected"'}} @endif>Room {{$room->roomID}} (Floor {{$room->floor}}, Quadrant {{$room->quadrant}} - Room {{substr($room->roomID, 3)}})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <br />
                                                <div class="submit-button">
                                                    <button type="submit" class="btn btn-lg btn-success form-btn">Submit</button>
                                                    <button type="reset" class="btn btn-lg btn-primary form-btn">Reset</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="room" class="tab-pane fade">
                                    <h1 class="well">New Room</h1>
                                    <hr style="border-top:1px solid gray;" />
                                    <div class="col-lg-12 well">
                                        <div class="row">
                                            <form method="POST" action="/staff/hr/registration/room">
                                                {{ csrf_field() }}
                                                <p style="color:red; float: left;">"*" Required fields</p>
                                                <br />
                                                <br />
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                            <label>
                                                                <span style="color:red;">*</span>Room No.</label>
                                                            <input class="form-control" type="number" value="{{old('roomNo')}}" min="0" name="roomNo" id="roomNo" required="required">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6 form-group">
                                                            <label>
                                                                <span style="color:red;">*</span>Quadrant</label>
                                                            <input class="form-control" type="number" value="{{old('quadrant')}}" min="0" max="4" name="quadrant" id="quadrant" required="required">
                                                        </div>
                                                        <div class="col-sm-6 form-group">
                                                            <label>
                                                                <span style="color:red;">*</span>Floor</label>
                                                            <input class="form-control" type="number" value="{{old('floor')}}" min="0" name="floor" id="floor" required="required">
                                                        </div>
                                                    </div>
                                                <br />
                                                <div class="submit-button">
                                                    <button type="submit" class="btn btn-lg btn-success form-btn">Submit</button>
                                                    <button type="reset" class="btn btn-lg btn-primary form-btn">Reset</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('additionalJS')
    <script src={{"/assets/additional/js/noBackDate.js"}}></script>
    <script src="{{'/assets/additional/js/donor_util.js'}}"></script>
    <script src="{{'/assets/additional/js/hr_registration_util.js'}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>

    @if(session('eventTab'))
        <script>
            $('#nurse').removeClass('active show');
            $('#event').addClass('active show');
            @php session()->forget('eventTab'); @endphp
        </script>
    @elseif(session('roomTab'))
        <script>
            $('#nurse').removeClass('active show');
            $('#room').addClass('active show');
            @php session()->forget('roomTab'); @endphp
        </script>
    @endif

    @if(count($errors) > 0)
        <script>donorFormError('Empty/Invalid Data Entered', {!! $errors !!});</script>
    @elseif(session('success'))
        <script>registrationSuccess('{{session('success')}}')</script>
    @elseif(session('roomAddFailed'))
        <script>roomAddFailure('{{session('roomAddFailed')}}')</script>
    @elseif(session('roomAddDup'))
        <script>roomAddDuplicated('{{session('roomAddDup')}}')</script>
    @elseif(session('occupiedRoom'))
        <script>occupiedRoom('{{session('occupiedRoom')}}')</script>
    @endif
@endsection
