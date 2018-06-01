@extends('staff.layout.baseTemplate-HR')

@section('title', "HR - Registration")

@section('additionalCSS')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/default.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.min.css"/>
    <link rel="stylesheet" href={{"/assets/additional/css/notify.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/additional/css/registerForm.css"}} type="text/css">
@endsection

@section('contents')
    <section class="cid-qLZoPtxl7o mbr-fullscreen mbr-parallax-background" id="header2-j">
        <div class="mbr-overlay" style="opacity: 0.1; background-color:#000000;"></div>

        <div class="container align-center">
            <div class="row justify-content-md-center">
                <div class="mbr-white col-md-10">
                    <div class="container align-center">
                        <br />
                        <br />
                        <div class="form-container">
                            <ul class="row nav nav-tabs">
                                <li class="active col-md-4" id="multitab-left">
                                    <a data-toggle="tab" href="#nurse" class="multitab-btn mbr-fonts-style align-center pb-3 display-6">Register Staff</a>
                                </li>
                                <li class="col-md-4" id="multitab-left">
                                    <a data-toggle="tab" href="#event" class="multitab-btn mbr-fonts-style align-center pb-3 display-6" style="padding:0;">Add New Event</a>
                                </li>
                                <li class="col-md-4">
                                    <a data-toggle="tab" href="#room" class="multitab-btn mbr-fonts-style align-center pb-3 display-6">Add New Room</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="nurse" class="tab-pane fade show active">
                                    <h1 class="well mbr-section-title mbr-fonts-style align-center display-2">Register Staff</h1>
                                    <hr style="border-top:1px solid gray;" />
                                    <form id="addStaffForm">
                                        {{ csrf_field() }}
                                        <p style="color:red; float: left;">"*" Required fields</p>
                                        <br />
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-6 form-group">
                                                <label>
                                                    <span style="color:red;">*</span>First Name</label>
                                                <input type="text" name="firstName" placeholder="John" class="form-control" pattern="[A-z\-@ ]{2,}" title="Alphabetic, @ and - symbols only. E.g. - John"
                                                    required="required">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-sm-6 form-group">
                                                <label>
                                                    <span style="color:red;">*</span>Last Name</label>
                                                <input type="text" name="lastName" placeholder="Doe" class="form-control" pattern="[A-z\-@ ]{2,}" title="Alphabetic, @ and - symbols only. E.g. - Smith"
                                                    required="required">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 form-group">
                                                <label>
                                                    <span style="color:red;">*</span>IC Number</label>
                                                <input type="text" name="ICNum" placeholder="981213125523" class="form-control" pattern="\d{12}" title="Numeric only. E.g. 985564127789"
                                                    maxlength="12" required="required">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-sm-6 form-group">
                                                <label>
                                                    <span style="color:red;">*</span>Contact Number</label>
                                                <input type="text" name="phoneNum" placeholder="0186559875" class="form-control" pattern="([0-9]|[0-9\-]){3,20}" title="Numeric and '-' symbols only. E.g. 014-8897875"
                                                    required="required">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 form-group">
                                                <label>
                                                    <span style="color:red;">*</span>Email</label>
                                                <input type="email" name="emailAddress" placeholder="email@hotmail.com" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                                                    title="E.g. - john@hotmail.com" required="required">
                                                <div class="invalid-feedback"></div>
                                            </div>

                                            <div class="col-sm-6 form-group">
                                                <label>
                                                    <span style="color:red;">*</span>Birth Date</label>
                                                <input class="form-control" type="date" name="birthDate" required="required">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 form-group">
                                                <label><span style="color:red;">*</span>Gender</label><br/>
                                                <input type="radio" name="gender" required="required" value="1" checked="checked">&nbsp;&nbsp;Male&nbsp;&nbsp;
                                                <input type="radio" name="gender" required="required" value="0">&nbsp;&nbsp;Female<br>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-sm-6 form-group">
                                                <label>
                                                    Profile Picture</label>
                                                <input name="profileImage" class="form-control" value="" type="file">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label>
                                                    <span style="color:red;">*</span>Staff Position</label>
                                                <select name="staffPos" class="form-control" required="required">
                                                    <option disabled="disabled" selected="selected" value>Select staff position</option>
                                                    <option value="0" selected="selected">Nurse</option>
                                                    <option value="1">Human Resource Manager</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label>
                                                    <span style="color:red;">*</span>Home Address</label>
                                                <textarea name="homeAddress" class="form-control" required="required" style="height:200px;resize: none;"></textarea>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <button type="submit" class="btn btn-lg btn-success btn-block">Submit</button>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <button type="reset" class="btn btn-lg btn-primary btn-block">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="event" class="tab-pane fade">
                                    <h1 class="well mbr-section-title mbr-fonts-style align-center display-2">New Blood Donation Event</h1>
                                    <hr style="border-top:1px solid gray;" />
                                    <form id="addEventForm">
                                        {{ csrf_field() }}
                                        <p style="color:red; float: left;">"*" Required fields</p>
                                        <br />
                                        <br />
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label>
                                                    <span style="color:red;">*</span>Event Name</label>
                                                <input type="text" name="eventName" placeholder="Blood Drive Donation 2018" class="form-control" pattern="[A-z0-9\-@ ]{2,}" title="Alphabetic, @ and - symbols only. E.g. - Blood Drive Donation 2018"
                                                    required="required">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label>
                                                    <span style="color:red;">*</span>Event Date</label>
                                                <input class="form-control" type="date" name="eventDate" id="eventDate" required="required">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label>
                                                    <span style="color:red;">*</span>Start Time</label>
                                                <input class="form-control" type="time" name="eventStartTime" id="eventStartTime" required="required">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>
                                                    <span style="color:red;">*</span>End Time</label>
                                                <input class="form-control" type="time" name="eventEndTime" id="eventEndTime" required="required">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12  form-group">
                                                <label>
                                                    <span style="color:red;">*</span>Room</label>
                                                <select name="roomID" class="form-control" required="required">
                                                    <option disabled="disabled" selected="selected" value>Select Room Number</option>
                                                    @foreach($rooms as $room)
                                                        <option value="{{$room->roomID}}">Room {{$room->roomID}} (Floor {{$room->floor}}, Quadrant {{$room->quadrant}} - Room {{substr($room->roomID, 3)}})</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <button type="submit" class="btn btn-lg btn-success btn-block">Submit</button>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <button type="reset" class="btn btn-lg btn-primary btn-block">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="room" class="tab-pane fade">
                                    <h1 class="well mbr-section-title mbr-fonts-style align-center display-2">New Room</h1>
                                    <hr style="border-top:1px solid gray;" />
                                    <form id="addRoomForm">
                                        {{ csrf_field() }}
                                        <p style="color:red; float: left;">"*" Required fields</p>
                                        <br /><br />
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label>
                                                    <span style="color:red;">*</span>Room No.</label>
                                                <input class="form-control" type="number" value="" min="0" name="roomNo" id="roomNo" required="required">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 form-group">
                                                <label>
                                                    <span style="color:red;">*</span>Quadrant</label>
                                                <input class="form-control" type="number" value="" min="0" max="4" name="quadrant" id="quadrant" required="required">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-sm-6 form-group">
                                                <label>
                                                    <span style="color:red;">*</span>Floor</label>
                                                <input class="form-control" type="number" value="" min="0" name="floor" id="floor" required="required">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <button type="submit" class="btn btn-lg btn-success btn-block">Submit</button>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <button type="reset" class="btn btn-lg btn-primary btn-block">Reset</button>
                                            </div>
                                        </div>
                                    </form>
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
    <script src="{{'/assets/additional/js/hr_registration_util.js'}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
@endsection
