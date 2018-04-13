@extends('staff.layout.baseTemplate-HR')

@section('title')
    <title>{{$donor->donorID}} Donor Profile</title>
@endsection

@section('additionalCSS')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/default.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.rtl.min.css" />
    <link rel="stylesheet" href={{"/assets/additional/css/registerForm.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/additional/css/profile.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/additional/css/notify.css"}} type="text/css">
@endsection

@section('contents')
    <section class="testimonials5 cid-qMsLJzqWLk" id="testimonials5-1v">
        <div class="mbr-overlay" style="opacity: 0.1; background-color:#000000;"></div>
        <div class="container">
            <div class="media-container-row">
                <div class="title col-12 align-center">
                    <h2 class="pb-3 mbr-fonts-style display-2">Donor Profile</h2>
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
                                            <th class="body-item mbr-fonts-style display-7">IC Number</th>
                                            <td class="body-item mbr-fonts-style display-7">{{$donor->ICNum}}</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Gender</th>
                                            <td class="body-item mbr-fonts-style display-7">{{$donor->getGender()}}</td>
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
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Account Status</th>
                                            <td class="body-item mbr-fonts-style display-7">{{$donor->getAccStatus()}}</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Account Created at</th>
                                            <td class="body-item mbr-fonts-style display-7">{{date_format(date_create($donor->created_at), "d-M-Y h:i:s A")}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="card">
                                    <div class="card-body">
                                        <a href="/staff/hr/list/donor/"><button type="button" class="btn btn-sm btn-primary profile-btn">Back</button></a>
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
    <script src={{"/assets/additional/js/donor_util.js"}}></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
@endsection