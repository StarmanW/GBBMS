@extends('baseTemplates')

@section('title')
    <title>Reservation Details</title>
@endsection

@section('additionalCSS')
    <link rel="stylesheet" href={{"assets/additional/css/profile.css"}} type="text/css">
	<link rel="stylesheet" href="/assets/additional/css/reservation-details.css" type="text/css">
@endsection

@section('contents')
    <section class="testimonials5 cid-qM5et8Bfce" id="testimonials5-17" data-rv-view="1335">
        <div class="container">
            <div class="media-container-row">
                <div class="title col-12 align-center">
                    <h2 class="pb-3 mbr-fonts-style display-1">
                        Reservation Details
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
										<th colspan="2" class="title">Reservation</th>
										<tr>
                                            <th class="body-item mbr-fonts-style display-7">Reservation ID</th>
                                            <td class="body-item mbr-fonts-style display-7">R180012</td>
                                        </tr>
										<tr>
                                            <th class="body-item mbr-fonts-style display-7">Date Reserved</th>
                                            <td class="body-item mbr-fonts-style display-7">12-Jan-2018</td>
                                        </tr>
										<tr>
                                            <th class="body-item mbr-fonts-style display-7">Reservation Status</th>
                                            <td class="body-item mbr-fonts-style display-7">Reserved</td>
                                        </tr>
										<th colspan="2" class="title">Event</th>
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
                                        <a href="">
                                            <button type="submit" class="btn btn-sm btn-secondary">Cancel Reservation</button>
                                        </a>
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