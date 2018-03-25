@extends('baseTemplates')

@section('title')
    <title>Register Donor</title>
@endsection

@section('additionalCSS')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/default.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.min.css"/>
    <link rel="stylesheet" href="{{'/assets/additional/css/registerForm.css'}}" type="text/css">
    <link rel="stylesheet" href="{{'/assets/additional/css/notify.css'}}" type="text/css">
@endsection
@section('contents')
    <section class="header4 cid-qM5bcKLKIf mbr-fullscreen mbr-parallax-background" id="header4-z">
        <div class="container align-center">
            <div class="row justify-content-md-center">
                <div class="mbr-white col-md-10">
                    <div class="container align-center">
                        <br/>
                        <br/>
                        <div class="form-container">
                            <h1 class="well">Register as New Donor</h1>
                            <hr style="border-top:1px solid gray;"/>
                            <div class="col-lg-12 well">
                                <div class="row">
                                    <form method="POST" action="/donor/register">
                                        {{ csrf_field() }}
                                        <p style="color:red; float: left;">"*" Required fields</p>
                                        <br/>
                                        <br/>
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label>
                                                        <span style="color:red;">*</span>First Name</label>
                                                    <input type="text" name="firstName" placeholder="John"
                                                           class="form-control" pattern="[A-Za-z\-@ ]{2,}"
                                                           title="Alphabetic, @ and - symbols only. E.g. - John"
                                                           required="required">
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label>
                                                        <span style="color:red;">*</span>Last Name</label>
                                                    <input type="text" name="lastName" placeholder="Doe"
                                                           class="form-control" pattern="[A-Za-z\-@ ]{2,}"
                                                           title="Alphabetic, @ and - symbols only. E.g. - Smith"
                                                           required="required">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label>
                                                        <span style="color:red;">*</span>IC Number</label>
                                                    <input type="text" name="ICNum" placeholder="981213125523"
                                                           class="form-control" pattern="\d{12}"
                                                           title="Numeric only. E.g. 985564127789"
                                                           maxlength="12" required="required">
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label>
                                                        <span style="color:red;">*</span>Contact Number</label>
                                                    <input type="text" name="phoneNum" placeholder="0186559875"
                                                           class="form-control" pattern="([0-9]|[0-9\-]){3,20}"
                                                           title="Numeric and '-' symbols only. E.g. 014-8897875"
                                                           required="required">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label>
                                                        <span style="color:red;">*</span>Email</label>
                                                    <input type="email" name="emailAddress"
                                                           placeholder="email@hotmail.com" class="form-control"
                                                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                                                           title="E.g. - john@hotmail.com" required="required">
                                                </div>

                                                <div class="col-sm-6 form-group">
                                                    <label>
                                                        <span style="color:red;">*</span>Birth Date</label>
                                                    <input class="form-control" type="date" name="birthDate"
                                                           required="required">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label>
                                                        <span style="color:red;">*</span>Password</label>
                                                    <input type="password" name="password" id="password"
                                                           class="form-control" required="required">
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label>
                                                        <span style="color:red;">*</span>Confirm Password</label>
                                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                                           class="form-control" required="required">
                                                </div>
                                            </div>
                                            <div class="row" style="margin:auto">
                                                <label>
                                                    <span style="color:red;">*</span>Blood Type</label>
                                                <select name="bloodType" class="form-control" required="required">
                                                    <option disabled selected value>Select blood type</option>
                                                    <option value="1">A+</option>
                                                    <option value="2">A-</option>
                                                    <option value="3">B+</option>
                                                    <option value="4">B-</option>
                                                    <option value="5">O+</option>
                                                    <option value="6">O-</option>
                                                    <option value="7">AB+</option>
                                                    <option value="8">AB-</option>
                                                </select>
                                            </div>
                                            <br>
                                            <div class="row" style="margin:auto">
                                                <label>
                                                    <span style="color:red;">*</span>Home Address</label>
                                                <textarea name="homeAddress" class="form-control"
                                                          style="height:200px;resize: none;"></textarea>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="submit-button">
                                            <button type="submit" class="btn btn-lg btn-success form-btn">Submit
                                            </button>
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
    </section>
@endsection

@section('additionalJS')
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
    <script src="{{asset('/assets/additional/js/donor_util.js')}}"></script>
    @if(count($errors) > 0)
        <script>donorRegisterError('Empty/Invalid Data Entered', {!! $errors !!});</script>
    @endif
@endsection