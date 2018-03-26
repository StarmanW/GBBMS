@extends('baseTemplates')

@section('title')
    <title>Donor Profile</title>
@endsection

@section('additionalCSS')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/default.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.rtl.min.css" />
    <link rel="stylesheet" href={{"assets/additional/css/registerForm.css"}} type="text/css">
    <link rel="stylesheet" href={{"assets/additional/css/profile.css"}} type="text/css">
    <link rel="stylesheet" href={{"assets/additional/css/notify.css"}} type="text/css">
@endsection

@section('content')
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
                                <img src="assets/images/scarface-tony-montana-al-pacino-600x300.jpg" alt="" title="" media-simple="true">
                            </div>
                            <p class="mbr-text mbr-fonts-style mbr-white display-5"></p>

                            <div class="profile-table-wrap">
                                <table class="table profile-table" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Donor ID</th>
                                            <td class="body-item mbr-fonts-style display-7">D160420</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Name</th>
                                            <td class="body-item mbr-fonts-style display-7">Enjiun Tan</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">IC Number</th>
                                            <td class="body-item mbr-fonts-style display-7">981012-12-1245</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Birth Date</th>
                                            <td class="body-item mbr-fonts-style display-7">12-Oct-1998</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Blood Type</th>
                                            <td class="body-item mbr-fonts-style display-7">O Positive</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Email Address</th>
                                            <td class="body-item mbr-fonts-style display-7">ididdrugs98@gmail.com</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Contact Number</th>
                                            <td class="body-item mbr-fonts-style display-7">019-553-5413</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Home Address</th>
                                            <td class="body-item mbr-fonts-style display-7">H/s no. 3, lorong 15, phase 2, Taman Cantek, Kota Kinabalu, Sabah, Malaysia</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                        <h3 class="modal-title" id="lineModalLabel"></h3>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">Close</span>
                        </button>
                    </div>
                    <div class="modal-body">
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
                                        <span style="color:red;">*</span>Blood Type</label>
                                    <select name="staffPos" class="form-control" required="required">
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
                                    <textarea name="homeAddress" class="form-control" style="height:200px;resize: none;"></textarea>
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
    <script src={{"assets/additional/js/donor_util.js"}}></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
@endsection