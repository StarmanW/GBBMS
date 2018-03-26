@extends('donor.layout.baseTemplate')

@section('title')
<title>Donor Profile</title>
@endsection

@section('additionalCSS')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/default.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.rtl.min.css" />
    <link rel="stylesheet" href="/assets/additional/css/scrollToTop.css" type="text/css">
    <link rel="stylesheet" href="/assets/additional/css/registerForm.css" type="text/css">
    <link rel="stylesheet" href="/assets/additional/css/profile.css" type="text/css">
    <link rel="stylesheet" href="/assets/additional/css/notify.css" type="text/css">
@endsection

@section('contents')
    <section class="testimonials5 cid-qMsLJzqWLk" id="testimonials5-1v">
        <div class="mbr-overlay" style="opacity: 0.1; background-color:#000000;"></div>
        <div class="container">
            <div class="media-container-row">
                <div class="title col-12 align-center">
                    <h2 class="pb-3 mbr-fonts-style display-1">
                        Your User Profile</h2>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="media-container-column">
                <div class="mbr-testimonial align-center col-12 col-md-10">
                    <div class="panel-item">
                        <div class="card-block">
                            <div class="testimonial-photo">
                                <img src="/storage/profileImage/{{$donor->profileImage}}" alt="" title="" media-simple="true">
                            </div>
                            <p class="mbr-text mbr-fonts-style mbr-white display-5"></p>

                            <div class="profile-table-wrap">
                                <table class="table profile-table" cellspacing="0">
                                    <tbody>
                                    <tr>
                                        <th class="body-item mbr-fonts-style display-7">Donor ID</th>
                                        <td class="body-item mbr-fonts-style display-7">{{$donor->donorID}}</td>
                                    </tr>
                                    <tr>
                                        <th class="body-item mbr-fonts-style display-7">Name</th>
                                        <td class="body-item mbr-fonts-style display-7">{{$donor->firstName}} {{$donor->lastName}}</td>
                                    </tr>
                                    <tr>
                                        <th class="body-item mbr-fonts-style display-7">Password</th>
                                        <td class="body-item mbr-fonts-style display-7">
                                            <button type="submit" class="btn btn-sm btn-primary profile-table-btn">Reset Password</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="body-item mbr-fonts-style display-7">IC Number</th>
                                        <td class="body-item mbr-fonts-style display-7">{{$donor->ICNum}}</td>
                                    </tr>
                                    <tr>
                                        <th class="body-item mbr-fonts-style display-7">Birth Date</th>
                                        <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($donor->birthDate), "d-M-Y")}}</td>
                                    </tr>
                                    <tr>
                                        <th class="body-item mbr-fonts-style display-7">Blood Type</th>
                                        <td class="body-item mbr-fonts-style display-7">{{$donor->getBloodTypeString()}}</td>
                                    </tr>
                                    <tr>
                                        <th class="body-item mbr-fonts-style display-7">Email Address</th>
                                        <td class="body-item mbr-fonts-style display-7">{{$donor->emailAddress}}</td>
                                    </tr>
                                    <tr>
                                        <th class="body-item mbr-fonts-style display-7">Contact Number</th>
                                        <td class="body-item mbr-fonts-style display-7">{{$donor->phoneNum}}</td>
                                    </tr>
                                    <tr>
                                        <th class="body-item mbr-fonts-style display-7">Home Address</th>
                                        <td class="body-item mbr-fonts-style display-7">{{$donor->homeAddress}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="card">
                                    <div class="card-body">
                                        <button data-toggle="modal" data-target="#squarespaceModal" type="button" name="edit" class="btn btn-sm btn-primary profile-btn">Edit Profile</button>
                                        <button type="button" name="delete" class="btn btn-sm btn-secondary profile-btn" onclick="deactivateDonorAccPrompt('Donor 1');">Deactivate Account</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- line modal -->
        <div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="lineModalLabel">Editing User Profile</h3>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">Close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="/donor/profile">
                            {{ csrf_field() }}
                            <p style="color:red; float: left;">"*" Required fields</p>
                            <br />
                            <br />
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label>
                                            <span style="color:red;">*</span>First Name</label>
                                        <input type="text" name="firstName" placeholder="John" value="{{$donor->firstName}}" class="form-control" pattern="[A-Za-z\-@ ]{2,}" title="Alphabetic, @ and - symbols only. E.g. - John" required="required">
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>
                                            <span style="color:red;">*</span>Last Name</label>
                                        <input type="text" name="lastName" placeholder="Doe" value="{{$donor->lastName}}" class="form-control" pattern="[A-Za-z\-@ ]{2,}" title="Alphabetic, @ and - symbols only. E.g. - Smith" required="required">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label>
                                            <span style="color:red;">*</span>IC Number</label>
                                        <input type="text" name="ICNum" placeholder="981213125523" value="{{$donor->ICNum}}" class="form-control" pattern="\d{12}" title="Numeric only. E.g. 985564127789"
                                               maxlength="12" required="required">
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>
                                            <span style="color:red;">*</span>Contact Number</label>
                                        <input type="text" name="phoneNum" placeholder="0186559875" value="{{$donor->phoneNum}}" class="form-control" pattern="([0-9]|[0-9\-]){3,20}" title="Numeric and '-' symbols only. E.g. 014-8897875"
                                               required="required">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label>
                                            <span style="color:red;">*</span>Email</label>
                                        <input type="email" name="emailAddress" placeholder="email@hotmail.com" value="{{$donor->emailAddress}}" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                                               title="E.g. - john@hotmail.com" required="required">
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <label>
                                            <span style="color:red;">*</span>Birth Date</label>
                                        <input class="form-control" type="date" value="{{$donor->birthDate}}" name="birthDate" required="required">
                                    </div>
                                </div>
                                <div class="row" style="margin:auto">
                                    <label>
                                        <span style="color:red;">*</span>Blood Type</label>
                                    <select name="bloodType" class="form-control" required="required">
                                        <option disabled selected value>Select blood type</option>
                                        <option value="1" @if($donor->bloodType === 1) {{"selected"}} @endif>A+</option>
                                        <option value="2" @if($donor->bloodType === 2) {{"selected"}} @endif>A-</option>
                                        <option value="3" @if($donor->bloodType === 3) {{"selected"}} @endif>B+</option>
                                        <option value="4" @if($donor->bloodType === 4) {{"selected"}} @endif>B-</option>
                                        <option value="5" @if($donor->bloodType === 5) {{"selected"}} @endif>O+</option>
                                        <option value="6" @if($donor->bloodType === 6) {{"selected"}} @endif>O-</option>
                                        <option value="7" @if($donor->bloodType === 7) {{"selected"}} @endif>AB+</option>
                                        <option value="8" @if($donor->bloodType === 8) {{"selected"}} @endif>AB-</option>
                                    </select>
                                </div>
                                <br>
                                <div class="row" style="margin:auto">
                                    <label>
                                        <span style="color:red;">*</span>Home Address</label>
                                    <textarea required="required" name="homeAddress" class="form-control" style="height:200px;resize: none;">{{$donor->homeAddress}}</textarea>
                                </div>
                            </div>
                            <br />
                            <div class="submit-button div-button-center">
                                <button type="submit" class="btn btn-lg btn-success profile-btn">Submit</button>
                                <button type="reset" class="btn btn-lg btn-primary profile-btn">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('additionalJS')
    <script src="/assets/additional/js/donor_util.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>

    @if(count($errors) > 0)
        <script>
            $('#squarespaceModal').modal('show');
            donorFormError('Empty/Invalid Data Entered', {!! $errors !!});
        </script>
    @elseif(session('success'))
        <script>donorUpdateProfileSuccess("{{session('success')}}");</script>
    @endif
@endsection
