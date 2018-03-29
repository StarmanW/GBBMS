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
        <div class="mbr-overlay" style="opacity: 0.2; background-color: black;"></div>
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
                                    <form method="POST" action="/donor/register" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <p style="color:red; float: left;">"*" Required fields</p>
                                        <br/>
                                        <br/>
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label>
                                                        <span style="color:red;">*</span>First Name</label>
                                                    <input type="text" name="firstName" placeholder="John" value="{{old('firstName')}}"
                                                           class="form-control" pattern="[A-Za-z\-@ ]{2,}"
                                                           title="Alphabetic, @ and - symbols only. E.g. - John"
                                                           required="required">
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label>
                                                        <span style="color:red;">*</span>Last Name</label>
                                                    <input type="text" name="lastName" placeholder="Doe" value="{{old('lastName')}}"
                                                           class="form-control" pattern="[A-Za-z\-@ ]{2,}"
                                                           title="Alphabetic, @ and - symbols only. E.g. - Smith"
                                                           required="required">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label>
                                                        <span style="color:red;">*</span>IC Number</label>
                                                    <input type="text" name="ICNum" placeholder="981213125523" value="{{old('ICNum')}}"
                                                           class="form-control" pattern="\d{12}"
                                                           title="Numeric only. E.g. 985564127789"
                                                           maxlength="12" required="required">
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label>
                                                        <span style="color:red;">*</span>Contact Number</label>
                                                    <input type="text" name="phoneNum" placeholder="0186559875" value="{{old('phoneNum')}}"
                                                           class="form-control" pattern="([0-9]|[0-9\-]){3,20}"
                                                           title="Numeric and '-' symbols only. E.g. 014-8897875"
                                                           required="required">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label>
                                                        <span style="color:red;">*</span>Email</label>
                                                    <input type="email" name="emailAddress" value="{{old('emailAddress')}}"
                                                           placeholder="email@hotmail.com" class="form-control"
                                                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                                                           title="E.g. - john@hotmail.com" required="required">
                                                </div>

                                                <div class="col-sm-6 form-group">
                                                    <label>
                                                        <span style="color:red;">*</span>Birth Date</label>
                                                    <input class="form-control" type="date" name="birthDate" value="{{old('birthDate')}}"
                                                           required="required">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label>
                                                        <span style="color:red;">*</span>Password</label>
                                                    <input type="password" name="password" id="password"
                                                           class="form-control" required="required">
                                                    <p style="font-size:15px">Minimum 6 words and maximum 255 words</p>
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
                                                    <option value="1" @if(old('bloodType') === 1) {{'selected'}}@endif>A+</option>
                                                    <option value="2" @if(old('bloodType') === 2) {{'selected'}}@endif>A-</option>
                                                    <option value="3" @if(old('bloodType') === 3) {{'selected'}}@endif>B+</option>
                                                    <option value="4" @if(old('bloodType') === 4) {{'selected'}}@endif>B-</option>
                                                    <option value="5" @if(old('bloodType') === 5) {{'selected'}}@endif>O+</option>
                                                    <option value="6" @if(old('bloodType') === 6) {{'selected'}}@endif>O-</option>
                                                    <option value="7" @if(old('bloodType') === 7) {{'selected'}}@endif>AB+</option>
                                                    <option value="8" @if(old('bloodType') === 8) {{'selected'}}@endif>AB-</option>
                                                </select>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label><span style="color:red;">*</span>Gender</label><br/>
                                                    <input type="radio" name="gender" required="required" value="1" @if(old('gender') === "1") {{'checked'}}@endif>&nbsp;&nbsp;Male&nbsp;&nbsp;
                                                    <input type="radio" name="gender" required="required" value="0" @if(old('gender') === "0") {{'checked'}}@endif>&nbsp;&nbsp;Female<br>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label>
                                                        Profile Picture</label>
                                                    <input name="profileImage" class="form-control" value="{{old('profileImage')}}" type="file">
                                                </div>
                                            </div>
                                            <div class="row" style="margin:auto">
                                                <label>
                                                    <span style="color:red;">*</span>Home Address</label>
                                                <textarea name="homeAddress" class="form-control" style="height:200px;resize: none;">{{old('homeAddress')}}</textarea>
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

    <div class="modal fade" id="requirementModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-center" style="display: block">
                    <h3 class="modal-title" id="lineModalLabel">Requirements</h3>
                </div>
                <div class="modal-body" style="padding: 20px">
                    According to the <b>National Blood Centre's (PDN) guidelines</b>, a person must be within the age of 18 to 60 years old for first-time donors, while the age limit extends to 65 years old for those who have donated blood previously.
                    <br/><br/>
                    Those who are 17 years old may donate blood but they would need to obtain a written consent from their parents or guardians.
                    <br/><br/>
                    <b>Other requirements include</b>:
                    <ul>
                        <li>Body weight of at least 45 kg.</li>
                        <li>In good physical and mental health with no chronic medical illness.</li>
                        <li>Not on long-term medications and has not been intoxicated by alcohol within 24 hours prior to donation.</li>
                        <li>Should not be fasting and have had enough sleep (minimum 5 hours) the night before donating.</li>
                    </ul>
                    <b>You're not allowed to donate blood if:</b>
                    <ul>
                        <li>You lived in the United Kindom (England, Northern Ireland, Scotland, Wales, Isle of Man or the Channel Islands) or the Republic of Ireland from 1980 to 1996 for a period of six months (cumulative) or more.</li>
                        <li>You have been living in Europe from 1980 to the present for a period of five years (accumulated) or more.</li>
                        <li>You are menstruating, pregnant, breastfeeding, or experienced a miscarriage six months prior to the donation.</li>
                    </ul>
                    <b>Additionally, a medical officer will also reject blood donation from those who are in a:</b>
                    <ul>
                        <li>Homosexual relationship</li>
                        <li>Bisexual relationship</li>
                        <li>Commercial sex relationship</li>
                        <li>Multiple sexual partners</li>
                        <li>Drug abuse (Intravenous)</li>
                        <li>Sexual contact with those mentioned above</li>
                    </ul>
                </div>
                <div class="submit-button">
                    <button class="btn btn-primary btn-sm" type="submit" class="close" data-dismiss="modal">Accept</button>
                    <button class="btn btn-secondary btn-sm" type="button" onclick="window.location.href = '/login';">Decline</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additionalJS')
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
    <script src="{{asset('/assets/additional/js/donor_util.js')}}"></script>

    <script>
        window.onload = $('#requirementModal').modal('show');
    </script>

    @if(count($errors) > 0)
        <script>donorFormError('Empty/Invalid Data Entered', {!! $errors !!});</script>
    @endif
@endsection