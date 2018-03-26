@extends('staff.layout.baseTemplate-HR')

@section('title')
    <title>HR - Registration</title>
@endsection

@section('additionalCSS')
    <link rel="stylesheet" href="/assets/additional/css/scrollToTop.css" type="text/css">
    <link rel="stylesheet" href="/assets/additional/css/registerForm.css" type="text/css">
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
                                <li class="active col-md-6" id="multitab-left">
                                    <a data-toggle="tab" href="#nurse" class="multitab-btn">Register Nurse</a>
                                </li>
                                <li class="col-md-6">
                                    <a data-toggle="tab" href="#event" class="multitab-btn">Add New Blood Donation Event</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="nurse" class="tab-pane fade show active">
                                    <h1 class="well">Register Nurse</h1>
                                    <hr style="border-top:1px solid gray;" />
                                    <div class="col-lg-12 well">
                                        <div class="row">
                                            <form method="POST" action="">
                                                <p style="color:red; float: left;">"*" Required fields</p>
                                                <br />
                                                <br />
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-6 form-group">
                                                            <label>
                                                                <span style="color:red;">*</span>First Name</label>
                                                            <input type="text" name="firstName" placeholder="John" class="form-control" pattern="[A-Za-z\-@ ]{2,}" title="Alphabetic, @ and - symbols only. E.g. - John"
                                                                required="required">
                                                        </div>
                                                        <div class="col-sm-6 form-group">
                                                            <label>
                                                                <span style="color:red;">*</span>Last Name</label>
                                                            <input type="text" name="lastName" placeholder="Doe" class="form-control" pattern="[A-Za-z\-@ ]{2,}" title="Alphabetic, @ and - symbols only. E.g. - Smith"
                                                                required="required">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6 form-group">
                                                            <label>
                                                                <span style="color:red;">*</span>IC Number</label>
                                                            <input type="text" name="ICNum" placeholder="981213125523" class="form-control" pattern="\d{12}" title="Numeric only. E.g. 985564127789"
                                                                maxlength="12" required="required">
                                                        </div>
                                                        <div class="col-sm-6 form-group">
                                                            <label>
                                                                <span style="color:red;">*</span>Contact Number</label>
                                                            <input type="text" name="phoneNum" placeholder="0186559875" class="form-control" pattern="([0-9]|[0-9\-]){3,20}" title="Numeric and '-' symbols only. E.g. 014-8897875"
                                                                required="required">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6 form-group">
                                                            <label>
                                                                <span style="color:red;">*</span>Email</label>
                                                            <input type="email" name="emailAddress" placeholder="email@hotmail.com" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                                                                title="E.g. - john@hotmail.com" required="required">
                                                        </div>

                                                        <div class="col-sm-6 form-group">
                                                            <label>
                                                                <span style="color:red;">*</span>Birth Date</label>
                                                            <input class="form-control" type="date" name="birthDate" required="required">
                                                        </div>
                                                    </div>
                                                    <div class="row" style="margin:auto">
                                                        <label>
                                                            <span style="color:red;">*</span>Position</label>
                                                        <select name="staffPos" class="form-control" required="required">
                                                            <option disabled selected value>Select member position</option>
                                                            <option value="1">Human Resource Manager</option>
                                                            <option value="0">Nurse</option>
                                                        </select>
                                                    </div>
                                                    <br>
                                                    <div class="row" style="margin:auto">
                                                        <label>
                                                            <span style="color:red;">*</span>Home Address</label>
                                                        <textarea name="homeAddress" class="form-control" style="height:200px;resize: none;"></textarea>
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
                                            <form method="POST" action="">
                                                <p style="color:red; float: left;">"*" Required fields</p>
                                                <br />
                                                <br />
                                                <div class="col-sm-12">
                                                    <div class="row" style="margin:auto">
                                                        <label>
                                                            <span style="color:red;">*</span>Event Name</label>
                                                        <input type="text" name="fName" placeholder="John" class="form-control" pattern="[A-Za-z\-@ ]{2,}" title="Alphabetic, @ and - symbols only. E.g. - John"
                                                            required="required">
                                                    </div>
                                                    <br>
                                                    <div class="row" style="margin:auto">
                                                        <label>
                                                            <span style="color:red;">*</span>Event Date</label>
                                                        <input class="form-control" type="date" name="eventDate" id="eventDate" required="required">
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-sm-6 form-group">
                                                            <label>
                                                                <span style="color:red;">*</span>Start Time</label>
                                                            <input class="form-control" type="time" name="eventStartTime" id="eventStartTime">
                                                        </div>
                                                        <div class="col-sm-6 form-group">
                                                            <label>
                                                                <span style="color:red;">*</span>End Time</label>
                                                            <input class="form-control" type="time" name="eventEndTime" id="eventEndTime">
                                                        </div>
                                                    </div>
                                                    <div class="row" style="margin:auto">
                                                        <label>
                                                            <span style="color:red;">*</span>Room</label>
                                                        <select name="position" class="form-control" required="required">
                                                            <option disabled selected value>Select Room Number</option>
                                                            <option value="5">Room 1-4</option>
                                                            <option value="4">Room 1-8</option>
                                                            <option value="3">Room 1-12</option>
                                                            <option value="2">Room 1-16</option>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('additionalJS')
    <script src="/assets/additional/js/noBackDate.js"></script>
@endsection
