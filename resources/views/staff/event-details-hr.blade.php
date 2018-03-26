@extends('staff.layout.baseTemplate-HR')

@section('title')
    <title>Event Details</title>
@endsection

@section('additionalCSS')
    <link rel="stylesheet" href={{"/assets/additional/css/profile.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/additional/css/registerForm.css"}} type="text/css">
    <link rel="stylesheet" href={{"/assets/additional/css/notify.css"}} type="text/css">
@endsection

@section('contents')
    <section class="testimonials5 cid-qM5et8Bfce" id="testimonials5-17" data-rv-view="1335">
        <div class="mbr-overlay" style="opacity: 0.15; background-color:#000000;"></div>
        <div class="container">
            <div class="media-container-row">
                <div class="title col-12 align-center">
                    <h2 class="pb-3 mbr-fonts-style display-1">
                        Event Details
                    </h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="media-container-column">
                <div class="mbr-testimonial align-center col-12 col-md-10">
                    <div class="panel-item">
                        <div class="card-block">
                            <div class="profile-table-wrap">
                                <table class="table profile-table">
                                    <tbody>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Event ID</th>
                                            <td class="body-item mbr-fonts-style display-7">E180124</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Event Name</th>
                                            <td class="body-item mbr-fonts-style display-7">Kota Kinabalu Charity Blood Drive May 2018</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Date</th>
                                            <td class="body-item mbr-fonts-style display-7">12-May-2018</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Time</th>
                                            <td class="body-item mbr-fonts-style display-7">10.30 AM to 4.00 PM</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Room</th>
                                            <td class="body-item mbr-fonts-style display-7">0340012</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Status</th>
                                            <td class="body-item mbr-fonts-style display-7">Upcoming</td>
                                        </tr>
                                        <tr>
                                            <th class="body-item mbr-fonts-style display-7">Nurses On Duty</th>
                                            <td class="body-item mbr-fonts-style display-7">
                                                <table class="table profile-table-nurse">
                                                    <thead>
                                                        <tr>
                                                            <th>Nurse ID</th>
                                                            <th>Nurse Name</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="body-item mbr-fonts-style display-7">SN16002</td>
                                                            <td class="body-item mbr-fonts-style display-7">Samuel Wong Kim Foong</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="body-item mbr-fonts-style display-7">SN17001</td>
                                                            <td class="body-item mbr-fonts-style display-7">Chong Jia Herng</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="body-item mbr-fonts-style display-7">SN18030</td>
                                                            <td class="body-item mbr-fonts-style display-7">Enjiun Tan</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="body-item mbr-fonts-style display-7">SN17035</td>
                                                            <td class="body-item mbr-fonts-style display-7">Lee Jun Kai</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="body-item mbr-fonts-style display-7">SN18012</td>
                                                            <td class="body-item mbr-fonts-style display-7">Ritchie Reginald</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="card">
                                    <div class="card-body">
                                        <button data-toggle="modal" data-target="#squarespaceModal" type="button" name="edit" class="btn btn-sm btn-primary profile-btn">Edit Event Details</button>
                                        <button type="button" name="delete" class="btn btn-sm btn-secondary profile-btn" onclick="cancelEventPrompt('Donor 1');">Cancel Event</button>
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
                            <div class="submit-button div-button-center">
                                <button type="submit" class="btn btn-sm btn-success profile-btn">Submit</button>
                                <button type="reset" class="btn btn-sm btn-primary profile-btn">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
