@extends(((Auth::user()->staffPos === 1) ? 'staff.layout.baseTemplate-HR' : 'staff.layout.baseTemplate-Nurse'))

@section('title', "Staff Profile")

@section('additionalCSS')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/default.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.min.css"/>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.rtl.min.css"/>
    <link rel="stylesheet" href={{"/assets/additional/css/registerForm.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/additional/css/profile.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/additional/css/notify.css"}} type="text/css">
@endsection

@section('contents')
    <section class="testimonials5 cid-qMsL85WpiQ" id="testimonials5-1u">
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
                                <img src="/storage/profileImage/{{$staff->profileImage}}" alt="Profile Image"
                                     title="Profile Image"
                                     media-simple="true" id="profileImage">
                            </div>
                            <table class="table profile-table" id="" cellspacing="0">
                                <tbody>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Staff ID</th>
                                    <td class="body-item mbr-fonts-style display-7"
                                        id="tstaffID">{{$staff->staffID}}</td>
                                </tr>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Name</th>
                                    <td class="body-item mbr-fonts-style display-7"
                                        id="tStaffName">{{$staff->firstName}} {{$staff->lastName}}</td>
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
                                    <td class="body-item mbr-fonts-style display-7"
                                        id="tIcNum">{{$staff->ICNum}}</td>
                                </tr>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Gender</th>
                                    <td class="body-item mbr-fonts-style display-7"
                                        id="tGender">{{$staff->getGender()}}</td>
                                </tr>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Birth Date</th>
                                    <td class="body-item mbr-fonts-style display-7"
                                        id="tBirthDate">{{date_format(date_create($staff->birthDate), "d-M-Y")}}</td>
                                </tr>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Position</th>
                                    <td class="body-item mbr-fonts-style display-7"
                                        id="tStaffPos">{{$staff->getStaffPosition()}}</td>
                                </tr>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Email Address</th>
                                    <td class="body-item mbr-fonts-style display-7"
                                        id="tEmail">{{$staff->emailAddress}}</td>
                                </tr>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Contact Number</th>
                                    <td class="body-item mbr-fonts-style display-7"
                                        id="tPhone">{{$staff->phoneNum}}</td>
                                </tr>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Home Address</th>
                                    <td class="body-item mbr-fonts-style display-7"
                                        id="tHomeAddress">{{$staff->homeAddress}}</td>
                                </tr>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Account Status</th>
                                    <td class="body-item mbr-fonts-style display-7"
                                        id="tAccStatus">{{$staff->getAccStatus()}}</td>
                                </tr>
                                <tr>
                                    <th class="body-item mbr-fonts-style display-7">Account Created at</th>
                                    <td class="body-item mbr-fonts-style display-7"
                                        id="tAccCreatedAt">{{date_format(date_create($staff->created_at), "d-M-Y h:i:s A")}}</td>
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
                                    <button type="button" class="btn btn-sm btn-secondary btn-block" id="deactivateAcc">
                                        Deactivate Account
                                    </button>
                                    <form method="POST"
                                          action="/staff/{{ Auth::user()->staffPos === 1 ? 'hr' : 'nurse' }}/profile/deactivate"
                                          id="deactivateStaffAcc{{$staff->staffID}}" style="display: none;">
                                        {{csrf_field()}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update staff profile form modal -->
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
                                <div class="col-md-6 form-group">
                                    <label>
                                        <span style="color:red;">*</span>First Name</label>
                                    <input type="text" name="firstName" placeholder="John"
                                           value="{{$staff->firstName}}" class="form-control"
                                           pattern="[A-Za-z\-@ ]{2,}"
                                           title="Alphabetic, @ and - symbols only. E.g. - John"
                                           required="required">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>
                                        <span style="color:red;">*</span>Last Name</label>
                                    <input type="text" name="lastName" placeholder="Doe"
                                           value="{{$staff->lastName}}" class="form-control"
                                           pattern="[A-Za-z\-@ ]{2,}"
                                           title="Alphabetic, @ and - symbols only. E.g. - Smith"
                                           required="required">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>
                                        <span style="color:red;">*</span>IC Number</label>
                                    <input type="text" name="ICNum" placeholder="981213125523"
                                           value="{{$staff->ICNum}}" class="form-control"
                                           pattern="\d{12}" title="Numeric only. E.g. 985564127789"
                                           maxlength="12" required="required">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>
                                        <span style="color:red;">*</span>Contact Number</label>
                                    <input type="text" name="phoneNum" placeholder="0186559875"
                                           value="{{$staff->phoneNum}}" class="form-control"
                                           pattern="([0-9]|[0-9\-]){3,20}"
                                           title="Numeric and '-' symbols only. E.g. 014-8897875"
                                           required="required">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>
                                        <span style="color:red;">*</span>Email</label>
                                    <input type="email" name="emailAddress"
                                           placeholder="email@hotmail.com"
                                           value="{{$staff->emailAddress}}" class="form-control"
                                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                                           title="E.g. - john@hotmail.com" required="required">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>
                                        <span style="color:red;">*</span>Birth Date</label>
                                    <input class="form-control" type="date" name="birthDate"
                                           value="{{$staff->birthDate}}" required="required">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            @if(Auth::user()->staffPos === 1)
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>
                                            <span style="color:red;">*</span>Staff Position</label>
                                        <select name="staffPos" class="form-control" required="required">
                                            <option disabled=disabled" selected="selected" value>Select
                                                staff position
                                            </option>
                                            <option value="0" {{ $staff->staffPos === 0 ? 'selected="selected"' : '' }}>
                                                Nurse
                                            </option>
                                            <option value="1" {{ $staff->staffPos === 1 ? 'selected="selected"' : '' }}>
                                                Human Resource Manager
                                            </option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label><span style="color:red;">*</span>Gender</label><br/>
                                    <input type="radio" name="gender" required="required"
                                           value="1" {{ $staff->gender === 1 ? 'checked="checked"' : '' }}>
                                    Male
                                    <input type="radio" name="gender" required="required"
                                           value="0" {{ $staff->gender === 0 ? 'checked="checked"' : '' }}>
                                    Female<br>
                                </div>
                                <div class="col-md-6 form-group">
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
                                    <textarea name="homeAddress" class="form-control"
                                              style="height:200px;resize: none;">{{$staff->homeAddress}}</textarea>
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
                            <div class="col-sm-12">
                                <div class="row">
                                    <label><span style="color:red;">*</span> Current Password</label>
                                    <input type="password" name="currentPassword" class="form-control"
                                           required="required">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="row">
                                    <label><span style="color:red;">*</span> New Password</label>
                                    <input type="password" name="newPassword" class="form-control"
                                           required="required">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="row">
                                    <label><span style="color:red;">*</span> Confirm New Password</label>
                                    <input type="password" name="newPassword_confirmation"
                                           class="form-control" required="required">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <br/>
                                <div class="col-md-8 mx-auto">
                                    <button type="submit" class="btn btn-lg btn-success btn-block">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('additionalJS')
    <script src={{"/assets/additional/js/staff_profile.js"}}></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>

    @if(session('failure'))
        <script>oneHRAcc("{{session('failure')}}");</script>
    @endif
@endsection