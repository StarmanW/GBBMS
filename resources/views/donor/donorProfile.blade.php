@extends('donor.layout.baseTemplate')

@section('title', "Donor Profile")

@section('additionalCSS')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/default.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.min.css"/>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.rtl.min.css"/>
    <link rel="stylesheet" href="/assets/additional/css/registerForm.css" type="text/css">
    <link rel="stylesheet" href="/assets/additional/css/profile.css" type="text/css">
    <link rel="stylesheet" href="/assets/additional/css/notify.css" type="text/css">
@endsection

@section('contents')
    <section class="testimonials5 cid-qMsLJzqWLk" id="testimonials5-1v">
        <div class="mbr-overlay" style="opacity: 0.1; background-color:#000000;"></div>

        <div class="container">
            <div class="media-container-column">
                <div class="mbr-testimonial align-center col-12 col-md-10">
                    <div class="panel-item">
                        <div class="container">
                            <div class="media-container-row">
                                <div class="title col-12 align-center">
                                    <h2 class="pb-3 mbr-fonts-style display-2">Your User Profile</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="testimonial-photo">
                                <img src="/storage/profileImage/{{$donor->profileImage}}" alt="Profile Image"
                                     title="Profile Image"
                                     media-simple="true" id="profileImage">
                            </div>
                            <table class="table profile-table" cellspacing="0">
                                <tbody>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Donor ID</th>
                                    <td class="body-item mbr-fonts-style display-7"
                                        id="tDonorID">{{$donor->donorID}}</td>
                                </tr>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Name</th>
                                    <td class="body-item mbr-fonts-style display-7"
                                        id="tDonorName">{{$donor->firstName}} {{$donor->lastName}}</td>
                                </tr>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Password</th>
                                    <td class="body-item mbr-fonts-style display-7">
                                        <button data-toggle="modal" data-target="#changePasswordForm" type="button"
                                                name="edit" class="btn btn-sm btn-primary chgnPass-btn">Change
                                            Password
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">IC Number</th>
                                    <td class="body-item mbr-fonts-style display-7" id="tIcNum">{{$donor->ICNum}}</td>
                                </tr>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Gender</th>
                                    <td class="body-item mbr-fonts-style display-7"
                                        id="tGender">{{$donor->getGender()}}</td>
                                </tr>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Birth Date</th>
                                    <td class="body-item mbr-fonts-style display-7"
                                        id="tBirthDate">{{date_format(date_create($donor->birthDate), "d-M-Y")}}</td>
                                </tr>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Blood Type</th>
                                    <td class="body-item mbr-fonts-style display-7"
                                        id="tBloodType">{{$donor->getBloodTypeString()}}</td>
                                </tr>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Email Address</th>
                                    <td class="body-item mbr-fonts-style display-7"
                                        id="tEmail">{{$donor->emailAddress}}</td>
                                </tr>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Contact Number</th>
                                    <td class="body-item mbr-fonts-style display-7"
                                        id="tPhone">{{$donor->phoneNum}}</td>
                                </tr>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Home Address</th>
                                    <td class="body-item mbr-fonts-style display-7"
                                        id="tHomeAddress">{{$donor->homeAddress}}</td>
                                </tr>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Account Status</th>
                                    <td class="body-item mbr-fonts-style display-7"
                                        id="tAccStatus">{{$donor->getAccStatus()}}</td>
                                </tr>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Account Created at</th>
                                    <td class="body-item mbr-fonts-style display-7"
                                        id="tAccCreatedAt">{{date_format(date_create($donor->created_at), "d-M-Y h:i:s A")}}</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="container row mx-auto pb-2">
                                <div class="col-md-4 p-1">
                                    <a href="{{URL::previous()}}">
                                        <button type="button" class="btn btn-sm btn-primary btn-block">Back</button>
                                    </a>
                                </div>
                                <div class="col-md-4 p-1">
                                    <button data-toggle="modal" data-target="#updateProfileModal" type="button"
                                            name="edit" class="btn btn-sm btn-primary btn-block">Edit Profile
                                    </button>
                                </div>
                                <div class="col-md-4 p-1">
                                    <button type="button" name="delete" class="btn btn-sm btn-secondary btn-block"
                                            id="deactivateAcc">
                                        Deactivate Account
                                    </button>
                                    <form method="POST" action="/donor/profile/deactivate" id="deactivateDonorAcc"
                                          style="display: none;">
                                        {{csrf_field()}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update donor profile form modal -->
        <div class="modal fade" id="updateProfileModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
             aria-hidden="true">
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
                        <form id="updateProfileForm">
                            {{csrf_field()}}
                            <p style="color:red; float: left;">"*" Required fields</p>
                            <br/>
                            <br/>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label>
                                        <span style="color:red;">*</span>First Name</label>
                                    <input type="text" name="firstName" placeholder="John"
                                           value="{{$donor->firstName}}" class="form-control"
                                           pattern="^[A-z\-@ ]{2,255}$"
                                           title="Alphabetic, @ and - symbols only. E.g. - John"
                                           required="required">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>
                                        <span style="color:red;">*</span>Last Name</label>
                                    <input type="text" name="lastName" placeholder="Doe"
                                           value="{{$donor->lastName}}" class="form-control"
                                           pattern="^[A-z\-@ ]{2,255}$"
                                           title="Alphabetic, @ and - symbols only. E.g. - Smith"
                                           required="required">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label>
                                        <span style="color:red;">*</span>IC Number</label>
                                    <input type="text" name="ICNum" placeholder="981213125523"
                                           value="{{$donor->ICNum}}" class="form-control" pattern="^\d{12}$"
                                           title="Numeric only. E.g. 985564127789"
                                           maxlength="12" required="required">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>
                                        <span style="color:red;">*</span>Contact Number</label>
                                    <input type="text" name="phoneNum" placeholder="0186559875"
                                           value="{{$donor->phoneNum}}" class="form-control"
                                           pattern="^([0-9]|[0-9\-]){3,20}$"
                                           title="Numeric and '-' symbols only. E.g. 014-8897875"
                                           required="required">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label>
                                        <span style="color:red;">*</span>Email</label>
                                    <input type="email" name="emailAddress" placeholder="email@hotmail.com"
                                           value="{{$donor->emailAddress}}" class="form-control"
                                           pattern="^([A-z0-9_\-\.]+)@([A-z0-9_\-\.]+)\.([A-z]{2,5})$"
                                           title="E.g. - john@hotmail.com" required="required">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>
                                        <span style="color:red;">*</span>Birth Date</label>
                                    <input class="form-control" type="date" value="{{$donor->birthDate}}"
                                           name="birthDate" required="required">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label>
                                        <span style="color:red;">*</span>Blood Type</label>
                                    <select name="bloodType" class="form-control" required="required">
                                        <option disabled="disabled" selected="selected" value>Select blood type
                                        </option>
                                        <option value="1" {{ $donor->bloodType === 1 ? 'selected="selected"' : ''}}>
                                            A+
                                        </option>
                                        <option value="2" {{ $donor->bloodType === 2 ? 'selected="selected"' : ''}}>
                                            A-
                                        </option>
                                        <option value="3" {{ $donor->bloodType === 3 ? 'selected="selected"' : ''}}>
                                            B+
                                        </option>
                                        <option value="4" {{ $donor->bloodType === 4 ? 'selected="selected"' : ''}}>
                                            B-
                                        </option>
                                        <option value="5" {{ $donor->bloodType === 5 ? 'selected="selected"' : ''}}>
                                            O+
                                        </option>
                                        <option value="6" {{ $donor->bloodType === 6 ? 'selected="selected"' : ''}}>
                                            O-
                                        </option>
                                        <option value="7" {{ $donor->bloodType === 7 ? 'selected="selected"' : ''}}>
                                            AB+
                                        </option>
                                        <option value="8" {{ $donor->bloodType === 8 ? 'selected="selected"' : ''}}>
                                            AB-
                                        </option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label><span style="color:red;">*</span>Gender</label><br/>
                                    <input type="radio" name="gender" required="required"
                                           value="1" {{ $donor->gender === 1 ? 'checked="checked"' : 'checked="checked"' }}>&nbsp;&nbsp;Male&nbsp;&nbsp;
                                    <input type="radio" name="gender" required="required"
                                           value="0" {{ $donor->gender === 0 ? 'checked="checked"' : '' }}>&nbsp;&nbsp;Female<br>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>
                                        Profile Picture</label>
                                    <input name="profileImage" class="form-control" type="file">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label>
                                        <span style="color:red;">*</span>Home Address</label>
                                    <textarea required="required" name="homeAddress" class="form-control"
                                              style="height:200px;resize: none;">{{$donor->homeAddress}}</textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <button type="submit" class="btn btn-lg btn-success btn-block">Submit
                                    </button>
                                </div>
                                <div class="col-md-6 form-group">
                                    <button type="reset" class="btn btn-lg btn-primary btn-block">Reset
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Change Password form -->
        <div class="modal fade" id="changePasswordForm" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="lineModalLabel">Change Password</h3>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">Close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="updatePassForm">
                            {{csrf_field()}}
                            <p style="color:red; float: left;">"*" Required fields</p>
                            <br/>
                            <br/>
                            <div class="row">
                                <label><span style="color:red;">*</span> Current Password</label>
                                <input type="password" name="currentPassword" class="form-control"
                                       required="required">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="row">
                                <label><span style="color:red;">*</span> New Password</label>
                                <input type="password" name="newPassword" class="form-control" required="required">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="row">
                                <label><span style="color:red;">*</span> Confirm New Password</label>
                                <input type="password" name="newPassword_confirmation" class="form-control"
                                       required="required">
                                <div class="invalid-feedback"></div>
                            </div>
                            <br/>
                            <div class="col-md-8 mx-auto">
                                <button type="submit" class="btn btn-lg btn-success btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('additionalJS')
    <script src="/assets/additional/js/donor_profile.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
@endsection
